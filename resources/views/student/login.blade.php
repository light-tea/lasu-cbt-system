<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
<meta charset="UTF-8">
<title>Student Login — LASU CBT Portal</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

<style>
body{
    font-family:'DM Sans',sans-serif;
    background:
        radial-gradient(circle at top left, rgba(96,165,250,0.18), transparent 35%),
        radial-gradient(circle at bottom right, rgba(59,130,246,0.12), transparent 35%),
        #f4f9ff;
}

.syne{font-family:'Syne',sans-serif;}

.glass{
    background:rgba(255,255,255,0.75);
    backdrop-filter:blur(18px);
    border:1px solid rgba(255,255,255,0.7);
}

.btn-primary{
    background:linear-gradient(135deg,#2563eb,#3b82f6);
}
</style>
</head>

<body class="min-h-screen flex flex-col">

<!-- TOP NAV -->
<header class="border-b border-blue-100 bg-white/70 backdrop-blur-xl">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">

        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold">
                🎓
            </div>

            <div>
                <h1 class="font-extrabold syne text-lg text-slate-800">
                    LASUSTECH CBT Portal
                </h1>
                <p class="text-xs text-slate-500">
                    Secure Examination System
                </p>
            </div>
        </div>

        <a href="/" class="text-sm text-slate-600 hover:text-blue-600">
            ← Back Home
        </a>

    </div>
</header>

<!-- MAIN WRAPPER -->
<main class="flex-1 flex items-center justify-center px-6 py-12">

<div class="max-w-6xl w-full grid lg:grid-cols-2 gap-12 items-center">

    <!-- LEFT PANEL (FIXED HEIGHT CONTROL) -->
    <div class="hidden lg:block space-y-8">

        <!-- BADGE -->
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-xs font-bold uppercase tracking-widest">
            <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
            Academic Verification Portal
        </div>

        <!-- TITLE -->
        <h2 class="syne text-5xl font-extrabold leading-[1.1] text-slate-900">
            Secure Student <br>
            <span class="text-blue-600">Authentication System</span>
        </h2>

        <p class="text-slate-600 leading-relaxed text-base max-w-xl">
            Access your CBT examinations through a secure biometric-enabled system designed
            for academic integrity and institutional reliability.
        </p>

        <!-- FEATURES (CONTROLLED SIZE) -->
        <div class="grid grid-cols-2 gap-4">

            <div class="glass p-5 rounded-2xl">
                <div class="text-2xl">🔐</div>
                <h3 class="font-semibold text-slate-800 mt-2">Face Verification</h3>
                <p class="text-xs text-slate-500 mt-1">Secure identity validation before exams</p>
            </div>

            <div class="glass p-5 rounded-2xl">
                <div class="text-2xl">⏱</div>
                <h3 class="font-semibold text-slate-800 mt-2">Timed CBT</h3>
                <p class="text-xs text-slate-500 mt-1">Auto-submit & controlled exam duration</p>
            </div>

        </div>

    </div>

    <!-- LOGIN CARD -->
    <div class="w-full max-w-md mx-auto">

        <div class="glass rounded-3xl p-8 shadow-xl">

            <!-- HEADER -->
            <div class="mb-6 text-center lg:text-left">

                <h2 class="text-3xl font-extrabold syne text-slate-800">
                    Student Login
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Enter your credentials to continue
                </p>

            </div>

            <!-- ERRORS -->
            @if ($errors->any())
                <div class="mb-5 bg-red-100 border border-red-200 text-red-600 p-3 rounded-xl text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- FORM -->
            <form method="POST" action="/student/login">
                @csrf

                <div class="mb-4">
                    <label class="text-sm text-slate-700">Matric Number</label>
                    <input type="text"
                        name="matric_no"
                        placeholder="e.g 210401234"
                        class="w-full mt-1 px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 outline-none"
                        required>
                </div>

                <div class="mb-6">
                    <label class="text-sm text-slate-700">Password</label>
                    <input type="password"
                        name="password"
                        class="w-full mt-1 px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-400 outline-none"
                        required>
                </div>

                <button class="w-full btn-primary py-3 rounded-xl text-white font-bold shadow-md">
                    Login to Portal
                </button>
            </form>

            <p class="text-center text-sm text-slate-500 mt-5">
                New student?
                <a href="/student/register" class="text-blue-600 font-semibold">
                    Create account
                </a>
            </p>

        </div>

        <p class="text-center text-xs text-slate-400 mt-5">
            LASUSTECH CBT Examination System
        </p>

    </div>

</div>

</main>

</body>
</html>