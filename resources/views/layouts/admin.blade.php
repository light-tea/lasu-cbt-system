<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Admin - LASUSTECH CBT')</title>

@vite(['resources/css/app.css'])
</head>

<body class="bg-slate-950 text-white min-h-screen">

<!-- BACKGROUND -->
<div class="fixed inset-0 -z-10 overflow-hidden">
    <div class="absolute top-0 left-0 w-96 h-96 bg-blue-600/20 blur-3xl rounded-full"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-purple-600/20 blur-3xl rounded-full"></div>
</div>

<div class="flex">

<!-- SIDEBAR -->
<aside class="w-72 bg-slate-900 border-r border-slate-800 min-h-screen p-6 hidden md:block">

    <div class="mb-10">
        <h1 class="text-3xl font-bold">LASU CBT</h1>
        <p class="text-slate-400 text-sm mt-2">Admin Panel</p>
    </div>

    <nav class="space-y-3 text-sm">

        <a href="/admin/dashboard" class="block px-4 py-3 rounded-2xl hover:bg-slate-800">
            Dashboard
        </a>

        <a href="/admin/exams/create" class="block px-4 py-3 rounded-2xl hover:bg-slate-800">
            Create Exam
        </a>

        <a href="/admin/exams" class="block px-4 py-3 rounded-2xl hover:bg-slate-800">
            Manage Exams
        </a>

        <a href="/admin/students" class="block px-4 py-3 rounded-2xl hover:bg-slate-800">
            Students
        </a>

        <a href="/admin/results" class="block px-4 py-3 rounded-2xl hover:bg-slate-800">
            Results
        </a>

    </nav>

</aside>

<!-- MAIN -->
<main class="flex-1 p-8">

<!-- HEADER -->
<div class="flex justify-between items-start mb-10">

    <div>
        <h2 class="text-4xl font-bold">@yield('header', 'Dashboard')</h2>
        <p class="text-slate-400 mt-2">@yield('subheader')</p>
    </div>

    <form method="POST" action="/admin/logout">
        @csrf
        <button class="bg-red-500 hover:bg-red-600 px-6 py-3 rounded-2xl font-semibold">
            Logout
        </button>
    </form>

</div>

@yield('content')

</main>
</div>

</body>
</html>