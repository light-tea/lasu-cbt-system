<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureFaceVerified
{
    public function handle(Request $request, Closure $next)
    {
        // allow login + verification pages
        if ($request->is('face-verification')) {
            return $next($request);
        }

        // dashboard protection
        if ($request->is('student/dashboard')) {

            if (!session('auth_face_verified')) {
                return redirect('/face-verification?type=login');
            }
        }

        return $next($request);
    }
}