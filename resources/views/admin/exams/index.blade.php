<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Exams — LASU CBT Admin</title>
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
.nav-badge.amber { background: rgba(245,158,11,0.12); color: #fbbf24; }

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

/* stat cards */
.stat-card {
    background: rgba(10,18,40,0.8); border: 1px solid var(--border);
    border-radius: 20px; padding: 24px; position: relative;
    overflow: hidden; transition: all .25s ease;
}
.stat-card:hover { border-color: rgba(37,99,235,0.22); transform: translateY(-3px); }
.stat-card::before {
    content: ''; position: absolute; top: 0; right: 0;
    width: 100px; height: 100px; border-radius: 50%;
    opacity: 0.07; transform: translate(25px,-25px);
}
.stat-card.blue::before   { background: #2563eb; }
.stat-card.green::before  { background: #10b981; }
.stat-card.amber::before  { background: #f59e0b; }
.stat-card.purple::before { background: #8b5cf6; }

.stat-label { font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #334155; margin-bottom: 12px; }
.stat-value { font-size: 44px; font-weight: 900; letter-spacing: -2px; line-height: 1; color: #f1f5f9; }
.stat-sub   { font-size: 12px; color: #475569; margin-top: 8px; }

/* filter bar */
.filter-bar {
    background: rgba(10,18,40,0.8); border: 1px solid var(--border);
    border-radius: 16px; padding: 16px 20px;
    display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
    margin-bottom: 20px;
}
.search-input {
    flex: 1; min-width: 220px;
    background: rgba(2,6,23,0.6); border: 1px solid rgba(255,255,255,0.07);
    border-radius: 10px; padding: 9px 14px; font-size: 13px;
    font-family: 'DM Sans', sans-serif; color: #e2e8f0; outline: none; transition: border-color .2s;
}
.search-input::placeholder { color: #334155; }
.search-input:focus { border-color: rgba(37,99,235,0.35); }



/* table */
.table-wrap {
    background: rgba(10,18,40,0.8); border: 1px solid var(--border);
    border-radius: 20px; overflow: hidden;
}
.table-header {
    padding: 22px 28px; border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px;
}
.table-header h2 { font-size: 16px; font-weight: 700; color: #f1f5f9; letter-spacing: -0.3px; }
.table-header p  { font-size: 12px; color: #475569; margin-top: 2px; }

table { width: 100%; border-collapse: collapse; }

thead th {
    padding: 13px 24px; text-align: left;
    font-size: 10px; font-weight: 700; letter-spacing: 1.5px;
    text-transform: uppercase; color: #334155;
    background: rgba(2,6,23,0.5); border-bottom: 1px solid var(--border);
}

tbody tr { border-bottom: 1px solid rgba(255,255,255,0.03); transition: background .15s; }
tbody tr:last-child { border-bottom: none; }
tbody tr:hover { background: rgba(30,41,59,0.3); }
tbody td { padding: 16px 24px; font-size: 13.5px; color: #94a3b8; vertical-align: middle; }

.row-num { font-size: 11px; color: #334155; font-family: 'DM Mono', monospace; }

.exam-icon-sm {
    width: 38px; height: 38px; border-radius: 11px; flex-shrink: 0;
    background: rgba(37,99,235,0.08); border: 1px solid rgba(37,99,235,0.15);
    display: flex; align-items: center; justify-content: center; font-size: 16px;
}

.exam-title-cell { font-size: 14px; font-weight: 700; color: #e2e8f0; }

.meta-chip {
    display: inline-flex; align-items: center; padding: 3px 10px;
    border-radius: 7px; font-size: 11px; font-weight: 600;
    font-family: 'DM Mono', monospace;
}
.meta-chip.duration  { background: rgba(37,99,235,0.08);  border: 1px solid rgba(37,99,235,0.15);  color: #60a5fa; }
.meta-chip.questions { background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.15); color: #34d399; }

.date-main { font-size: 13px; font-weight: 600; color: #64748b; }
.date-time  { font-size: 11px; color: #334155; margin-top: 2px; font-family: 'DM Mono', monospace; }

.action-btn {
    padding: 7px 14px; border-radius: 9px; font-size: 12px; font-weight: 600;
    font-family: 'DM Sans', sans-serif; cursor: pointer; transition: all .18s;
    text-decoration: none; display: inline-flex; align-items: center;
    gap: 5px; border: 1px solid; white-space: nowrap;
}
.action-questions { background: rgba(16,185,129,0.09); border-color: rgba(16,185,129,0.2); color: #34d399; }
.action-questions:hover { background: rgba(16,185,129,0.18); border-color: rgba(16,185,129,0.35); }
.action-edit  { background: rgba(37,99,235,0.08); border-color: rgba(37,99,235,0.2); color: #60a5fa; }
.action-edit:hover { background: rgba(37,99,235,0.16); border-color: rgba(37,99,235,0.35); }
.action-delete { background: rgba(239,68,68,0.06); border-color: rgba(239,68,68,0.14); color: #f87171; }
.action-delete:hover { background: rgba(239,68,68,0.14); border-color: rgba(239,68,68,0.3); }

/* empty state */
.empty-state { padding: 80px 28px; text-align: center; }
.empty-state h3 { font-size: 20px; font-weight: 800; color: #1e293b; margin-top: 12px; }
.empty-state p  { font-size: 13px; color: #334155; margin-top: 6px; }

/* pagination strip */
.pagination {
    padding: 16px 24px; border-top: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
    font-size: 12px; color: #475569;
}

/* Laravel pagination override */
.pagination-wrap { margin-top: 28px; display: flex; justify-content: center; }
.pagination-wrap nav { display: flex; gap: 6px; align-items: center; }

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
                <h1>LASU CBT</h1>
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

            <a href="/admin/exams/create" class="nav-link">
                <span>Create Exam</span>
                <span class="nav-badge green">New</span>
            </a>

            <a href="/admin/exams" class="nav-link active">
                <span>Manage Exams</span>
                <span class="nav-badge amber">{{ $exams->total() }}</span>
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
            <h1>Manage Exams</h1>
            <p>{{ $exams->total() }} exam{{ $exams->total() !== 1 ? 's' : '' }} in the system &mdash; {{ now()->format('l, d M Y') }}</p>
        </div>
        <div class="topbar-right">
            <div class="status-pill green">
                <span class="status-dot"></span>
                System Online
            </div>
            <a href="/admin/exams/create" class="btn btn-primary" style="margin-left:6px">
                Create Exam
            </a>
        </div>
    </div>


    <div class="p-8">

        <!-- ACTION BUTTONS -->
        <div class="flex flex-wrap gap-3 mb-8">
            <a href="/admin/exams/create" class="btn btn-primary">Create New Exam</a>
            <a href="/admin/students"      class="btn btn-secondary">View Students</a>
            <a href="/admin/results"        class="btn btn-secondary">View Results</a>
            <a href="/admin/dashboard"      class="btn btn-ghost">Back to Dashboard</a>
        </div>


        <!-- STAT CARDS -->
        <div class="grid grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

            <div class="stat-card blue">
                <div class="stat-label">Total Exams</div>
                <div class="stat-value">{{ $exams->total() }}</div>
                <div class="stat-sub">in the system</div>
            </div>

            <div class="stat-card green">
                <div class="stat-label">This Page</div>
                <div class="stat-value">{{ $exams->count() }}</div>
                <div class="stat-sub">currently showing</div>
            </div>

            <div class="stat-card amber">
                <div class="stat-label">Current Page</div>
                <div class="stat-value">{{ $exams->currentPage() }}</div>
                <div class="stat-sub">of {{ $exams->lastPage() }} pages</div>
            </div>

            <div class="stat-card purple">
                <div class="stat-label">Per Page</div>
                <div class="stat-value">{{ $exams->perPage() }}</div>
                <div class="stat-sub">exams per page</div>
            </div>

        </div>


        <!-- FILTER BAR -->
        <div class="filter-bar">
            <input
                type="text"
                class="search-input"
                placeholder="Search exam title..."
                id="searchInput"
                onkeyup="filterExams()"
            >
            <a href="/admin/exams" class="btn btn-ghost" style="padding:9px 16px;font-size:12px">Reset</a>
        </div>


        <!-- EXAM TABLE -->
        <div class="table-wrap">

            <div class="table-header">
                <div>
                    <h2>Examination Records</h2>
                    <p>All CBT exams in the system</p>
                </div>
                <div class="flex gap-2">
                    <a href="/admin/exams/create" class="btn btn-primary" style="padding:8px 16px;font-size:12px">
                        Create Exam
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table id="examTable">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Exam Title</th>
                            <th>Duration</th>
                            <th>Questions</th>
                            <th>Created</th>
                            <th style="text-align:right">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($exams as $exam)

                        <tr data-title="{{ strtolower($exam->title) }}">

                            <td>
                                <span class="row-num">{{ $loop->iteration }}</span>
                            </td>

                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="exam-icon-sm">📋</div>
                                    <div>
                                        <div class="exam-title-cell">{{ $exam->title }}</div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="meta-chip duration">{{ $exam->duration }} mins</span>
                            </td>

                            <td>
                                <span class="meta-chip questions">
                                    {{ $exam->questions_count ?? '—' }} questions
                                </span>
                            </td>

                            <td>
                                <div class="date-main">{{ $exam->created_at->format('d M Y') }}</div>
                                <div class="date-time">{{ $exam->created_at->format('h:i A') }}</div>
                            </td>

                            <td style="text-align:right">
                                <div class="flex items-center justify-end gap-2">

                                    <a href="/admin/exams/{{ $exam->id }}/questions"
                                       class="action-btn action-questions">
                                        Questions
                                    </a>

                                    <a href="/admin/exams/{{ $exam->id }}/edit"
                                       class="action-btn action-edit">
                                        Edit
                                    </a>

                                    <form method="POST" action="/admin/exams/{{ $exam->id }}"
                                          onsubmit="return confirm('Delete \'{{ $exam->title }}\'? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn action-delete">Delete</button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div style="font-size:40px;opacity:.2;color:#475569">—</div>
                                    <h3>No Exams Yet</h3>
                                    <p>Create your first exam to get started.</p>
                                    <a href="/admin/exams/create" class="btn btn-primary" style="margin-top:16px">
                                        Create First Exam
                                    </a>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>
            </div>

            @if($exams->total() > 0)
            <div class="pagination">
                <span>{{ $exams->total() }} exam{{ $exams->total() !== 1 ? 's' : '' }} total</span>
                <span style="color:#334155;font-family:'DM Mono',monospace;font-size:11px">LASU CBT &mdash; Confidential</span>
            </div>
            @endif

        </div>


        <!-- PAGINATION -->
        <div class="pagination-wrap">
            {{ $exams->links() }}
        </div>

    </div>

</main>

<script>
function filterExams() {
    const q    = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('#examList .exam-card');
    cards.forEach(card => {
        card.style.display = !q || card.dataset.title.includes(q) ? '' : 'none';
    });
}
</script>

</body>
</html>