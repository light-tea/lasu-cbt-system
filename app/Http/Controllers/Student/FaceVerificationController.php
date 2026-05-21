<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FaceVerificationController extends Controller
{
    /**
     * SHOW FACE PAGE
     */
    public function index(Request $request)
    {
        // Check session directly instead of Auth::check()
        $userId = $request->session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d')
                ?? $request->session()->get('_token');

        $user = Auth::user();

        // Fallback: get user from session manually
        if (!$user) {
            $sessionUserId = session('user_id');
            if ($sessionUserId) {
                $user = User::find($sessionUserId);
                Auth::login($user);
            }
        }

        if (!$user) {
            return redirect('/student/login')
                   ->withErrors(['matric_no' => 'Session expired. Please login again.']);
        }

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