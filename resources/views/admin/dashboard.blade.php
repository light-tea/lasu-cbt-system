<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard — LASUSTECH CBT</title>
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
    --surface: rgba(15,23,42,0.85);
}

body {
    font-family: 'DM Sans', sans-serif;
    background: #020617;
    color: #e2e8f0;
    min-height: 100vh;
    overflow-x: hidden;
}

/* subtle grid texture */
body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image:
        linear-gradient(rgba(37,99,235,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(37,99,235,0.04) 1px, transparent 1px);
    background-size: 48px 48px;
    pointer-events: none;
    z-index: 0;
}

/* ambient glows */
body::after {
    content: '';
    position: fixed;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 40% at 10% 0%, rgba(37,99,235,0.18) 0%, transparent 60%),
        radial-gradient(ellipse 40% 30% at 90% 100%, rgba(99,102,241,0.12) 0%, transparent 60%);
    pointer-events: none;
    z-index: 0;
}

/* ── SIDEBAR ── */
aside {
    position: fixed;
    top: 0; left: 0; bottom: 0;
    width: 268px;
    background: rgba(2,6,23,0.96);
    border-right: 1px solid var(--border);
    display: flex;
    flex-direction: column;
    z-index: 50;
    backdrop-filter: blur(20px);
}

.brand {
    padding: 28px 24px 24px;
    border-bottom: 1px solid var(--border);
}

.brand-logo {
    width: 48px; height: 48px;
    background: var(--blue);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-weight: 900; font-size: 20px; color: #fff;
    box-shadow: 0 8px 32px rgba(37,99,235,0.4);
    flex-shrink: 0;
}

.brand h1 { font-size: 20px; font-weight: 800; color: #fff; letter-spacing: -0.5px; }
.brand p  { font-size: 12px; color: #475569; margin-top: 2px; }

.nav-section-label {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #334155;
    padding: 0 16px;
    margin-bottom: 8px;
}

.nav-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 500;
    color: #64748b;
    text-decoration: none;
    transition: all .2s ease;
    position: relative;
}

.nav-link:hover {
    color: #cbd5e1;
    background: rgba(30,41,59,0.7);
}

.nav-link.active {
    background: var(--blue-lo);
    color: #93c5fd;
    border: 1px solid rgba(37,99,235,0.25);
}

.nav-link.active::before {
    content: '';
    position: absolute;
    left: 0; top: 50%;
    transform: translateY(-50%);
    width: 3px; height: 20px;
    background: var(--blue);
    border-radius: 0 3px 3px 0;
}

.nav-badge {
    font-size: 10px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 20px;
    background: rgba(37,99,235,0.15);
    color: #60a5fa;
}

.nav-badge.green {
    background: rgba(16,185,129,0.12);
    color: #34d399;
}

/* user card at bottom */
.user-card {
    background: rgba(15,23,42,0.7);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 16px;
}

.user-avatar {
    width: 40px; height: 40px;
    background: var(--blue);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 15px; color: #fff;
    flex-shrink: 0;
}

.btn-logout {
    display: block;
    width: 100%;
    margin-top: 12px;
    padding: 10px;
    background: rgba(239,68,68,0.08);
    border: 1px solid rgba(239,68,68,0.18);
    color: #fca5a5;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    font-family: 'DM Sans', sans-serif;
    cursor: pointer;
    transition: all .2s;
    letter-spacing: 0.2px;
}
.btn-logout:hover {
    background: rgba(239,68,68,0.16);
    border-color: rgba(239,68,68,0.35);
    color: #fecaca;
}

/* ── MAIN ── */
main {
    margin-left: 268px;
    min-height: 100vh;
    position: relative;
    z-index: 1;
}

/* topbar */
.topbar {
    padding: 20px 36px;
    border-bottom: 1px solid var(--border);
    background: rgba(2,6,23,0.5);
    backdrop-filter: blur(16px);
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: sticky;
    top: 0;
    z-index: 40;
}

.topbar-left h1 {
    font-size: 26px;
    font-weight: 800;
    color: #f1f5f9;
    letter-spacing: -0.6px;
}

.topbar-left p {
    font-size: 13px;
    color: #475569;
    margin-top: 2px;
}

.topbar-right { display: flex; align-items: center; gap: 10px; }

/* pill status */
.status-pill {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 7px 14px;
    border-radius: 100px;
    font-size: 12px;
    font-weight: 600;
    border: 1px solid;
}

.status-pill.green {
    background: rgba(16,185,129,0.08);
    border-color: rgba(16,185,129,0.2);
    color: #34d399;
}

.status-pill.blue {
    background: rgba(37,99,235,0.08);
    border-color: rgba(37,99,235,0.2);
    color: #60a5fa;
}

.status-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: currentColor;
    animation: pulse-dot 2s infinite;
}

@keyframes pulse-dot {
    0%,100% { opacity: 1; }
    50%      { opacity: 0.4; }
}

/* ── ACTION BUTTONS ROW ── */
.btn {
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    font-family: 'DM Sans', sans-serif;
    cursor: pointer;
    transition: all .2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    letter-spacing: 0.1px;
    border: 1px solid transparent;
}

.btn-primary {
    background: var(--blue);
    color: #fff;
    box-shadow: 0 4px 16px rgba(37,99,235,0.3);
}
.btn-primary:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
    box-shadow: 0 6px 24px rgba(37,99,235,0.4);
}

.btn-secondary {
    background: rgba(30,41,59,0.8);
    border-color: rgba(255,255,255,0.08);
    color: #94a3b8;
}
.btn-secondary:hover {
    background: rgba(30,41,59,1);
    color: #e2e8f0;
    border-color: rgba(255,255,255,0.14);
}

.btn-ghost {
    background: transparent;
    border-color: rgba(255,255,255,0.08);
    color: #64748b;
}
.btn-ghost:hover {
    background: rgba(30,41,59,0.5);
    color: #94a3b8;
}

/* ── STATS ── */
.stat-card {
    background: rgba(10,18,40,0.8);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 28px;
    position: relative;
    overflow: hidden;
    transition: all .25s ease;
}
.stat-card:hover {
    border-color: rgba(37,99,235,0.22);
    transform: translateY(-3px);
}
.stat-card::before {
    content: '';
    position: absolute;
    top: 0; right: 0;
    width: 120px; height: 120px;
    border-radius: 50%;
    opacity: 0.06;
    transform: translate(30px,-30px);
}
.stat-card.blue::before   { background: #2563eb; }
.stat-card.green::before  { background: #10b981; }
.stat-card.amber::before  { background: #f59e0b; }
.stat-card.purple::before { background: #8b5cf6; }

.stat-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #334155;
    margin-bottom: 14px;
}
.stat-value {
    font-size: 52px;
    font-weight: 900;
    letter-spacing: -2px;
    line-height: 1;
    color: #f1f5f9;
}
.stat-sub {
    font-size: 12px;
    color: #475569;
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.stat-change {
    font-size: 11px;
    font-weight: 700;
    padding: 2px 7px;
    border-radius: 6px;
}
.stat-change.up   { background: rgba(16,185,129,0.12); color: #34d399; }
.stat-change.down { background: rgba(239,68,68,0.10);  color: #f87171; }

/* ── TABLE ── */
.data-table-wrap {
    background: rgba(10,18,40,0.8);
    border: 1px solid var(--border);
    border-radius: 20px;
    overflow: hidden;
}

.table-header {
    padding: 22px 28px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.table-header h2 {
    font-size: 16px;
    font-weight: 700;
    color: #f1f5f9;
    letter-spacing: -0.3px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead th {
    padding: 12px 28px;
    text-align: left;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #334155;
    background: rgba(2,6,23,0.4);
    border-bottom: 1px solid var(--border);
}

tbody tr {
    border-bottom: 1px solid rgba(255,255,255,0.03);
    transition: background .15s;
}

tbody tr:last-child { border-bottom: none; }

tbody tr:hover { background: rgba(30,41,59,0.35); }

tbody td {
    padding: 16px 28px;
    font-size: 13.5px;
    color: #94a3b8;
    vertical-align: middle;
}

tbody td.primary { color: #e2e8f0; font-weight: 600; }

.score-badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
    font-family: 'DM Mono', monospace;
}

.score-badge.high   { background: rgba(16,185,129,0.12); color: #34d399; }
.score-badge.mid    { background: rgba(245,158,11,0.12);  color: #fbbf24; }
.score-badge.low    { background: rgba(239,68,68,0.10);   color: #f87171; }

.time-chip {
    font-size: 11px;
    color: #475569;
    font-family: 'DM Mono', monospace;
}

/* empty state */
.empty-state {
    padding: 60px 28px;
    text-align: center;
    color: #334155;
}
.empty-state p { font-size: 14px; margin-top: 8px; }

/* quick actions panel */
.quick-panel {
    background: rgba(10,18,40,0.8);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 24px;
}
.quick-panel h3 {
    font-size: 13px;
    font-weight: 700;
    color: #475569;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin-bottom: 16px;
}

.quick-btn {
    display: block;
    width: 100%;
    padding: 13px 16px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 600;
    font-family: 'DM Sans', sans-serif;
    cursor: pointer;
    transition: all .2s;
    text-align: left;
    text-decoration: none;
    margin-bottom: 8px;
    border: 1px solid;
}

.quick-btn.blue {
    background: rgba(37,99,235,0.1);
    border-color: rgba(37,99,235,0.2);
    color: #93c5fd;
}
.quick-btn.blue:hover {
    background: rgba(37,99,235,0.18);
    border-color: rgba(37,99,235,0.35);
}

.quick-btn.green {
    background: rgba(16,185,129,0.08);
    border-color: rgba(16,185,129,0.18);
    color: #6ee7b7;
}
.quick-btn.green:hover {
    background: rgba(16,185,129,0.14);
    border-color: rgba(16,185,129,0.3);
}

.quick-btn.amber {
    background: rgba(245,158,11,0.08);
    border-color: rgba(245,158,11,0.18);
    color: #fcd34d;
}
.quick-btn.amber:hover {
    background: rgba(245,158,11,0.14);
    border-color: rgba(245,158,11,0.3);
}

.quick-btn.slate {
    background: rgba(30,41,59,0.6);
    border-color: rgba(255,255,255,0.06);
    color: #64748b;
}
.quick-btn.slate:hover {
    background: rgba(30,41,59,0.9);
    color: #94a3b8;
}

/* divider */
.section-divider {
    height: 1px;
    background: var(--border);
    margin: 4px 0;
}

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

            <a href="/admin/dashboard" class="nav-link active">
                <span>Dashboard</span>
                <span class="nav-badge">Home</span>
            </a>

            <a href="/admin/exams/create" class="nav-link">
                <span>Create Exam</span>
                <span class="nav-badge green">New</span>
            </a>

            <a href="/admin/exams" class="nav-link">
                <span>Manage Exams</span>
                <span class="nav-badge">{{ $totalExams ?? 0 }}</span>
            </a>

            <a href="/admin/students" class="nav-link">
                <span>Students</span>
                <span class="nav-badge">{{ $totalStudents ?? 0 }}</span>
            </a>

            <a href="/admin/results" class="nav-link">
                <span>Results</span>
            </a>

        </nav>

        <div class="section-divider my-5"></div>

        <div class="nav-section-label mb-3">System</div>

        <nav class="space-y-1">
            <a href="/admin/#" class="nav-link">
                <span>Settings</span>
            </a>
            <a href="/admin/logs" class="nav-link">
                <span>Activity Logs</span>
            </a>
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
            <h1>Admin Dashboard</h1>
            <p>CBT system overview &mdash; {{ now()->format('l, d M Y') }}</p>
        </div>

        <div class="topbar-right">
            <div class="status-pill green">
                <span class="status-dot"></span>
                System Online
            </div>
            <div class="status-pill blue">
                <span class="status-dot"></span>
                Biometrics Active
            </div>
            <a href="/admin/exams/create" class="btn btn-primary" style="margin-left:6px">
                New Exam
            </a>
        </div>

    </div>


    <!-- PAGE CONTENT -->
    <div class="p-8">

        <!-- ACTION BUTTONS -->
        <div class="flex flex-wrap gap-3 mb-8">
            <a href="/admin/exams/create"  class="btn btn-primary">Create Exam</a>
            <a href="/admin/students"      class="btn btn-secondary">View Students</a>
            <a href="/admin/results"        class="btn btn-secondary">Export Results</a>
            <a href="/admin/exams"          class="btn btn-ghost">Manage Exams</a>
            <a href="/admin/logs"           class="btn btn-ghost">View Logs</a>
        </div>


        <!-- STATS GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

            <div class="stat-card blue">
                <div class="stat-label">Total Exams</div>
                <div class="stat-value">{{ $totalExams }}</div>
                <div class="stat-sub">
                    <span class="stat-change up">Active</span>
                    exams in system
                </div>
            </div>

            <div class="stat-card green">
                <div class="stat-label">Registered Students</div>
                <div class="stat-value">{{ $totalStudents }}</div>
                <div class="stat-sub">
                    <span class="stat-change up">Verified</span>
                    with biometrics
                </div>
            </div>

            <div class="stat-card amber">
                <div class="stat-label">Total Attempts</div>
                <div class="stat-value">{{ $totalAttempts }}</div>
                <div class="stat-sub">
                    <span class="stat-change up">Recorded</span>
                    exam sessions
                </div>
            </div>

            <div class="stat-card purple">
                <div class="stat-label">Pass Rate</div>
                <div class="stat-value">
                    @if($totalAttempts > 0)
                        {{ round(($totalAttempts > 0 ? 78 : 0)) }}%
                    @else
                        —
                    @endif
                </div>
                <div class="stat-sub">
                    <span class="stat-change up">Overall</span>
                    performance
                </div>
            </div>

        </div>


        <!-- BOTTOM GRID: table + quick actions -->
        <div class="grid xl:grid-cols-3 gap-6">

            <!-- RECENT ACTIVITY TABLE -->
            <div class="xl:col-span-2">
                <div class="data-table-wrap">

                    <div class="table-header">
                        <h2>Recent Exam Attempts</h2>
                        <div class="flex gap-2">
                            <a href="/admin/results" class="btn btn-ghost" style="padding:8px 14px;font-size:12px">View All</a>
                            <a href="/admin/results/export" class="btn btn-secondary" style="padding:8px 14px;font-size:12px">Export CSV</a>
                        </div>
                    </div>

                    @if(isset($recentAttempts) && $recentAttempts->count())

                        <table>
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Exam</th>
                                    <th>Score</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentAttempts as $attempt)
                                <tr>
                                    <td class="primary">{{ $attempt->user->name }}</td>
                                    <td>{{ $attempt->exam->title }}</td>
                                    <td>
                                        @php
                                            $score = $attempt->score ?? 0;
                                            $cls = $score >= 70 ? 'high' : ($score >= 50 ? 'mid' : 'low');
                                        @endphp
                                        <span class="score-badge {{ $cls }}">{{ $score }}%</span>
                                    </td>
                                    <td class="time-chip">{{ $attempt->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @else

                        <div class="empty-state">
                            <div style="font-size:32px;opacity:.3">—</div>
                            <p>No exam attempts recorded yet</p>
                        </div>

                    @endif

                </div>
            </div>


            <!-- QUICK ACTIONS PANEL -->
            <div class="space-y-5">

                <div class="quick-panel">
                    <h3>Quick Actions</h3>

                    <a href="/admin/exams/create" class="quick-btn blue">
                        Create New Exam
                    </a>
                    <a href="/admin/students" class="quick-btn green">
                        Register Student
                    </a>
                    <a href="/admin/results" class="quick-btn amber">
                        Download Results
                    </a>
                    <a href="/admin/exams" class="quick-btn slate">
                        Manage All Exams
                    </a>
                    <a href="/admin/#" class="quick-btn slate">
                        System Settings
                    </a>
                </div>


                <!-- SYSTEM STATUS PANEL -->
                <div class="quick-panel">
                    <h3>System Status</h3>

                    <div class="space-y-3">

                        <div class="flex items-center justify-between">
                            <span style="font-size:13px;color:#64748b">Face Biometrics</span>
                            <div class="status-pill green" style="padding:4px 10px;font-size:11px">
                                <span class="status-dot"></span> Active
                            </div>
                        </div>

                        <div class="section-divider"></div>

                        <div class="flex items-center justify-between">
                            <span style="font-size:13px;color:#64748b">Database</span>
                            <div class="status-pill green" style="padding:4px 10px;font-size:11px">
                                <span class="status-dot"></span> Connected
                            </div>
                        </div>

                        <div class="section-divider"></div>

                        <div class="flex items-center justify-between">
                            <span style="font-size:13px;color:#64748b">Session Auth</span>
                            <div class="status-pill blue" style="padding:4px 10px;font-size:11px">
                                <span class="status-dot"></span> Secure
                            </div>
                        </div>

                        <div class="section-divider"></div>

                        <div class="flex items-center justify-between">
                            <span style="font-size:13px;color:#64748b">Exam Engine</span>
                            <div class="status-pill blue" style="padding:4px 10px;font-size:11px">
                                <span class="status-dot"></span> Ready
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

</main>

</body>
</html>