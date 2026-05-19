<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function create()
    {
        return view('admin.exams.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'duration' => 'required|integer',
    ]);

    $exam = \App\Models\Exam::create([
        'title' => $request->title,
        'duration' => $request->duration,
        'created_by' => auth()->id(),
    ]);

    // ✅ REDIRECT TO QUESTION PAGE (IMPORTANT)
    return redirect("/admin/exams/{$exam->id}/questions/create")
        ->with('success', 'Exam created successfully. Now add questions.');
}
}