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
        if (Auth::check()) {
            return redirect('/face-verification?type=login');
        }

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
            'password'  => ['required'],
        ]);

        if (Auth::attempt($credentials, false)) {

            $request->session()->regenerate();

            // Reset face flags
            $request->session()->put('auth_face_verified', false);
            $request->session()->put('exam_face_verified', false);

            // Force session write to database immediately
            $request->session()->save();

            return redirect('/face-verification?type=login');
        }

        return back()->withErrors([
            'matric_no' => 'Invalid matric number or password.',
        ])->withInput($request->only('matric_no'));
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