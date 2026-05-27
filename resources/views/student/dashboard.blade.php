<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Dashboard — LASU CBT Portal</title>
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

<!-- TOP NAV -->
<header class="sticky top-0 z-50 bg-white/70 backdrop-blur-xl border-b border-slate-100">

    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- BRAND -->
        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold shadow">
                🎓
            </div>

            <div>
                <h1 class="font-extrabold text-blue-600 leading-tight">
                    LASUSTECH CBT Portal
                </h1>
                <p class="text-xs text-slate-500">
                    Student Examination Dashboard
                </p>
            </div>

        </div>

        <!-- ACTIONS -->
        <div class="flex items-center gap-4">

            <a href="/student/exams"
               class="text-sm font-medium text-slate-600 hover:text-blue-600 transition">
                My Exams
            </a>

            <a href="/student/results"
            class="text-sm font-medium text-slate-600 hover:text-blue-600 transition">
                My Results
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

<!-- HERO SECTION -->
<section class="max-w-6xl mx-auto px-6 py-10">

    <div class="glass rounded-3xl p-8 flex flex-col md:flex-row md:items-center justify-between gap-6">

        <div>

    <h2 class="text-3xl md:text-4xl font-extrabold">
        Welcome Back, {{ auth()->user()->name ?? 'Student' }} 🎓
    </h2>

    <p class="text-slate-500 mt-2">
        Matric Number:
        <span class="font-semibold text-slate-700">
            {{ auth()->user()->matric_no ?? 'N/A' }}
        </span>
    </p>

    <p class="text-slate-500 mt-1 text-sm">
        Select an available examination below to begin your CBT session.
    </p>

</div>

        <div class="flex gap-4">

            <div class="bg-blue-50 border border-blue-100 px-5 py-3 rounded-2xl text-center">
                <p class="text-xs text-slate-500">Available Exams</p>
                <p class="text-xl font-bold text-blue-600">
                    {{ count($exams) }}
                </p>
            </div>

            <div class="bg-green-50 border border-green-100 px-5 py-3 rounded-2xl text-center">
                <p class="text-xs text-slate-500">Status</p>
                <p class="text-sm font-bold text-green-600">
                    Active
                </p>
            </div>

        </div>

    </div>

</section>

<!-- EXAMS -->
<section class="max-w-6xl mx-auto px-6 pb-16">

    <div class="mb-6">
        <h3 class="text-2xl font-bold">Available Exams</h3>
        <p class="text-slate-500 text-sm mt-1">
            Select an exam below to begin your computer-based test
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">

        @forelse($exams as $exam)

        <div class="glass rounded-3xl p-6 hover:shadow-xl transition">

            <!-- ICON -->
            <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center mb-4 font-bold">
                📘
            </div>

            <!-- TITLE -->
            <h3 class="text-lg font-bold">
                {{ $exam->title }}
            </h3>

            <!-- META -->
            <p class="text-sm text-slate-500 mt-2">
                Duration: <span class="font-semibold">{{ $exam->duration }} mins</span>
            </p>

            <p class="text-xs text-slate-400 mt-1">
                LASUSTECH CBT Standard Examination System
            </p>

           <!-- ACTION -->
<div class="mt-6">

    @php
        $attempt = $attempts[$exam->id] ?? null;
    @endphp

    {{-- EXAM COMPLETED --}}
    @if($attempt && $attempt->submitted_at)

        <div class="space-y-3">

            <button
                disabled
                class="w-full bg-green-100 text-green-700 py-3 rounded-2xl font-semibold border border-green-200 cursor-not-allowed">
                Exam Completed
            </button>

            <a href="/student/results/{{ $attempt->id }}"
               class="block text-center w-full bg-white border border-slate-200 hover:bg-slate-50 py-3 rounded-2xl font-semibold transition">
                View Result
            </a>

        </div>

    {{-- CONTINUE EXAM --}}
    @elseif($attempt)

        <a href="/student/exams/{{ $attempt->id }}/take"
           class="block text-center w-full bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-2xl font-semibold transition shadow-md">
            Continue Exam
        </a>

    {{-- START NEW --}}
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
            <div class="text-4xl mb-3">📭</div>
            No exams available yet.
        </div>

        @endforelse

    </div>

</section>

<!-- FOOTER -->
<footer class="border-t bg-white/60 backdrop-blur-xl py-6">
    <div class="max-w-6xl mx-auto px-6 text-sm text-slate-500 flex justify-between">

        <p>LASUSTECH CBT Portal © {{ date('Y') }}</p>

        <p>Secure Academic Examination System</p>

    </div>
</footer>

</body>

@if(session('error'))
    <div id="errorModal"
         class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white rounded-2xl p-6 max-w-md w-full shadow-2xl text-center">

            <div class="text-4xl mb-3">⚠️</div>

            <h2 class="text-xl font-bold text-slate-800 mb-2">
                Exam Blocked
            </h2>

            <p class="text-slate-600 mb-5">
                {{ session('error') }}
            </p>

            <button onclick="closeModal()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold">
                OK, Understood
            </button>

        </div>
    </div>

    <script>
        function closeModal() {
            document.getElementById('errorModal').style.display = 'none';
        }

        // auto close after 5 seconds (optional)
        setTimeout(() => {
            const modal = document.getElementById('errorModal');
            if (modal) modal.style.display = 'none';
        }, 5000);
    </script>
@endif

</html>