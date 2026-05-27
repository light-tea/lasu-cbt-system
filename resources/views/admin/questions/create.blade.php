<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Questions — LASU CBT Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="https://cdn.tailwindcss.com"></script>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family: system-ui;
    background:
        radial-gradient(circle at top left, rgba(37,99,235,0.15), transparent 30%),
        radial-gradient(circle at bottom right, rgba(99,102,241,0.10), transparent 30%),
        #020617;
    color:white;
    min-height:100vh;
}

.glass{
    background: rgba(15,23,42,0.82);
    backdrop-filter: blur(18px);
    border:1px solid rgba(255,255,255,0.06);
}

.nav-link{
    transition:.2s ease;
}

.nav-link:hover{
    background: rgba(30,41,59,0.85);
}

.nav-link.active{
    background:#2563eb;
    color:white;
    box-shadow: 0 10px 30px rgba(37,99,235,0.25);
}

</style>

</head>

<body>

<div class="flex min-h-screen">

<!-- SIDEBAR -->
<aside class="w-72 bg-slate-950/95 border-r border-slate-800 hidden lg:flex flex-col">

    <!-- BRAND -->
    <div class="p-8 border-b border-slate-800">

        <div class="flex items-center gap-4">

            <div class="w-14 h-14 rounded-2xl bg-blue-600 flex items-center justify-center text-white font-black text-xl shadow-2xl">
                L
            </div>

            <div>

                <h1 class="text-2xl font-black text-white">
                    LASUSTECH CBT
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Admin Panel
                </p>

            </div>

        </div>

    </div>

    <!-- NAV -->
    <div class="flex-1 p-6">

        <p class="text-xs uppercase tracking-widest text-slate-500 font-bold mb-5 px-3">
            Main Navigation
        </p>

        <nav class="space-y-3">

            <a href="/admin/dashboard"
               class="nav-link flex items-center justify-between px-5 py-4 rounded-2xl text-slate-300 font-medium">

                <span>Dashboard</span>
                <span class="text-xs text-slate-500">Overview</span>

            </a>

            <a href="/admin/exams/create"
               class="nav-link flex items-center justify-between px-5 py-4 rounded-2xl text-slate-300 font-medium">

                <span>Create Exam</span>
                <span class="text-xs text-slate-500">New</span>

            </a>

            <a href="/admin/exams"
               class="nav-link flex items-center justify-between px-5 py-4 rounded-2xl text-slate-300 font-medium">

                <span>Manage Exams</span>
                <span class="text-xs text-slate-500">Records</span>

            </a>

            <a href="/admin/students"
               class="nav-link flex items-center justify-between px-5 py-4 rounded-2xl text-slate-300 font-medium">

                <span>Students</span>
                <span class="text-xs text-slate-500">Users</span>

            </a>

            <a href="/admin/results"
               class="nav-link flex items-center justify-between px-5 py-4 rounded-2xl text-slate-300 font-medium">

                <span>Results</span>
                <span class="text-xs text-slate-500">Reports</span>

            </a>

        </nav>

    </div>

    <!-- ADMIN + LOGOUT -->
    <div class="p-6 border-t border-slate-800">

        <div class="glass rounded-2xl p-4">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl bg-blue-600 flex items-center justify-center font-black text-white">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>

                    <div class="font-bold text-white">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="text-xs text-slate-500 mt-1">
                        System Administrator
                    </div>

                </div>

            </div>

            <form method="POST" action="/admin/logout" class="mt-4">
                @csrf

                <button
                    class="w-full bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 text-red-300 py-3 rounded-xl text-sm font-semibold transition">

                    Logout

                </button>
            </form>

        </div>

    </div>

</aside>

<!-- MAIN -->
<main class="flex-1 overflow-hidden">

    <!-- HEADER -->
    <div class="border-b border-slate-800 bg-slate-950/50 backdrop-blur-xl">

        <div class="max-w-7xl mx-auto px-8 py-6">

            <h1 class="text-4xl font-black text-white">
                Question Builder
            </h1>

            <p class="text-slate-500 mt-2">
                Exam: <span class="text-blue-400">{{ $exam->title }}</span>
            </p>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="p-8">

        <div class="max-w-3xl">

            @if(session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500 text-green-300 p-4 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="glass rounded-[30px] p-8">

                <form method="POST" action="/admin/exams/{{ $exam->id }}/questions" class="space-y-6">
                    @csrf

                    <!-- QUESTION -->
                    <div>
                        <label class="text-sm text-slate-400">Question</label>

                        <textarea name="question"
                            rows="3"
                            placeholder="Enter question..."
                            class="mt-2 w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500"
                            required></textarea>
                    </div>

                    <!-- OPTIONS -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <input name="option_a" placeholder="Option A"
                            class="bg-slate-950 border border-slate-800 rounded-xl px-4 py-3">

                        <input name="option_b" placeholder="Option B"
                            class="bg-slate-950 border border-slate-800 rounded-xl px-4 py-3">

                        <input name="option_c" placeholder="Option C"
                            class="bg-slate-950 border border-slate-800 rounded-xl px-4 py-3">

                        <input name="option_d" placeholder="Option D"
                            class="bg-slate-950 border border-slate-800 rounded-xl px-4 py-3">

                    </div>

                    <!-- CORRECT ANSWER -->
                    <div>
                        <label class="text-sm text-slate-400">Correct Answer</label>

                        <select name="correct_answer"
                            class="mt-2 w-full bg-slate-950 border border-slate-800 rounded-xl px-4 py-3 text-white">

                            <option value="A">Option A</option>
                            <option value="B">Option B</option>
                            <option value="C">Option C</option>
                            <option value="D">Option D</option>

                        </select>
                    </div>

                    <!-- ACTIONS -->
                    <div class="flex flex-col md:flex-row gap-3 pt-2">

                        <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 transition py-3 rounded-xl font-semibold">

                            Save & Add Next Question

                        </button>

                        <a href="/admin/exams"
                            class="flex-1 text-center bg-slate-800 hover:bg-slate-700 py-3 rounded-xl">

                            Finish

                        </a>

                        <a href="/admin/dashboard"
                            class="flex-1 text-center border border-slate-700 text-slate-300 hover:bg-slate-800 py-3 rounded-xl">

                            Dashboard

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</main>

</div>

</body>
</html>