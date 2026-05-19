<!DOCTYPE html>
<html>
<head>
    <title>Exam Starting</title>
</head>
<body>

<h2>Exam Started Successfully</h2>

<p>
    Your exam has been initialized. Click below to begin answering questions.
</p>

<a href="/student/exams/{{ $attempt->id }}/take">
    <button>Begin Exam</button>
</a>

</body>
</html>