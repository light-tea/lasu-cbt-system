<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Auth\StudentRegisterController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\Auth\AdminLoginController;

use App\Http\Controllers\Student\FaceVerificationController;

use App\Http\Controllers\Admin\ExamController as AdminExamController;
use App\Http\Controllers\Admin\QuestionController;

use App\Http\Controllers\Student\ExamController as StudentExamController;

use App\Models\Exam;
use App\Models\User;
use App\Models\ExamAttempt;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| STUDENT AUTH
|--------------------------------------------------------------------------
*/
Route::get('/student/login', [StudentLoginController::class, 'create'])->name('student.login');
Route::post('/student/login', [StudentLoginController::class, 'store']);
Route::post('/student/logout', [StudentLoginController::class, 'destroy']);

Route::get('/student/register', [StudentRegisterController::class, 'create'])->name('student.register');
Route::post('/student/register', [StudentRegisterController::class, 'store']);

Route::get('/student/results/{attempt}', [StudentExamController::class, 'result']);

/*
|--------------------------------------------------------------------------
| FACE VERIFICATION
|--------------------------------------------------------------------------
*/
Route::get('/face-verification', [FaceVerificationController::class, 'index']);
Route::post('/face-verification', [FaceVerificationController::class, 'verified']);

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminLoginController::class, 'create']);
Route::post('/admin/login', [AdminLoginController::class, 'store']);
Route::post('/admin/logout', [AdminLoginController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard', [
            'totalExams' => Exam::count(),
            'totalStudents' => User::where('role', 'student')->count(),
            'totalAttempts' => ExamAttempt::count(),
        ]);
    });

    // Exams
    Route::get('/admin/exams/create', [AdminExamController::class, 'create']);
    Route::post('/admin/exams', [AdminExamController::class, 'store']);

    Route::get('/admin/exams', function () {
        $exams = Exam::latest()->paginate(10);
        return view('admin.exams.index', compact('exams'));
    });

    // QUESTIONS
    Route::get('/admin/exams/{exam}/questions', [QuestionController::class, 'index']);
    Route::get('/admin/exams/{exam}/questions/create', [QuestionController::class, 'create']);
    Route::post('/admin/exams/{exam}/questions', [QuestionController::class, 'store']);

    // STUDENTS
    Route::get('/admin/students', function () {
        $students = User::where('role', 'student')->get();
        return view('admin.students', compact('students'));
    });

    // RESULTS
    Route::get('/admin/results', function () {
        $results = ExamAttempt::with(['user', 'exam'])
            ->latest()
            ->get();

        return view('admin.results', compact('results'));
    });

});

/*
|--------------------------------------------------------------------------
| STUDENT AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/student/dashboard', [StudentExamController::class, 'dashboard']);

    Route::get('/student/exams', [StudentExamController::class, 'index']);

    Route::post('/student/exams/{exam}/start', [StudentExamController::class, 'start']);

    Route::get('/student/exams/{attempt}/take', [StudentExamController::class, 'take']);

    Route::post('/student/exams/submit', [StudentExamController::class, 'submit']);

    Route::get('/student/results', [StudentExamController::class, 'myResults']);
});

/*
|--------------------------------------------------------------------------
| (OPTIONAL SAFETY ROUTE - KEEP ONLY ONE)
|--------------------------------------------------------------------------
*/
// REMOVE THIS DUPLICATE (IMPORTANT FIX)
// Route::get('/student/exams/{attempt}/take', ...);