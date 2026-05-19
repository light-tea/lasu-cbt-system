<!DOCTYPE html>
<html>
<head>
    <title>Manage Exams</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-slate-950 text-white min-h-screen">

<!-- TOP NAV BAR -->
<div class="border-b border-slate-800 bg-slate-900/40 backdrop-blur">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- LEFT: NAV -->
        <div class="flex items-center gap-4">

            <a href="/admin/dashboard"
               class="text-sm bg-slate-800 hover:bg-slate-700 px-4 py-2 rounded-xl transition">
                🏠 Dashboard
            </a>

            <a href="/admin/exams/create"
               class="text-sm bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-xl transition">
                + Create Exam
            </a>

        </div>

        <!-- RIGHT: BACK -->
        <a href="/admin/dashboard"
           class="text-sm text-slate-300 hover:text-white transition">
            ← Back
        </a>

    </div>
</div>

<!-- PAGE CONTENT -->
<div class="max-w-5xl mx-auto px-6 py-10">

    <!-- HEADER -->
    <div class="mb-8">

        <h1 class="text-3xl font-bold">📚 Manage Exams</h1>

        <p class="text-slate-400 text-sm mt-1">
            Total Exams: {{ $exams->total() }}
        </p>

    </div>

    <!-- LIST -->
    <div class="space-y-4">

        @forelse($exams as $exam)

            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 flex items-center justify-between">

                <div>
                    <h2 class="text-xl font-semibold">
                        {{ $exam->title }}
                    </h2>

                    <p class="text-slate-400 text-sm mt-1">
                        Duration: {{ $exam->duration }} mins
                    </p>
                </div>

                <div class="flex gap-3">

                    <a href="/admin/exams/{{ $exam->id }}/questions"
                       class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded-xl text-sm">
                        Questions
                    </a>

                </div>

            </div>

        @empty

            <div class="text-center py-16 border border-dashed border-slate-700 rounded-2xl">
                <p class="text-slate-400">No exams found.</p>

                <a href="/admin/exams/create"
                   class="inline-block mt-4 bg-blue-600 px-5 py-3 rounded-xl">
                    Create First Exam
                </a>
            </div>

        @endforelse

    </div>

    <!-- PAGINATION -->
    <div class="mt-8">
        {{ $exams->links() }}
    </div>

</div>

</body>
</html>