<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Results — LASU CBT Portal</title>
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

<!-- TOP NAV (UNCHANGED) -->
<header class="sticky top-0 z-50 bg-white/70 backdrop-blur-xl border-b border-slate-100">

    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">

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

        <div class="flex items-center gap-4">

            <a href="/student/dashboard" class="text-sm font-medium text-slate-600 hover:text-blue-600">
                Dashboard
            </a>

            <a href="/student/exams" class="text-sm font-medium text-slate-600 hover:text-blue-600">
                My Exams
            </a>

            <form method="POST" action="/student/logout">
                @csrf
                <button class="text-sm font-semibold text-red-500 hover:text-red-600">
                    Logout
                </button>
            </form>

        </div>

    </div>

</header>

<!-- HEADER -->
<section class="max-w-6xl mx-auto px-6 py-10">

    <div class="glass rounded-3xl p-8 flex flex-col md:flex-row md:items-center justify-between gap-6">

        <div>
            <h2 class="text-3xl font-extrabold">
                My Examination Results 📊
            </h2>
            <p class="text-slate-500 mt-2">
                View your CBT performance history
            </p>
        </div>

        <div class="bg-blue-50 border border-blue-100 px-5 py-3 rounded-2xl text-center">
            <p class="text-xs text-slate-500">Total Attempts</p>
            <p class="text-xl font-bold text-blue-600">
                {{ count($attempts) }}
            </p>
        </div>

    </div>

</section>

<!-- TABLE -->
<section class="max-w-6xl mx-auto px-6 pb-16">

    <div class="glass rounded-3xl overflow-hidden shadow-xl">

        <table class="w-full">

            <thead class="bg-slate-100 text-left text-sm">
                <tr>
                    <th class="p-5">Exam</th>
                    <th class="p-5">Score</th>
                    <th class="p-5">Grade</th>
                    <th class="p-5">Status</th>
                    <th class="p-5">Date</th>
                </tr>
            </thead>

            <tbody>

            @forelse($attempts as $attempt)

                @php
                    // ✅ FIX: score is already percentage from controller
                    $percentage = $attempt->score ?? 0;

                    if ($percentage >= 70) {
                        $grade = 'A';
                        $status = 'Excellent';
                        $color = 'text-green-500';
                    } elseif ($percentage >= 60) {
                        $grade = 'B';
                        $status = 'Credit';
                        $color = 'text-blue-500';
                    } elseif ($percentage >= 50) {
                        $grade = 'C';
                        $status = 'Pass';
                        $color = 'text-yellow-500';
                    } elseif ($percentage >= 40) {
                        $grade = 'D';
                        $status = 'Pass';
                        $color = 'text-orange-500';
                    } else {
                        $grade = 'F';
                        $status = 'Fail';
                        $color = 'text-red-500';
                    }
                @endphp

                <tr class="border-t border-slate-200 hover:bg-white/60 transition">

                    <td class="p-5 font-semibold">
                        {{ $attempt->exam->title }}
                    </td>

                    <td class="p-5 font-bold">
                        {{ $percentage }}%
                    </td>

                    <td class="p-5 font-bold {{ $color }}">
                        {{ $grade }}
                    </td>

                    <td class="p-5 font-semibold {{ $color }}">
                        {{ $status }}
                    </td>

                    <td class="p-5 text-slate-500">
                        {{ optional($attempt->submitted_at)->format('d M Y') ?? 'N/A' }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="5" class="p-10 text-center text-slate-500">
                        No exam results yet
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</section>

</body>
</html>