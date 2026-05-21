<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaceVerificationController extends Controller
{
    /**
     * SHOW FACE PAGE
     */
    <?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // ← this line was missing

class FaceVerificationController extends Controller
{
    /**
     * SHOW FACE PAGE
     */
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/student/login')
                   ->withErrors(['matric_no' => 'Session expired. Please login again.']);
        }

        $user = Auth::user();

        if (!$user->face_descriptor) {
            return redirect('/student/login')
                   ->withErrors(['matric_no' => 'No face data found. Please register again.']);
        }

        return view('face-verification', [
            'faceDescriptor' => $user->face_descriptor
        ]);
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
}