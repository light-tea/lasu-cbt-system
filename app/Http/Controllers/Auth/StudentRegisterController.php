<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentRegisterController extends Controller
{
    public function create()
    {
        return view('auth.student-register');
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'matric_no' => 'required|unique:users',
        'password' => 'required|min:6',
        'face_descriptor' => 'required',
        'face_image' => 'required',
    ]);

    try {

        User::create([
            'name' => $request->name,
            'matric_no' => $request->matric_no,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'face_descriptor' => $request->face_descriptor,
            'face_image' => $request->face_image,
        ]);

        return response()->json([
    'success' => true,
    'message' => 'Registration successful'
    ]);
       

    } catch (\Exception $e) {

        return response()->json([
            'status' => false,
            'error' => $e->getMessage()
        ], 500);
    }
}
    }
