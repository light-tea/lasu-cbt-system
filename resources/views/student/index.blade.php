<!DOCTYPE html>
<html>
<head>
    <title>Student Exams</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 p-10">

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-6">
        Available Exams
    </h2>

    @foreach($exams as $exam)

        <div class="border p-4 rounded mb-4">

            <h3 class="text-lg font-semibold">
                {{ $exam->title }}
            </h3>

            <p class="text-sm text-gray-600">
                Duration: {{ $exam->duration }} minutes
            </p>

            <form method="POST" action="/student/exams/{{ $exam->id }}/start">
                @csrf

                <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded">
                    Start Exam
                </button>

            </form>

        </div>

    @endforeach

</div>

</body>
</html>