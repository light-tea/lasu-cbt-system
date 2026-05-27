<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Students — LASUSTECH CBT Admin</title>
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
.nav-badge.green  { background: rgba(16,185,129,0.12); color: #34d399; }
.nav-badge.purple { background: rgba(139,92,246,0.12); color: #a78bfa; }

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
.btn-danger    { background: rgba(239,68,68,0.08); border-color: rgba(239,68,68,0.18); color: #fca5a5; }
.btn-danger:hover { background: rgba(239,68,68,0.16); border-color: rgba(239,68,68,0.35); }

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
.stat-card.purple::before { background: #8b5cf6; }
.stat-card.amber::before  { background: #f59e0b; }

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

.filter-select {
    background: rgba(2,6,23,0.6); border: 1px solid rgba(255,255,255,0.07);
    border-radius: 10px; padding: 9px 14px; font-size: 13px;
    font-family: 'DM Sans', sans-serif; color: #94a3b8; outline: none; cursor: pointer;
}

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

/* avatar cell */
.student-avatar {
    width: 38px; height: 38px; border-radius: 11px;
    background: var(--blue-lo); border: 1px solid rgba(37,99,235,0.2);
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: 14px; color: #60a5fa;
    flex-shrink: 0; font-family: 'DM Sans', sans-serif;
}

.student-name   { font-size: 14px; font-weight: 700; color: #e2e8f0; }
.student-email  { font-size: 11px; color: #475569; margin-top: 2px; }

/* matric chip */
.matric-chip {
    display: inline-block; padding: 4px 11px; border-radius: 7px;
    font-size: 12px; font-weight: 600; font-family: 'DM Mono', monospace;
    background: rgba(30,41,59,0.8); border: 1px solid rgba(255,255,255,0.07);
    color: #64748b; letter-spacing: 0.5px;
}

/* face badge */
.face-badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 4px 10px; border-radius: 7px;
    font-size: 11px; font-weight: 700;
}
.face-badge.yes { background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2); color: #34d399; }
.face-badge.no  { background: rgba(239,68,68,0.1);  border: 1px solid rgba(239,68,68,0.2);  color: #f87171; }

/* row number */
.row-num { font-size: 11px; color: #334155; font-family: 'DM Mono', monospace; }

/* date */
.date-main { font-size: 13px; font-weight: 600; color: #64748b; }
.date-time  { font-size: 11px; color: #334155; margin-top: 2px; font-family: 'DM Mono', monospace; }

/* actions */
.action-btn {
    padding: 6px 13px; border-radius: 8px; font-size: 12px; font-weight: 600;
    font-family: 'DM Sans', sans-serif; cursor: pointer; transition: all .18s;
    text-decoration: none; display: inline-flex; align-items: center; border: 1px solid;
}
.action-view   { background: rgba(37,99,235,0.08); border-color: rgba(37,99,235,0.18); color: #60a5fa; }
.action-view:hover { background: rgba(37,99,235,0.16); }
.action-delete { background: rgba(239,68,68,0.06); border-color: rgba(239,68,68,0.14); color: #f87171; }
.action-delete:hover { background: rgba(239,68,68,0.14); }

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

            <a href="/admin/exams/create" class="nav-link">
                <span>Create Exam</span>
                <span class="nav-badge green">New</span>
            </a>

            <a href="/admin/exams" class="nav-link">
                <span>Manage Exams</span>
            </a>

            <a href="/admin/students" class="nav-link active">
                <span>Students</span>
                <span class="nav-badge purple">{{ count($students) }}</span>
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
            <h1>Registered Students</h1>
            <p>CBT student registry &mdash; {{ now()->format('l, d M Y') }}</p>
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
            <a href="/admin/students/export" class="btn btn-primary" style="margin-left:6px">
                Export List
            </a>
        </div>
    </div>


    <div class="p-8">

        <!-- ACTION BUTTONS -->
        <div class="flex flex-wrap gap-3 mb-8">
            <a href="/student/register"      class="btn btn-primary">Register Student</a>
            <a href="/admin/students/export" class="btn btn-secondary">Export List</a>
            <a href="/admin/results"          class="btn btn-secondary">View Results</a>
            <a href="/admin/exams"            class="btn btn-ghost">Manage Exams</a>
            <a href="/admin/dashboard"        class="btn btn-ghost">Back to Dashboard</a>
        </div>


        <!-- STAT CARDS -->
        @php
            $total      = count($students);
            $withFace   = collect($students)->filter(fn($s) => !empty($s->face_descriptor))->count();
            $noFace     = $total - $withFace;
            $thisMonth  = collect($students)->filter(fn($s) => $s->created_at->isCurrentMonth())->count();
        @endphp

        <div class="grid grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

            <div class="stat-card blue">
                <div class="stat-label">Total Students</div>
                <div class="stat-value">{{ $total }}</div>
                <div class="stat-sub">in the registry</div>
            </div>

            <div class="stat-card green">
                <div class="stat-label">Face Registered</div>
                <div class="stat-value">{{ $withFace }}</div>
                <div class="stat-sub">biometrics enrolled</div>
            </div>

            <div class="stat-card amber">
                <div class="stat-label">No Face Data</div>
                <div class="stat-value">{{ $noFace }}</div>
                <div class="stat-sub">pending enrollment</div>
            </div>

            <div class="stat-card purple">
                <div class="stat-label">New This Month</div>
                <div class="stat-value">{{ $thisMonth }}</div>
                <div class="stat-sub">{{ now()->format('F Y') }}</div>
            </div>

        </div>


        <!-- FILTER BAR -->
        <div class="filter-bar">
            <input
                type="text"
                class="search-input"
                placeholder="Search by name or matric number..."
                id="searchInput"
                onkeyup="filterTable()"
            >
            <select class="filter-select" id="faceFilter" onchange="filterTable()">
                <option value="">All Students</option>
                <option value="yes">Face Enrolled</option>
                <option value="no">No Face Data</option>
            </select>
            <a href="/admin/students" class="btn btn-ghost" style="padding:9px 16px;font-size:12px">Reset</a>
        </div>


        <!-- TABLE -->
        <div class="table-wrap">

            <div class="table-header">
                <div>
                    <h2>Student Database</h2>
                    <p>All registered CBT users with biometric status</p>
                </div>
                <div class="flex gap-2">
                    <a href="/admin/students/export" class="btn btn-secondary" style="padding:8px 14px;font-size:12px">Export CSV</a>
                    <a href="/student/register"       class="btn btn-primary"   style="padding:8px 14px;font-size:12px">Add Student</a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table id="studentsTable">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Matric Number</th>
                            <th>Face Data</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($students as $student)

                        @php
                            $hasFace = !empty($student->face_descriptor);
                        @endphp

                        <tr
                            data-face="{{ $hasFace ? 'yes' : 'no' }}"
                            data-search="{{ strtolower($student->name) }} {{ strtolower($student->matric_no) }}"
                        >

                            <td>
                                <span class="row-num">{{ $loop->iteration }}</span>
                            </td>

                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="student-avatar">
                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="student-name">{{ $student->name }}</div>
                                        <div class="student-email">{{ $student->email ?? 'No email' }}</div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="matric-chip">{{ $student->matric_no }}</span>
                            </td>

                            <td>
                                @if($hasFace)
                                    <span class="face-badge yes">Enrolled</span>
                                @else
                                    <span class="face-badge no">Pending</span>
                                @endif
                            </td>

                            <td>
                                <div class="date-main">{{ $student->created_at->format('d M Y') }}</div>
                                <div class="date-time">{{ $student->created_at->format('h:i A') }}</div>
                            </td>

                            <td>
                                <div class="flex items-center gap-2">
                                    <a href="/admin/students/{{ $student->id }}" class="action-btn action-view">
                                        View
                                    </a>
                                    <form method="POST" action="/admin/students/{{ $student->id }}" style="display:inline"
                                          onsubmit="return confirm('Delete {{ $student->name }}? This cannot be undone.')">
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
                                    <h3>No Students Found</h3>
                                    <p>Students will appear here once they register for the CBT system.</p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>
            </div>

            @if(count($students) > 0)
            <div class="pagination">
                <span>{{ count($students) }} student{{ count($students) !== 1 ? 's' : '' }} registered</span>
                <span style="color:#334155;font-family:'DM Mono',monospace;font-size:11px">LASUSTECH CBT &mdash; Confidential</span>
            </div>
            @endif

        </div>

    </div>

</main>

<script>
function filterTable() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const face   = document.getElementById('faceFilter').value;
    const rows   = document.querySelectorAll('#studentsTable tbody tr[data-face]');

    rows.forEach(row => {
        const matchSearch = !search || row.dataset.search.includes(search);
        const matchFace   = !face   || row.dataset.face === face;
        row.style.display = (matchSearch && matchFace) ? '' : 'none';
    });
}
</script>

</body>
</html>