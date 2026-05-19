<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LASU CBT Result Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>

    @php
/*
|--------------------------------------------------------------------------
| SAFE CBT RESULT DISPLAY (NO RE-CALCULATION)
|--------------------------------------------------------------------------
*/

// Already stored as 0–100 in DB
$percentage = $attempt->score ?? 0;

// prevent weird values if DB ever has bug
$percentage = max(0, min(100, $percentage));

// grade system
if ($percentage >= 70) {
    $grade = 'A';
    $remark = 'Excellent';
    $color = 'text-green-600';
    $bg = 'bg-green-100 border-green-200 text-green-700';
} elseif ($percentage >= 60) {
    $grade = 'B';
    $remark = 'Credit';
    $color = 'text-blue-600';
    $bg = 'bg-blue-100 border-blue-200 text-blue-700';
} elseif ($percentage >= 50) {
    $grade = 'C';
    $remark = 'Pass';
    $color = 'text-yellow-600';
    $bg = 'bg-yellow-100 border-yellow-200 text-yellow-700';
} elseif ($percentage >= 40) {
    $grade = 'D';
    $remark = 'Pass';
    $color = 'text-orange-600';
    $bg = 'bg-orange-100 border-orange-200 text-orange-700';
} else {
    $grade = 'F';
    $remark = 'Fail';
    $color = 'text-red-600';
    $bg = 'bg-red-100 border-red-200 text-red-700';
}
@endphp

    <style>

        body{
            font-family: system-ui;
            background:
                radial-gradient(circle at top left, rgba(0,91,187,0.10), transparent 30%),
                radial-gradient(circle at bottom right, rgba(255,215,0,0.08), transparent 30%),
                #f4f7fb;
        }

        .glass{
            background: rgba(255,255,255,0.82);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,0.9);
        }

        .score-ring{
            background:
                conic-gradient(
                    #2563eb calc({{ $percentage }} * 1%),
                    #e5e7eb 0
                );
        }

    </style>
</head>

<body class="min-h-screen px-4 py-10">

<div class="max-w-6xl mx-auto">

    <!-- TOP NAV -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div class="flex items-center gap-4">

            <a href="/student/dashboard"
               class="text-sm font-semibold text-slate-500 hover:text-blue-700 transition">
                ← Back To Dashboard
            </a>

            <div class="hidden md:block h-6 w-px bg-slate-300"></div>

            <div>

                <h1 class="text-2xl font-extrabold text-slate-800">
                    LASU CBT Examination Portal
                </h1>

                <p class="text-sm text-slate-500">
                    Lagos State University Computer-Based Testing System
                </p>

            </div>

        </div>

        <!-- STATUS -->
        <div class="{{ $bg }} px-5 py-3 rounded-2xl text-sm font-bold shadow-sm border">
            Examination Submitted Successfully
        </div>

    </div>

    <!-- RESULT CARD -->
    <div class="glass rounded-[32px] overflow-hidden shadow-2xl">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-blue-700 via-blue-600 to-blue-500 px-8 py-10 text-white relative overflow-hidden">

            <div class="absolute top-0 right-0 opacity-10 text-[180px] font-black leading-none">
                LASU
            </div>

            <div class="relative z-10 grid lg:grid-cols-2 gap-10 items-center">

                <!-- LEFT -->
                <div>

                    <div class="inline-flex items-center gap-2 bg-white/15 px-4 py-2 rounded-full text-sm font-semibold mb-5">

                        <div class="w-2 h-2 rounded-full bg-green-300 animate-pulse"></div>

                        CBT Examination Completed

                    </div>

                    <h2 class="text-4xl font-extrabold leading-tight mb-4">
                        {{ $attempt->exam->title }}
                    </h2>

                    <p class="text-blue-100 leading-relaxed max-w-lg">
                        Your examination has been processed successfully.
                        Below is your official examination performance summary and grading evaluation.
                    </p>

                </div>

                <!-- SCORE RING -->
                <div class="flex justify-center lg:justify-end">

                    <div class="score-ring w-52 h-52 rounded-full flex items-center justify-center shadow-2xl">

                        <div class="w-40 h-40 rounded-full bg-white flex flex-col items-center justify-center">

                            <div class="text-5xl font-black text-slate-800">
                                {{ $percentage }}%
                            </div>

                            <div class="text-sm font-bold text-slate-500 uppercase tracking-widest mt-2 text-center">
                                {{ $attempt->score }}%  Correct
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- BODY -->
        <div class="p-8">

            <!-- INFO GRID -->
            <div class="grid md:grid-cols-4 gap-5 mb-8">

                <!-- STUDENT -->
                <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm">

                    <p class="text-xs font-bold tracking-widest text-slate-400 uppercase mb-3">
                        Candidate
                    </p>

                    <div class="text-lg font-bold text-slate-800">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="text-sm text-slate-500 mt-1">
                        {{ auth()->user()->matric_no }}
                    </div>

                </div>

                <!-- DATE -->
                <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm">

                    <p class="text-xs font-bold tracking-widest text-slate-400 uppercase mb-3">
                        Submitted
                    </p>

                    <div class="text-lg font-bold text-slate-800">
                        {{ \Carbon\Carbon::parse($attempt->submitted_at)->format('d M Y') }}
                    </div>

                    <div class="text-sm text-slate-500 mt-1">
                        {{ \Carbon\Carbon::parse($attempt->submitted_at)->format('h:i A') }}
                    </div>

                </div>

                <!-- GRADE -->
                <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm">

                    <p class="text-xs font-bold tracking-widest text-slate-400 uppercase mb-3">
                        Grade
                    </p>

                    <div class="text-3xl font-black {{ $color }}">
                        {{ $grade }}
                    </div>

                    <div class="text-sm text-slate-500 mt-1">
                        Academic Grade
                    </div>

                </div>

                <!-- PERFORMANCE -->
                <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-sm">

                    <p class="text-xs font-bold tracking-widest text-slate-400 uppercase mb-3">
                        Performance
                    </p>

                    <div class="text-xl font-bold {{ $color }}">
                        {{ $remark }}
                    </div>

                    <div class="text-sm text-slate-500 mt-1">
                        CBT Evaluation
                    </div>

                </div>

            </div>

            <!-- GRADING SYSTEM -->
            <div class="bg-white border border-slate-100 rounded-3xl p-6 mb-8 shadow-sm">

                <h3 class="text-lg font-bold text-slate-800 mb-5">
                    Grading System
                </h3>

                <div class="grid md:grid-cols-5 gap-4 text-sm">

                    <div class="border border-green-200 bg-green-50 rounded-2xl p-4 text-center">
                        <div class="font-black text-2xl text-green-600">A</div>
                        <div class="text-slate-600 mt-1">70 - 100</div>
                        <div class="text-xs text-green-700 mt-2 font-semibold">Excellent</div>
                    </div>

                    <div class="border border-blue-200 bg-blue-50 rounded-2xl p-4 text-center">
                        <div class="font-black text-2xl text-blue-600">B</div>
                        <div class="text-slate-600 mt-1">60 - 69</div>
                        <div class="text-xs text-blue-700 mt-2 font-semibold">Credit</div>
                    </div>

                    <div class="border border-yellow-200 bg-yellow-50 rounded-2xl p-4 text-center">
                        <div class="font-black text-2xl text-yellow-600">C</div>
                        <div class="text-slate-600 mt-1">50 - 59</div>
                        <div class="text-xs text-yellow-700 mt-2 font-semibold">Pass</div>
                    </div>

                    <div class="border border-orange-200 bg-orange-50 rounded-2xl p-4 text-center">
                        <div class="font-black text-2xl text-orange-600">D</div>
                        <div class="text-slate-600 mt-1">40 - 49</div>
                        <div class="text-xs text-orange-700 mt-2 font-semibold">Pass</div>
                    </div>

                    <div class="border border-red-200 bg-red-50 rounded-2xl p-4 text-center">
                        <div class="font-black text-2xl text-red-600">F</div>
                        <div class="text-slate-600 mt-1">0 - 39</div>
                        <div class="text-xs text-red-700 mt-2 font-semibold">Fail</div>
                    </div>

                </div>

            </div>

            <!-- NOTICE -->
            <div class="bg-blue-50 border border-blue-100 rounded-3xl p-6 mb-8">

                <h3 class="font-bold text-slate-800 mb-2 text-lg">
                    Examination Record Saved
                </h3>

                <p class="text-slate-600 leading-relaxed">
                    Your examination record has been securely stored in the LASU CBT database.
                    Contact your lecturer or examination officer for further academic processing if required.
                </p>

            </div>

            <!-- ACTIONS -->
            <div class="grid md:grid-cols-2 gap-4">

                <a href="/student/dashboard"
                   class="bg-blue-600 hover:bg-blue-700 transition text-white text-center py-4 rounded-2xl font-bold shadow-lg">

                    Return To Dashboard

                </a>

                <a href="/student/exams"
                   class="bg-white border border-slate-200 hover:bg-slate-50 transition text-slate-700 text-center py-4 rounded-2xl font-bold">

                    View Available Exams

                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>