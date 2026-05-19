<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\Question;
use Illuminate\Http\Request;

class StudentExamController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | STUDENT DASHBOARD
    |--------------------------------------------------------------------------
    */
    public function dashboard()
    {
        $exams = Exam::latest()->get();

        $attempts = ExamAttempt::where('user_id', auth()->id())
            ->get()
            ->keyBy('exam_id');

        return view('student.dashboard', [
            'exams'    => $exams,
            'attempts' => $attempts
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | START EXAM
    |--------------------------------------------------------------------------
    */
    public function start($examId)
{
    /*
    |--------------------------------------------------------------------------
    | CHECK IF STUDENT HAS TAKEN EXAM BEFORE
    |--------------------------------------------------------------------------
    */

    $existingAttempt = ExamAttempt::where('user_id', auth()->id())
        ->where('exam_id', $examId)
        ->first();

    /*
    |--------------------------------------------------------------------------
    | BLOCK REWRITE
    |--------------------------------------------------------------------------
    */

    if ($existingAttempt) {

        return redirect('/student/dashboard')
            ->with('error', 'You have already taken this examination.');

    }

    /*
    |--------------------------------------------------------------------------
    | CREATE NEW ATTEMPT
    |--------------------------------------------------------------------------
    */

    $attempt = ExamAttempt::create([
        'user_id'    => auth()->id(),
        'exam_id'    => $examId,
        'started_at' => now(),
    ]);

    return redirect("/student/exams/{$attempt->id}/take");
}

    /*
    |--------------------------------------------------------------------------
    | TAKE EXAM PAGE
    |--------------------------------------------------------------------------
    */
    public function take($attemptId)
    {

        $attempt = ExamAttempt::with('exam')
            ->findOrFail($attemptId);

        /*
        |--------------------------------------------------------------------------
        | SECURITY: PREVENT ACCESS TO OTHER STUDENT ATTEMPTS
        |--------------------------------------------------------------------------
        */
        if ($attempt->user_id !== auth()->id()) {

            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | IF EXAM ALREADY SUBMITTED
        |--------------------------------------------------------------------------
        */
        if ($attempt->submitted_at) {

            return redirect("/student/results/{$attempt->id}");
        }

        $questions = Question::where(
            'exam_id',
            $attempt->exam_id
        )->get();

        return view('student.take_exam', [
            'attempt'   => $attempt,
            'questions' => $questions
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SUBMIT EXAM
    |--------------------------------------------------------------------------
    */
    public function submit(Request $request)
    {

        $attempt = ExamAttempt::findOrFail(
            $request->attempt_id
        );

        /*
        |--------------------------------------------------------------------------
        | SECURITY CHECK
        |--------------------------------------------------------------------------
        */
        if ($attempt->user_id !== auth()->id()) {

            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | PREVENT DOUBLE SUBMISSION
        |--------------------------------------------------------------------------
        */
        if ($attempt->submitted_at) {

            return redirect("/student/results/{$attempt->id}");
        }

        $questions = Question::where(
            'exam_id',
            $attempt->exam_id
        )->get();

        $totalQuestions = $questions->count();

        $correctAnswers = 0;

        foreach ($questions as $question) {

            $studentAnswer = $request->answers[$question->id] ?? null;

            if ($studentAnswer == $question->correct_answer) {

                $correctAnswers++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SCORE OVER 100
        |--------------------------------------------------------------------------
        */
        $score = $totalQuestions > 0
            ? round(($correctAnswers / $totalQuestions) * 100)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | SAVE RESULT
        |--------------------------------------------------------------------------
        */
        $attempt->update([
            'score'        => $score,
            'submitted_at' => now(),
        ]);

        return redirect("/student/results/{$attempt->id}");
    }

    /*
    |--------------------------------------------------------------------------
    | RESULT PAGE
    |--------------------------------------------------------------------------
    */
    public function result($attemptId)
    {

        $attempt = ExamAttempt::with('exam')
            ->findOrFail($attemptId);

        /*
        |--------------------------------------------------------------------------
        | SECURITY CHECK
        |--------------------------------------------------------------------------
        */
        if ($attempt->user_id !== auth()->id()) {

            abort(403);
        }

        return view('student.result', [
            'attempt' => $attempt
        ]);
    }

    public function myResults()
{
    $attempts = ExamAttempt::with('exam')
        ->where('user_id', auth()->id())
        ->whereNotNull('submitted_at')
        ->latest()
        ->get();

    return view('student.results', [
        'attempts' => $attempts
    ]);
}
}