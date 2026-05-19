<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Available Examinations — LASU CBT Portal</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://cdn.tailwindcss.com"></script>

<style>
body{
    background:
        radial-gradient(circle at top left, rgba(59,130,246,0.10), transparent 40%),
        radial-gradient(circle at bottom right, rgba(99,102,241,0.08), transparent 40%),
        #f5faff;
}

.glass{
    background: rgba(255,255,255,0.75);
    backdrop-filter: blur(18px);
    border: 1px solid rgba(255,255,255,0.8);
}
</style>
</head>

<body class="text-slate-800">

<!-- TOP NAV (RESTORED FULL DASHBOARD NAV) -->
<header class="sticky top-0 z-50 bg-white/70 backdrop-blur-xl border-b border-slate-100">

    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- BRAND -->
        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold shadow">
                🎓
            </div>

            <div>
                <h1 class="font-extrabold text-blue-600 leading-tight">
                    LASU CBT Portal
                </h1>
                <p class="text-xs text-slate-500">
                    Student Examination Dashboard
                </p>
            </div>

        </div>

        <!-- NAV LINKS (IMPORTANT RESTORED) -->
        <div class="flex items-center gap-6 text-sm font-medium">

            <a href="/student/dashboard"
               class="text-slate-600 hover:text-blue-600 transition">
                Dashboard
            </a>

            <a href="/student/exams"
               class="text-blue-600 font-bold">
                Exams
            </a>

            <a href="/student/results"
               class="text-slate-600 hover:text-blue-600 transition">
                Results
            </a>

        </div>

        <!-- LOGOUT -->
        <form method="POST" action="/student/logout">
            @csrf
            <button class="text-sm font-semibold text-red-500 hover:text-red-600">
                Logout
            </button>
        </form>

    </div>

</header>

<!-- HERO -->
<section class="max-w-6xl mx-auto px-6 py-10">

    <div class="glass rounded-3xl p-8 flex flex-col md:flex-row md:items-center justify-between gap-6">

        <div>

            <h2 class="text-3xl md:text-4xl font-extrabold">
                Available Examinations
            </h2>

            <p class="text-slate-500 mt-2">
                Select an exam and begin your CBT session
            </p>

        </div>

        <div class="bg-blue-50 border border-blue-100 px-5 py-3 rounded-2xl text-center">
            <p class="text-xs text-slate-500">Total Exams</p>
            <p class="text-xl font-bold text-blue-600">
                {{ count($exams) }}
            </p>
        </div>

    </div>

</section>

<!-- EXAMS GRID -->
<section class="max-w-6xl mx-auto px-6 pb-16">

    <div class="grid md:grid-cols-3 gap-6">

        @forelse($exams as $exam)

        <div class="glass rounded-3xl p-6 hover:shadow-xl transition">

            <!-- TITLE -->
            <h3 class="text-lg font-bold">
                {{ $exam->title }}
            </h3>

            <!-- DETAILS -->
            <p class="text-sm text-slate-500 mt-3">
                Duration: <span class="font-semibold">{{ $exam->duration }} mins</span>
            </p>

            <p class="text-xs text-slate-400 mt-1">
                CBT Examination System
            </p>

            <!-- ACTION -->
            <div class="mt-6">

                @php
                    $attempt = $attempts[$exam->id] ?? null;
                @endphp

                @if($attempt && $attempt->submitted_at)

                    <button disabled
                        class="w-full bg-green-100 text-green-700 py-3 rounded-2xl font-semibold border border-green-200 cursor-not-allowed">
                        Exam Completed
                    </button>

                @elseif($attempt)

                    <a href="/student/exams/{{ $attempt->id }}/take"
                       class="block text-center w-full bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-2xl font-semibold transition shadow-md">
                        Continue Exam
                    </a>

                @else

                    <form method="POST" action="/student/exams/{{ $exam->id }}/start">
                        @csrf
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-2xl font-semibold transition shadow-md">
                            Start Exam
                        </button>
                    </form>

                @endif

            </div>

        </div>

        @empty

        <div class="col-span-3 text-center py-16 text-slate-500">
            No exams available yet.
        </div>

        @endforelse

    </div>

</section>

</body>
</html>