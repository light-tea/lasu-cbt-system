<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Take Exam - LASU CBT Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background:#f3f7ff; font-family:system-ui; }
        .question-nav.active { background:#2563eb; color:white; border-color:#2563eb; }
        .question-nav.answered { background:#dcfce7; border-color:#22c55e; color:#166534; }
        .question-nav.active.answered { background:#2563eb; color:white; border-color:#2563eb; }
        .option-card { transition:0.2s ease; }
        .option-card:hover { border-color:#60a5fa; background:#eff6ff; }
        .option-card.selected { border-color:#2563eb; background:#dbeafe; }
    </style>
</head>
<body class="h-screen overflow-hidden">

<header class="h-16 bg-white border-b flex items-center justify-between px-6 shadow-sm">
    <div class="flex items-center gap-4">
        <a href="/student/dashboard" class="text-sm font-medium text-slate-500 hover:text-blue-600 transition">
            &larr; Dashboard
        </a>
        <div class="hidden md:block h-6 w-px bg-slate-200"></div>
        <div>
            <h1 class="font-bold text-slate-800">{{ $attempt->exam->title }}</h1>
            <p class="text-xs text-slate-500">Secure CBT Examination</p>
        </div>
    </div>
    <div class="flex items-center gap-4">
        <div class="hidden md:flex items-center gap-2 bg-blue-50 border border-blue-100 px-3 py-2 rounded-xl">
            <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
            <span class="text-sm font-medium text-slate-700">Exam Active</span>
        </div>
        <div class="bg-red-500 text-white px-4 py-2 rounded-xl font-bold shadow-lg">
            Time Left: <span id="time">00:00</span>
        </div>
    </div>
</header>

<div class="grid grid-cols-12 h-[calc(100vh-64px)]">

    <aside class="col-span-2 bg-white border-r overflow-y-auto p-4">
        <div class="mb-4">
            <h2 class="font-bold text-slate-800">Questions</h2>
            <p class="text-xs text-slate-500">Navigate through exam</p>
        </div>
        <div class="grid grid-cols-3 gap-2">
            @foreach($questions->values() as $qIndex => $q)
                <button type="button" onclick="goToQuestion({{ $qIndex }})" id="nav-{{ $qIndex }}"
                    class="question-nav border rounded-xl h-12 text-sm font-semibold hover:bg-blue-50 transition">
                    {{ $qIndex + 1 }}
                </button>
            @endforeach
        </div>
        <div class="mt-8 space-y-3 text-xs">
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded bg-blue-600"></div>
                <span class="text-slate-600">Current</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded bg-green-100 border border-green-400"></div>
                <span class="text-slate-600">Answered</span>
            </div>
        </div>
    </aside>

    <main class="col-span-8 overflow-y-auto p-8">
        <form id="examForm" method="POST" action="/student/exams/submit">
            @csrf
            <input type="hidden" name="attempt_id" value="{{ $attempt->id }}">

            @foreach($questions->values() as $qIndex => $q)
                <div class="question-block" style="display:none" data-index="{{ $qIndex }}">
                    <div class="bg-white rounded-3xl border shadow-sm p-8">
                        <div class="flex items-start justify-between mb-8">
                            <div>
                                <p class="text-sm font-semibold text-blue-600 mb-2">Question {{ $qIndex + 1 }}</p>
                                <h2 class="text-2xl font-bold text-slate-800 leading-relaxed">{{ $q->question }}</h2>
                            </div>
                        </div>
                        <div class="space-y-4">
                            @foreach(['A','B','C','D'] as $opt)
                                <label class="option-card flex items-start gap-4 border border-slate-200 rounded-2xl p-5 cursor-pointer">
                                    <input type="radio" name="answers[{{ $q->id }}]" value="{{ $opt }}"
                                    
                                        onchange="markAnswered({{ $qIndex }}, this)" class="mt-1 w-4 h-4">
                                    <div>
                                        <div class="font-bold text-slate-700 mb-1">Option {{ $opt }}</div>
                                        <div class="text-slate-600 leading-relaxed">{{ $q->{'option_'.strtolower($opt)} }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-8 flex items-center justify-between">
                <button type="button" onclick="prevQuestion()"
                    class="px-6 py-3 rounded-xl border bg-white hover:bg-slate-50 font-semibold">
                    &larr; Previous
                </button>
                <button type="button" onclick="nextQuestion()"
                    class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold">
                    Next &rarr;
                </button>
            </div>

            <div class="mt-10 text-center">
                <button type="button" onclick="submitExam()"
                    class="bg-green-600 hover:bg-green-700 text-white px-10 py-4 rounded-2xl font-bold shadow-lg">
                    Submit Examination
                </button>
            </div>
        </form>
    </main>

    <aside class="col-span-2 bg-white border-l p-5">
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5">
            <h3 class="font-bold text-slate-800 mb-3">Exam Instructions</h3>
            <ul class="space-y-3 text-sm text-slate-600">
                <li>Read all questions carefully</li>
                <li>Timer auto-submits exam</li>
                <li>Click question numbers to navigate</li>
                <li>Green questions are answered</li>
            </ul>
        </div>
        <div class="mt-6 bg-white border rounded-2xl p-5">
            <p class="text-sm text-slate-500 mb-2">Progress</p>
            <div class="text-3xl font-bold text-slate-800">
                <span id="answeredCount">0</span> / {{ $questions->count() }}
            </div>
            <p class="text-xs text-slate-400 mt-1">Questions Answered</p>
        </div>
    </aside>

</div>

<script>
let duration          = {{ (int)($attempt->exam->duration > 0 ? $attempt->exam->duration : 60) }} * 60;
let currentQuestion   = 0;
let totalQuestions    = {{ $questions->count() }};
let answeredQuestions = new Set();
let examSubmitted     = false;

function submitExam() {
    if (examSubmitted) return;
    examSubmitted = true;
    window.onbeforeunload = null;
    document.getElementById('examForm').submit();
}

function startTimer() {
    const timer = document.getElementById('time');
    const interval = setInterval(function() {
        if (duration <= 0) {
            clearInterval(interval);
            window.onbeforeunload = null;
            document.getElementById('examForm').submit();
            return;
        }
        let minutes = Math.floor(duration / 60);
        let seconds = duration % 60;
        timer.innerText = minutes + ':' + (seconds < 10 ? '0' + seconds : seconds);
        duration--;
    }, 1000);
}

function showQuestion(index) {
    document.querySelectorAll('.question-block').forEach(function(q) { q.style.display = 'none'; });
    document.querySelectorAll('.question-nav').forEach(function(n) { n.classList.remove('active'); });
    var activeQuestion = document.querySelector('.question-block[data-index="' + index + '"]');
    if (activeQuestion) activeQuestion.style.display = 'block';
    var activeNav = document.getElementById('nav-' + index);
    if (activeNav) activeNav.classList.add('active');
    currentQuestion = index;
}

function goToQuestion(index) { showQuestion(index); }

function nextQuestion() {
    if (currentQuestion < totalQuestions - 1) showQuestion(currentQuestion + 1);
}

function prevQuestion() {
    if (currentQuestion > 0) showQuestion(currentQuestion - 1);
}

function markAnswered(index, input) {
    answeredQuestions.add(index);
    document.getElementById('answeredCount').innerText = answeredQuestions.size;
    var nav = document.getElementById('nav-' + index);
    if (nav) nav.classList.add('answered');
    var questionBlock = document.querySelector('.question-block[data-index="' + index + '"]');
    if (questionBlock) {
        questionBlock.querySelectorAll('.option-card').forEach(function(card) { card.classList.remove('selected'); });
        input.closest('.option-card').classList.add('selected');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    showQuestion(0);
    startTimer();
});

window.onbeforeunload = function() {
    if (!examSubmitted) return 'Exam in progress. Are you sure you want to leave?';
};
</script>

</body>
</html>