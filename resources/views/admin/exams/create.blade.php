<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Exam — LASUSTECH CBT Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800;900&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

:root {
    --blue:    #2563eb;
    --blue-lo: rgba(37,99,235,0.12);
    --green:   #10b981;
    --amber:   #f59e0b;
    --red:     #ef4444;
    --border:  rgba(255,255,255,0.06);
}

body {
    font-family: 'DM Sans', sans-serif;
    background: #020617;
    color: #e2e8f0;
    min-height: 100vh;
    overflow-x: hidden;
}

body::before {
    content: '';
    position: fixed; inset: 0;
    background-image:
        linear-gradient(rgba(37,99,235,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(37,99,235,0.04) 1px, transparent 1px);
    background-size: 48px 48px;
    pointer-events: none; z-index: 0;
}

body::after {
    content: '';
    position: fixed; inset: 0;
    background:
        radial-gradient(ellipse 60% 40% at 10% 0%, rgba(37,99,235,0.18) 0%, transparent 60%),
        radial-gradient(ellipse 40% 30% at 90% 100%, rgba(99,102,241,0.12) 0%, transparent 60%);
    pointer-events: none; z-index: 0;
}

/* ── SIDEBAR ── */
aside {
    position: fixed; top: 0; left: 0; bottom: 0;
    width: 268px;
    background: rgba(2,6,23,0.96);
    border-right: 1px solid var(--border);
    display: flex; flex-direction: column;
    z-index: 50; backdrop-filter: blur(20px);
}

.brand { padding: 28px 24px 24px; border-bottom: 1px solid var(--border); }
.brand-logo {
    width: 48px; height: 48px; background: var(--blue);
    border-radius: 14px; display: flex; align-items: center; justify-content: center;
    font-weight: 900; font-size: 20px; color: #fff;
    box-shadow: 0 8px 32px rgba(37,99,235,0.4); flex-shrink: 0;
}
.brand h1 { font-size: 20px; font-weight: 800; color: #fff; letter-spacing: -0.5px; }
.brand p  { font-size: 12px; color: #475569; margin-top: 2px; }

.nav-section-label {
    font-size: 10px; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; color: #334155; padding: 0 16px; margin-bottom: 8px;
}

.nav-link {
    display: flex; align-items: center; justify-content: space-between;
    padding: 12px 16px; border-radius: 12px; font-size: 14px; font-weight: 500;
    color: #64748b; text-decoration: none; transition: all .2s ease; position: relative;
}
.nav-link:hover { color: #cbd5e1; background: rgba(30,41,59,0.7); }
.nav-link.active {
    background: var(--blue-lo); color: #93c5fd;
    border: 1px solid rgba(37,99,235,0.25);
}
.nav-link.active::before {
    content: ''; position: absolute; left: 0; top: 50%;
    transform: translateY(-50%); width: 3px; height: 20px;
    background: var(--blue); border-radius: 0 3px 3px 0;
}

.nav-badge {
    font-size: 10px; font-weight: 700; padding: 2px 8px;
    border-radius: 20px; background: rgba(37,99,235,0.15); color: #60a5fa;
}
.nav-badge.green { background: rgba(16,185,129,0.12); color: #34d399; }

.section-divider { height: 1px; background: var(--border); margin: 4px 0; }

.user-card {
    background: rgba(15,23,42,0.7); border: 1px solid var(--border);
    border-radius: 16px; padding: 16px;
}
.user-avatar {
    width: 40px; height: 40px; background: var(--blue); border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 15px; color: #fff; flex-shrink: 0;
}
.btn-logout {
    display: block; width: 100%; margin-top: 12px; padding: 10px;
    background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.18);
    color: #fca5a5; border-radius: 10px; font-size: 13px; font-weight: 600;
    font-family: 'DM Sans', sans-serif; cursor: pointer; transition: all .2s;
}
.btn-logout:hover { background: rgba(239,68,68,0.16); border-color: rgba(239,68,68,0.35); color: #fecaca; }

/* ── MAIN ── */
main { margin-left: 268px; min-height: 100vh; position: relative; z-index: 1; }

/* topbar */
.topbar {
    padding: 20px 36px; border-bottom: 1px solid var(--border);
    background: rgba(2,6,23,0.5); backdrop-filter: blur(16px);
    display: flex; align-items: center; justify-content: space-between;
    position: sticky; top: 0; z-index: 40;
}
.topbar-left h1 { font-size: 26px; font-weight: 800; color: #f1f5f9; letter-spacing: -0.6px; }
.topbar-left p  { font-size: 13px; color: #475569; margin-top: 2px; }
.topbar-right   { display: flex; align-items: center; gap: 10px; }

.status-pill {
    display: flex; align-items: center; gap: 7px; padding: 7px 14px;
    border-radius: 100px; font-size: 12px; font-weight: 600; border: 1px solid;
}
.status-pill.green { background: rgba(16,185,129,0.08); border-color: rgba(16,185,129,0.2); color: #34d399; }
.status-pill.blue  { background: rgba(37,99,235,0.08);  border-color: rgba(37,99,235,0.2);  color: #60a5fa; }
.status-dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; animation: pulse-dot 2s infinite; }
@keyframes pulse-dot { 0%,100%{opacity:1} 50%{opacity:.4} }

/* buttons */
.btn {
    padding: 10px 20px; border-radius: 10px; font-size: 13px; font-weight: 600;
    font-family: 'DM Sans', sans-serif; cursor: pointer; transition: all .2s ease;
    text-decoration: none; display: inline-flex; align-items: center;
    gap: 7px; letter-spacing: 0.1px; border: 1px solid transparent;
}
.btn-primary   { background: var(--blue); color: #fff; box-shadow: 0 4px 16px rgba(37,99,235,0.3); }
.btn-primary:hover { background: #1d4ed8; transform: translateY(-1px); box-shadow: 0 6px 24px rgba(37,99,235,0.4); }
.btn-secondary { background: rgba(30,41,59,0.8); border-color: rgba(255,255,255,0.08); color: #94a3b8; }
.btn-secondary:hover { background: rgba(30,41,59,1); color: #e2e8f0; }
.btn-ghost     { background: transparent; border-color: rgba(255,255,255,0.08); color: #64748b; }
.btn-ghost:hover { background: rgba(30,41,59,0.5); color: #94a3b8; }

/* ── FORM CARD ── */
.form-card {
    background: rgba(10,18,40,0.85);
    border: 1px solid var(--border);
    border-radius: 24px;
    overflow: hidden;
}

.form-card-header {
    padding: 28px 32px;
    border-bottom: 1px solid var(--border);
    background: rgba(2,6,23,0.4);
}

.form-card-header h2 {
    font-size: 18px; font-weight: 800; color: #f1f5f9; letter-spacing: -0.4px;
}

.form-card-header p {
    font-size: 13px; color: #475569; margin-top: 4px;
}

.form-body { padding: 32px; }

/* form elements */
.form-group { margin-bottom: 24px; }

.form-label {
    display: block;
    font-size: 12px; font-weight: 700; letter-spacing: 1px;
    text-transform: uppercase; color: #475569;
    margin-bottom: 10px;
}

.form-input {
    width: 100%;
    background: rgba(2,6,23,0.7);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
    padding: 13px 16px;
    font-size: 14px;
    font-family: 'DM Sans', sans-serif;
    color: #f1f5f9;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
    -webkit-appearance: none;
}

.form-input::placeholder { color: #334155; }

.form-input:focus {
    border-color: rgba(37,99,235,0.5);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.08);
}

.form-hint {
    font-size: 11px; color: #334155; margin-top: 6px;
}

/* info box */
.info-box {
    background: rgba(37,99,235,0.06);
    border: 1px solid rgba(37,99,235,0.14);
    border-radius: 14px;
    padding: 16px 20px;
    margin-bottom: 28px;
}

.info-box p {
    font-size: 13px; color: #60a5fa; line-height: 1.6;
}

.info-box strong { color: #93c5fd; font-weight: 700; }

/* steps indicator */
.steps {
    display: flex; align-items: center; gap: 0;
    margin-bottom: 32px;
}

.step {
    display: flex; align-items: center; gap: 10px; flex: 1;
}

.step-dot {
    width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 800; font-family: 'DM Mono', monospace;
    border: 1px solid;
}

.step-dot.active {
    background: var(--blue); border-color: var(--blue); color: #fff;
    box-shadow: 0 4px 14px rgba(37,99,235,0.35);
}

.step-dot.pending {
    background: rgba(30,41,59,0.6); border-color: rgba(255,255,255,0.07); color: #334155;
}

.step-label { font-size: 12px; font-weight: 600; }
.step-label.active  { color: #93c5fd; }
.step-label.pending { color: #334155; }

.step-line {
    flex: 1; height: 1px;
    background: rgba(255,255,255,0.05);
    margin: 0 10px;
}

/* error */
.error-box {
    background: rgba(239,68,68,0.08);
    border: 1px solid rgba(239,68,68,0.2);
    border-radius: 12px; padding: 14px 18px;
    font-size: 13px; color: #fca5a5;
    margin-bottom: 24px;
    display: flex; align-items: flex-start; gap: 10px;
}

/* form actions */
.form-actions {
    display: flex; align-items: center; gap: 10px;
    padding-top: 8px; flex-wrap: wrap;
}

.btn-submit {
    padding: 13px 28px; border-radius: 12px;
    font-size: 14px; font-weight: 700;
    font-family: 'DM Sans', sans-serif;
    background: var(--blue); color: #fff;
    border: none; cursor: pointer;
    box-shadow: 0 4px 20px rgba(37,99,235,0.35);
    transition: all .2s ease;
    letter-spacing: 0.2px;
}
.btn-submit:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
    box-shadow: 0 6px 28px rgba(37,99,235,0.45);
}

.btn-cancel {
    padding: 13px 24px; border-radius: 12px;
    font-size: 14px; font-weight: 600;
    font-family: 'DM Sans', sans-serif;
    background: transparent;
    border: 1px solid rgba(255,255,255,0.08);
    color: #64748b; cursor: pointer;
    transition: all .2s; text-decoration: none;
    display: inline-flex; align-items: center;
}
.btn-cancel:hover { background: rgba(30,41,59,0.6); color: #94a3b8; border-color: rgba(255,255,255,0.12); }

@media (max-width: 1024px) {
    aside { display: none; }
    main  { margin-left: 0; }
}
</style>
</head>

<body>

<!-- ════════════════ SIDEBAR ════════════════ -->
<aside>

    <div class="brand">
        <div class="flex items-center gap-3">
            <div class="brand-logo">L</div>
            <div>
                <h1>LASUSTECH CBT</h1>
                <p>Administration Panel</p>
            </div>
        </div>
    </div>

    <div class="flex-1 p-5 overflow-y-auto">

        <div class="nav-section-label mb-3">Main Navigation</div>

        <nav class="space-y-1">

            <a href="/admin/dashboard" class="nav-link">
                <span>Dashboard</span>
                <span class="nav-badge">Home</span>
            </a>

            <a href="/admin/exams/create" class="nav-link active">
                <span>Create Exam</span>
                <span class="nav-badge green">New</span>
            </a>

            <a href="/admin/exams" class="nav-link">
                <span>Manage Exams</span>
            </a>

            <a href="/admin/students" class="nav-link">
                <span>Students</span>
            </a>

            <a href="/admin/results" class="nav-link">
                <span>Results</span>
            </a>

        </nav>

        <div class="section-divider my-5"></div>

        <div class="nav-section-label mb-3">System</div>

        <nav class="space-y-1">
            <a href="/admin/#" class="nav-link"><span>Settings</span></a>
            <a href="/admin/#"     class="nav-link"><span>Activity Logs</span></a>
        </nav>

    </div>

    <div class="p-5 border-t border-slate-800/60">
        <div class="user-card">
            <div class="flex items-center gap-3">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="text-sm font-bold text-white">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">System Administrator</div>
                </div>
            </div>
            <form method="POST" action="/admin/logout">
                @csrf
                <button class="btn-logout">Log out</button>
            </form>
        </div>
    </div>

</aside>


<!-- ════════════════ MAIN ════════════════ -->
<main>

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="topbar-left">
            <h1>Create Exam</h1>
            <p>Define exam details before adding questions &mdash; {{ now()->format('l, d M Y') }}</p>
        </div>
        <div class="topbar-right">
            <div class="status-pill green">
                <span class="status-dot"></span>
                System Online
            </div>
            <div class="status-pill blue">
                <span class="status-dot"></span>
                Admin Portal
            </div>
            <a href="/admin/exams" class="btn btn-ghost" style="margin-left:6px;padding:8px 16px;font-size:13px">
                View All Exams
            </a>
        </div>
    </div>


    <div class="p-8">

        <!-- ACTION BUTTONS -->
        <div class="flex flex-wrap gap-3 mb-8">
            <a href="/admin/exams"      class="btn btn-secondary">Manage Exams</a>
            <a href="/admin/students"    class="btn btn-secondary">View Students</a>
            <a href="/admin/dashboard"   class="btn btn-ghost">Back to Dashboard</a>
        </div>


        <!-- PROGRESS STEPS -->
        <div class="steps mb-8">

            <div class="step">
                <div class="step-dot active">1</div>
                <span class="step-label active">Exam Details</span>
            </div>

            <div class="step-line"></div>

            <div class="step">
                <div class="step-dot pending">2</div>
                <span class="step-label pending">Add Questions</span>
            </div>

            <div class="step-line"></div>

            <div class="step">
                <div class="step-dot pending">3</div>
                <span class="step-label pending">Set Answers</span>
            </div>

            <div class="step-line"></div>

            <div class="step">
                <div class="step-dot pending">4</div>
                <span class="step-label pending">Publish</span>
            </div>

        </div>


        <!-- FORM CARD -->
        <div style="max-width: 680px;">

            <div class="form-card">

                <div class="form-card-header">
                    <h2>Exam Details</h2>
                    <p>Fill in the basic information for this examination</p>
                </div>

                <div class="form-body">

                    @if ($errors->any())
                        <div class="error-box">
                            <span style="font-size:16px;flex-shrink:0">⚠</span>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <form method="POST" action="/admin/exams">
                        @csrf

                        <!-- TITLE -->
                        <div class="form-group">
                            <label class="form-label" for="title">Exam Title</label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                value="{{ old('title') }}"
                                placeholder="e.g. Computer Science — 2025/2026"
                                class="form-input"
                                required
                                autocomplete="off"
                            >
                            <div class="form-hint">Use a clear, descriptive name students will recognise</div>
                        </div>

                        <!-- DURATION -->
                        <div class="form-group">
                            <label class="form-label" for="duration">Duration (Minutes)</label>
                            <input
                                type="number"
                                name="duration"
                                id="duration"
                                value="{{ old('duration') }}"
                                placeholder="e.g. 60"
                                min="1"
                                max="300"
                                class="form-input"
                                style="font-family:'DM Mono',monospace;"
                                required
                            >
                            <div class="form-hint">Minimum 1 minute &mdash; maximum 300 minutes (5 hours)</div>
                        </div>

                        <!-- INFO BOX -->
                        <div class="info-box">
                            <p>
                                <strong>Next step:</strong> After creating this exam you will be taken to the
                                question setup page where you can add questions, options, and correct answers.
                            </p>
                        </div>

                        <!-- ACTIONS -->
                        <div class="form-actions">
                            <button type="submit" class="btn-submit">
                                Create Exam
                            </button>
                            <a href="/admin/dashboard" class="btn-cancel">
                                Cancel
                            </a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</main>

</body>
</html>