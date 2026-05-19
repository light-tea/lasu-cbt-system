<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaceVerificationController extends Controller
{
    /**
     * SHOW FACE PAGE
     */
    public function index(Request $request)
    {
        // pass purpose: login or exam
        $type = $request->query('type', 'login');

        return view('student.verify-face', compact('type'));
    }

    /**
     * HANDLE FACE SUCCESS
     */
    public function verified(Request $request)
    {
        $type = $request->type;

        if ($type === 'login') {

            session(['auth_face_verified' => true]);

            return response()->json([
                'redirect' => '/student/dashboard'
            ]);
        }

        if ($type === 'exam') {

            session(['exam_face_verified' => true]);

            return response()->json([
                'redirect' => back()->getTargetUrl()
            ]);
        }

        return response()->json([
            'message' => 'Invalid verification type'
        ], 400);
    }
}