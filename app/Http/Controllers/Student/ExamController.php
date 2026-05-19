<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    public function dashboard()
    {
        $exams = Exam::latest()->get();

        $attempts = ExamAttempt::where('user_id', auth()->id())
            ->get()
            ->keyBy('exam_id');

        return view('student.dashboard', compact('exams', 'attempts'));
    }

    /*
    |--------------------------------------------------------------------------
    | LIST EXAMS
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $exams = Exam::latest()->get();

        return view('student.exams', compact('exams'));
    }

    /*
    |--------------------------------------------------------------------------
    | START EXAM (BLOCK REWRITE)
    |--------------------------------------------------------------------------
    */
    public function start($examId)
{
    $attempt = ExamAttempt::where('user_id', auth()->id())
        ->where('exam_id', $examId)
        ->first();

    // 1. Already completed → block
    if ($attempt && $attempt->submitted_at) {

        return redirect('/student/dashboard')
            ->with('error', 'You have already completed this exam.');
    }

    // 2. Not submitted → continue same attempt
    if ($attempt) {

        return redirect("/student/exams/{$attempt->id}/take");
    }

    // 3. No attempt → create new
    $attempt = ExamAttempt::create([
        'user_id'    => auth()->id(),
        'exam_id'    => $examId,
        'started_at' => now(),
    ]);

    return redirect("/student/exams/{$attempt->id}/take");
}
    /*
    |--------------------------------------------------------------------------
    | TAKE EXAM
    |--------------------------------------------------------------------------
    */
    public function take($attemptId)
    {
        $attempt = ExamAttempt::with('exam')->findOrFail($attemptId);

        if ($attempt->user_id !== auth()->id()) {
            abort(403);
        }

        if ($attempt->submitted_at) {
            return redirect("/student/results/{$attempt->id}");
        }

        $questions = Question::where('exam_id', $attempt->exam_id)->get();

        return view('student.take-exam', compact('attempt', 'questions'));
    }

    /*
    |--------------------------------------------------------------------------
    | SUBMIT EXAM (SCORE OUT OF 100)
    |--------------------------------------------------------------------------
    */
    public function submit(Request $request)
{
    $attempt = ExamAttempt::findOrFail($request->attempt_id);

    if ($attempt->user_id !== auth()->id()) {
        abort(403);
    }

    if ($attempt->submitted_at) {
        return redirect("/student/results/{$attempt->id}");
    }

    $questions = Question::where('exam_id', $attempt->exam_id)->get();

    $totalQuestions = $questions->count();
    $correctAnswers = 0;

    foreach ($questions as $question) {

        $studentAnswer = $request->answers[$question->id] ?? null;

        if ($studentAnswer !== null && $studentAnswer == $question->correct_answer) {
            $correctAnswers++;
        }
    }

    // ✅ SAFE SCORE (0 - 100 ONLY)
    $score = ($totalQuestions > 0)
        ? round(($correctAnswers / $totalQuestions) * 100)
        : 0;

    $attempt->update([
        'score' => $score,
        'submitted_at' => now(),
    ]);

    return redirect("/student/results/{$attempt->id}");
}

    /*
    |--------------------------------------------------------------------------
    | SINGLE RESULT PAGE
    |--------------------------------------------------------------------------
    */
    public function result($attemptId)
    {
        $attempt = ExamAttempt::with('exam')->findOrFail($attemptId);

        if ($attempt->user_id !== auth()->id()) {
            abort(403);
        }

        return view('student.result', compact('attempt'));
    }

    /*
    |--------------------------------------------------------------------------
    | ALL RESULTS PAGE
    |--------------------------------------------------------------------------
    */
    public function myResults()
    {
        $attempts = ExamAttempt::with('exam')
            ->where('user_id', auth()->id())
            ->whereNotNull('submitted_at')
            ->latest()
            ->get();

        return view('student.results', compact('attempts'));
    }
}