<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SHOW LOGIN PAGE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('student.login');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN STUDENT
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'matric_no' => ['required'],
            'password' => ['required'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | ATTEMPT LOGIN
        |--------------------------------------------------------------------------
        */
        if (Auth::attempt($credentials)) {

    $request->session()->regenerate();

    // RESET BOTH FLAGS
    session([
        'auth_face_verified' => false,
        'exam_face_verified' => false
    ]);

    return redirect('/face-verification?type=login');
}
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/student/login');
    }
}