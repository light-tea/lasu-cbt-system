<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
<meta charset="UTF-8">
<title>LASUSTECH CBT Portal — Secure Examination System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;0,9..40,800;1,9..40,400&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

:root {
    --ink:    #0a0f1e;
    --ink2:   #1e293b;
    --muted:  #64748b;
    --faint:  #94a3b8;
    --border: #e2e8f0;
    --soft:   #f1f5f9;
    --blue:   #2563eb;
    --blue-d: #1d4ed8;
    --blue-s: #eff6ff;
    --blue-m: #dbeafe;
    --green:  #059669;
    --bg:     #ffffff;
}

html { scroll-behavior: smooth; }

body {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    color: var(--ink);
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
}

/* ── TYPOGRAPHY ── */
.serif { font-family: 'Instrument Serif', serif; }
.mono  { font-family: 'DM Mono', monospace; }

/* ── NOISE TEXTURE ── */
body::before {
    content: '';
    position: fixed; inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
    opacity: 0.018;
    pointer-events: none;
    z-index: 9999;
}

/* ── NAVBAR ── */
.navbar {
    position: fixed; top: 0; left: 0; right: 0; z-index: 100;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border);
    padding: 0 48px;
    height: 68px;
    display: flex; align-items: center; justify-content: space-between;
}

.nav-logo-mark {
    width: 40px; height: 40px; border-radius: 11px;
    background: var(--blue); display: flex; align-items: center; justify-content: center;
    color: #fff; font-weight: 800; font-size: 18px;
    box-shadow: 0 4px 14px rgba(37,99,235,0.3);
    flex-shrink: 0;
}

.nav-logo-text { font-size: 15px; font-weight: 700; color: var(--ink); letter-spacing: -0.3px; }
.nav-logo-sub  { font-size: 11px; color: var(--faint); margin-top: 1px; }

.nav-links { display: flex; align-items: center; gap: 36px; }
.nav-links a {
    font-size: 14px; font-weight: 500; color: var(--muted);
    text-decoration: none; transition: color .2s;
    position: relative;
}
.nav-links a:hover { color: var(--ink); }

.nav-links a::after {
    content: ''; position: absolute; bottom: -4px; left: 0; right: 0;
    height: 1.5px; background: var(--blue); border-radius: 2px;
    transform: scaleX(0); transition: transform .25s;
}
.nav-links a:hover::after { transform: scaleX(1); }

.nav-cta { display: flex; align-items: center; gap: 12px; }

.btn-outline {
    padding: 9px 20px; border-radius: 9px;
    border: 1.5px solid var(--border); background: transparent;
    font-size: 13px; font-weight: 600; color: var(--ink2);
    text-decoration: none; transition: all .2s;
}
.btn-outline:hover { border-color: #94a3b8; background: var(--soft); }

.btn-fill {
    padding: 9px 22px; border-radius: 9px;
    background: var(--blue); border: none;
    font-size: 13px; font-weight: 700; color: #fff;
    text-decoration: none; transition: all .2s;
    box-shadow: 0 3px 12px rgba(37,99,235,0.25);
}
.btn-fill:hover { background: var(--blue-d); transform: translateY(-1px); box-shadow: 0 5px 18px rgba(37,99,235,0.35); }

/* ── HERO ── */
.hero {
    padding-top: 68px;
    min-height: 100vh;
    display: flex; flex-direction: column; justify-content: center;
    position: relative; overflow: hidden;
}

/* grid dot background */
.hero::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(circle, #cbd5e1 1px, transparent 1px);
    background-size: 32px 32px;
    opacity: 0.5;
    pointer-events: none;
}

/* blue gradient blob */
.hero::after {
    content: '';
    position: absolute; top: -200px; right: -300px;
    width: 800px; height: 800px; border-radius: 50%;
    background: radial-gradient(circle, rgba(37,99,235,0.08) 0%, transparent 70%);
    pointer-events: none;
}

.hero-inner {
    max-width: 1200px; margin: 0 auto; padding: 80px 48px;
    display: grid; grid-template-columns: 1fr 1fr; gap: 80px;
    align-items: center; position: relative; z-index: 1;
}

/* pill badge */
.hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 6px 14px; border-radius: 100px;
    background: var(--blue-s); border: 1px solid var(--blue-m);
    font-size: 11px; font-weight: 700; letter-spacing: 1.2px;
    text-transform: uppercase; color: var(--blue);
    margin-bottom: 28px;
}
.hero-badge-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--blue); animation: blink 1.8s infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }

.hero-h1 {
    font-family: 'Instrument Serif', serif;
    font-size: clamp(44px, 5vw, 68px);
    line-height: 1.05;
    color: var(--ink);
    letter-spacing: -1.5px;
    margin-bottom: 24px;
}

.hero-h1 em {
    font-style: italic;
    color: var(--blue);
}

.hero-desc {
    font-size: 17px; line-height: 1.7; color: var(--muted);
    max-width: 480px; margin-bottom: 40px;
}

.hero-btns { display: flex; gap: 14px; flex-wrap: wrap; margin-bottom: 56px; }

.hero-btn-main {
    padding: 15px 32px; border-radius: 12px;
    background: var(--blue); color: #fff;
    font-size: 14px; font-weight: 700;
    text-decoration: none; transition: all .25s;
    box-shadow: 0 4px 18px rgba(37,99,235,0.3);
    display: inline-flex; align-items: center; gap: 8px;
}
.hero-btn-main:hover { background: var(--blue-d); transform: translateY(-2px); box-shadow: 0 8px 28px rgba(37,99,235,0.4); }

.hero-btn-ghost {
    padding: 15px 32px; border-radius: 12px;
    background: var(--soft); border: 1.5px solid var(--border);
    color: var(--ink2); font-size: 14px; font-weight: 600;
    text-decoration: none; transition: all .2s;
    display: inline-flex; align-items: center; gap: 8px;
}
.hero-btn-ghost:hover { background: var(--blue-s); border-color: #bfdbfe; color: var(--blue); }

/* stats row */
.hero-stats { display: flex; gap: 40px; border-top: 1px solid var(--border); padding-top: 32px; }
.stat-val { font-size: 28px; font-weight: 800; color: var(--ink); letter-spacing: -0.8px; font-family: 'Instrument Serif', serif; }
.stat-label { font-size: 12px; color: var(--faint); margin-top: 3px; font-weight: 500; }

/* hero right */
.hero-visual {
    position: relative;
}

.hero-img-wrap {
    border-radius: 28px; overflow: hidden;
    border: 1px solid var(--border);
    box-shadow: 0 24px 80px rgba(10,15,30,0.12), 0 2px 8px rgba(10,15,30,0.06);
}

.hero-img-wrap img {
    width: 100%; height: 520px;
    object-fit: cover; display: block;
}

/* floating verified card */
.verified-card {
    position: absolute; bottom: 28px; left: -32px;
    background: #fff; border: 1px solid var(--border);
    border-radius: 18px; padding: 16px 20px;
    box-shadow: 0 12px 40px rgba(10,15,30,0.12);
    display: flex; align-items: center; gap: 14px;
    animation: float 4s ease-in-out infinite;
}
@keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }

.verified-icon {
    width: 46px; height: 46px; border-radius: 14px;
    background: #dcfce7; display: flex; align-items: center; justify-content: center;
    font-size: 20px; flex-shrink: 0;
}
.verified-title { font-size: 14px; font-weight: 700; color: var(--ink); }
.verified-sub   { font-size: 12px; color: var(--muted); margin-top: 2px; }

/* exam count card */
.exam-card-float {
    position: absolute; top: 28px; right: -28px;
    background: var(--blue); border-radius: 18px; padding: 16px 22px;
    box-shadow: 0 10px 32px rgba(37,99,235,0.35);
    animation: float 4s ease-in-out infinite; animation-delay: 1s;
}
.exam-count { font-size: 30px; font-weight: 800; color: #fff; font-family: 'Instrument Serif', serif; line-height: 1; }
.exam-count-label { font-size: 11px; color: rgba(255,255,255,0.7); margin-top: 4px; font-weight: 500; letter-spacing: 0.5px; }

/* ── STRIP ── */
.strip {
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    background: var(--soft);
    padding: 18px 48px;
}
.strip-inner {
    max-width: 1200px; margin: 0 auto;
    display: flex; flex-wrap: wrap; justify-content: center; gap: 0;
}
.strip-item {
    display: flex; align-items: center; gap: 8px;
    font-size: 13px; font-weight: 600; color: var(--muted);
    padding: 6px 28px; position: relative;
}
.strip-item::after {
    content: ''; position: absolute; right: 0; top: 50%;
    transform: translateY(-50%); width: 1px; height: 16px;
    background: var(--border);
}
.strip-item:last-child::after { display: none; }
.strip-dot { width: 5px; height: 5px; border-radius: 50%; background: var(--blue); flex-shrink: 0; }

/* ── FEATURES ── */
.features { padding: 120px 48px; background: #fff; }
.features-inner { max-width: 1200px; margin: 0 auto; }

.section-eyebrow {
    font-size: 11px; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; color: var(--blue); margin-bottom: 16px;
    display: flex; align-items: center; gap: 8px;
}
.section-eyebrow::before {
    content: ''; width: 24px; height: 1.5px; background: var(--blue);
}

.section-h2 {
    font-family: 'Instrument Serif', serif;
    font-size: clamp(36px, 4vw, 52px);
    color: var(--ink); letter-spacing: -1px; line-height: 1.1;
    margin-bottom: 16px;
}

.section-sub {
    font-size: 17px; color: var(--muted); max-width: 560px; line-height: 1.65;
    margin-bottom: 64px;
}

/* feature grid */
.feature-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 24px; }

.feat-card {
    border-radius: 24px; padding: 36px;
    border: 1px solid var(--border);
    transition: all .3s ease;
    position: relative; overflow: hidden;
}
.feat-card:hover { transform: translateY(-6px); box-shadow: 0 20px 60px rgba(10,15,30,0.08); border-color: #bfdbfe; }

.feat-card.featured {
    background: var(--ink);
    border-color: transparent;
}

.feat-icon {
    width: 56px; height: 56px; border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; margin-bottom: 24px;
    background: var(--blue-s); border: 1px solid var(--blue-m);
}

.feat-card.featured .feat-icon { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.15); }

.feat-h3 { font-size: 18px; font-weight: 700; color: var(--ink); margin-bottom: 12px; line-height: 1.3; }
.feat-card.featured .feat-h3 { color: #fff; }

.feat-p { font-size: 14px; color: var(--muted); line-height: 1.7; }
.feat-card.featured .feat-p { color: rgba(255,255,255,0.55); }

/* learn more link */
.feat-link {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 13px; font-weight: 600; color: var(--blue);
    text-decoration: none; margin-top: 20px; transition: gap .2s;
}
.feat-link:hover { gap: 10px; }
.feat-card.featured .feat-link { color: rgba(255,255,255,0.6); }

/* ── HOW IT WORKS ── */
.how { padding: 120px 48px; background: var(--soft); }
.how-inner { max-width: 1200px; margin: 0 auto; }

.steps-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-top: 64px; }

.step-card {
    background: #fff; border: 1px solid var(--border);
    border-radius: 20px; padding: 32px 28px;
    transition: all .25s; position: relative;
}
.step-card:hover { transform: translateY(-4px); box-shadow: 0 16px 48px rgba(10,15,30,0.08); }

.step-num {
    font-family: 'DM Mono', monospace;
    font-size: 11px; font-weight: 500;
    color: var(--blue); letter-spacing: 1px;
    margin-bottom: 20px; display: block;
    background: var(--blue-s); border: 1px solid var(--blue-m);
    padding: 4px 10px; border-radius: 6px; width: fit-content;
}

.step-h3 { font-size: 16px; font-weight: 700; color: var(--ink); margin-bottom: 10px; }
.step-p  { font-size: 13px; color: var(--muted); line-height: 1.65; }

/* connector */
.step-card::after {
    content: '→';
    position: absolute; right: -16px; top: 50%;
    transform: translateY(-50%);
    font-size: 18px; color: #cbd5e1; font-weight: 300;
    z-index: 2;
}
.step-card:last-child::after { display: none; }

/* ── ABOUT ── */
.about {
    padding: 120px 48px; background: #fff;
    border-top: 1px solid var(--border);
}
.about-inner {
    max-width: 1200px; margin: 0 auto;
    display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center;
}

.about-tag {
    display: inline-block; padding: 5px 14px; border-radius: 100px;
    background: var(--blue-s); border: 1px solid var(--blue-m);
    font-size: 11px; font-weight: 700; letter-spacing: 1px;
    text-transform: uppercase; color: var(--blue); margin-bottom: 20px;
}

.about-h2 {
    font-family: 'Instrument Serif', serif;
    font-size: clamp(32px, 3.5vw, 48px);
    color: var(--ink); letter-spacing: -1px; line-height: 1.15; margin-bottom: 20px;
}

.about-p { font-size: 16px; color: var(--muted); line-height: 1.75; margin-bottom: 16px; }

/* about stats */
.about-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-top: 36px; }

.about-stat {
    background: var(--soft); border: 1px solid var(--border);
    border-radius: 16px; padding: 20px;
}
.about-stat-val   { font-size: 26px; font-weight: 800; color: var(--ink); font-family: 'Instrument Serif', serif; }
.about-stat-label { font-size: 12px; color: var(--faint); margin-top: 4px; font-weight: 500; }

/* about right: image */
.about-img-wrap {
    border-radius: 24px; overflow: hidden;
    border: 1px solid var(--border);
    box-shadow: 0 20px 60px rgba(10,15,30,0.1);
}
.about-img-wrap img { width: 100%; height: 460px; object-fit: cover; display: block; }

/* ── CTA BANNER ── */
.cta-banner {
    margin: 0 48px 80px;
    border-radius: 28px;
    background: var(--ink);
    padding: 72px 80px;
    display: flex; align-items: center; justify-content: space-between; gap: 40px;
    position: relative; overflow: hidden;
}

.cta-banner::before {
    content: '';
    position: absolute; top: -100px; right: -100px;
    width: 400px; height: 400px; border-radius: 50%;
    background: radial-gradient(circle, rgba(37,99,235,0.35) 0%, transparent 70%);
    pointer-events: none;
}

.cta-banner::after {
    content: '';
    position: absolute; bottom: -80px; left: 200px;
    width: 300px; height: 300px; border-radius: 50%;
    background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%);
    pointer-events: none;
}

.cta-label {
    font-size: 11px; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; color: #60a5fa; margin-bottom: 14px;
}
.cta-h2 {
    font-family: 'Instrument Serif', serif;
    font-size: clamp(28px, 3vw, 42px);
    color: #fff; letter-spacing: -0.8px; line-height: 1.15;
    margin-bottom: 12px;
}
.cta-p { font-size: 15px; color: rgba(255,255,255,0.5); max-width: 440px; line-height: 1.65; }

.cta-btns { display: flex; flex-direction: column; gap: 12px; flex-shrink: 0; z-index: 1; }

.cta-btn-main {
    padding: 16px 36px; border-radius: 12px;
    background: var(--blue); color: #fff;
    font-size: 14px; font-weight: 700;
    text-decoration: none; transition: all .2s;
    text-align: center; white-space: nowrap;
    box-shadow: 0 4px 18px rgba(37,99,235,0.35);
}
.cta-btn-main:hover { background: #1d4ed8; transform: translateY(-1px); }

.cta-btn-ghost {
    padding: 14px 36px; border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.05);
    color: rgba(255,255,255,0.7); font-size: 14px; font-weight: 600;
    text-decoration: none; transition: all .2s; text-align: center;
}
.cta-btn-ghost:hover { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.22); color: #fff; }

/* ── FOOTER ── */
footer {
    background: var(--ink);
    border-top: 1px solid rgba(255,255,255,0.06);
    padding: 60px 48px 40px;
}
.footer-inner { max-width: 1200px; margin: 0 auto; }

.footer-top {
    display: flex; justify-content: space-between; align-items: flex-start;
    padding-bottom: 40px; border-bottom: 1px solid rgba(255,255,255,0.07); gap: 40px; flex-wrap: wrap;
}

.footer-brand-name { font-size: 18px; font-weight: 800; color: #fff; letter-spacing: -0.4px; }
.footer-brand-sub  { font-size: 13px; color: rgba(255,255,255,0.4); margin-top: 4px; }

.footer-links { display: flex; gap: 32px; }
.footer-links a {
    font-size: 13px; color: rgba(255,255,255,0.45); text-decoration: none; transition: color .2s;
}
.footer-links a:hover { color: #fff; }

.footer-bottom {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 28px; flex-wrap: wrap; gap: 12px;
}
.footer-copy { font-size: 12px; color: rgba(255,255,255,0.25); }
.footer-mono { font-family: 'DM Mono', monospace; font-size: 11px; color: rgba(255,255,255,0.2); letter-spacing: 0.5px; }

/* ── RESPONSIVE ── */
@media (max-width: 1024px) {
    .hero-inner     { grid-template-columns: 1fr; gap: 48px; padding: 60px 24px; }
    .hero-visual    { display: none; }
    .feature-grid   { grid-template-columns: 1fr; }
    .steps-grid     { grid-template-columns: 1fr 1fr; }
    .about-inner    { grid-template-columns: 1fr; }
    .about-img-wrap { display: none; }
    .cta-banner     { flex-direction: column; margin: 0 24px 60px; padding: 48px 36px; }
    .navbar         { padding: 0 24px; }
    .nav-links      { display: none; }
    footer          { padding: 48px 24px 32px; }
}

@media (max-width: 640px) {
    .steps-grid { grid-template-columns: 1fr; }
    .strip-item::after { display: none; }
    .features   { padding: 80px 24px; }
    .how        { padding: 80px 24px; }
    .about      { padding: 80px 24px; }
}

/* ── ANIMATIONS ── */
.fade-up {
    opacity: 0; transform: translateY(28px);
    animation: fadeUp .7s ease forwards;
}
.fade-up:nth-child(1) { animation-delay: .1s; }
.fade-up:nth-child(2) { animation-delay: .22s; }
.fade-up:nth-child(3) { animation-delay: .34s; }
.fade-up:nth-child(4) { animation-delay: .46s; }

@keyframes fadeUp {
    to { opacity: 1; transform: translateY(0); }
}
</style>
</head>

<body>

<!-- ═══════════════ NAVBAR ═══════════════ -->
<header class="navbar">

    <a href="/" style="display:flex;align-items:center;gap:12px;text-decoration:none">
        <div class="nav-logo-mark">L</div>
        <div>
            <div class="nav-logo-text">LASUSTECH CBT Portal</div>
            <div class="nav-logo-sub">Secure Examination System</div>
        </div>
    </a>

    <nav class="nav-links">
        <a href="#features">Features</a>
        <a href="#how">How It Works</a>
        <a href="#about">About</a>
    </nav>

    <div class="nav-cta">
        <a href="{{ url('/student/login') }}"    class="btn-outline">Student Login</a>
        <a href="{{ url('/student/register') }}" class="btn-fill">Register Now</a>
    </div>

</header>


<!-- ═══════════════ HERO ═══════════════ -->
<section class="hero">

    <div class="hero-inner">

        <!-- LEFT -->
        <div>

            <div class="hero-badge fade-up">
                <span class="hero-badge-dot"></span>
                Biometric-Based CBT System
            </div>

            <h1 class="hero-h1 fade-up">
                Secure<br>
                Computer-Based<br>
                <em>Examination</em><br>
                Portal
            </h1>

            <p class="hero-desc fade-up">
                A modern online examination platform built for institutions — combining
                timed CBT examinations with facial biometric verification for complete
                student authentication.
            </p>

            <div class="hero-btns fade-up">
                <a href="{{ url('/student/login') }}"    class="hero-btn-main">
                    Student Login &rarr;
                </a>
                <a href="{{ url('/student/register') }}" class="hero-btn-ghost">
                    Create Account
                </a>
            </div>

            <div class="hero-stats fade-up">
                <div>
                    <div class="stat-val">24/7</div>
                    <div class="stat-label">System availability</div>
                </div>
                <div>
                    <div class="stat-val">CBT</div>
                    <div class="stat-label">Online examination</div>
                </div>
                <div>
                    <div class="stat-val">AI</div>
                    <div class="stat-label">Face verification</div>
                </div>
            </div>

        </div>

        <!-- RIGHT: VISUAL -->
        <div class="hero-visual">

            <!-- Top-right floating card -->
            <div class="exam-card-float">
                <div class="exam-count">100%</div>
                <div class="exam-count-label">SECURE &amp; VERIFIED</div>
            </div>

            <div class="hero-img-wrap">
                <img
                    src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1200"
                    alt="Students taking computer-based exam"
                >
            </div>

            <!-- Bottom-left verified card -->
            <div class="verified-card">
                <div class="verified-icon">✅</div>
                <div>
                    <div class="verified-title">Student Verified</div>
                    <div class="verified-sub">Facial biometric matched</div>
                </div>
            </div>

        </div>

    </div>

</section>


<!-- ═══════════════ STRIP ═══════════════ -->
<div class="strip">
    <div class="strip-inner">
        <div class="strip-item"><span class="strip-dot"></span> Secure Student Authentication</div>
        <div class="strip-item"><span class="strip-dot"></span> Timed CBT Examination</div>
        <div class="strip-item"><span class="strip-dot"></span> Automated Result Processing</div>
        <div class="strip-item"><span class="strip-dot"></span> Facial Biometric Verification</div>
        <div class="strip-item"><span class="strip-dot"></span> Instant Score Report</div>
        <div class="strip-item"><span class="strip-dot"></span> University CBT Portal</div>
    </div>
</div>


<!-- ═══════════════ FEATURES ═══════════════ -->
<section id="features" class="features">
    <div class="features-inner">

        <div class="section-eyebrow">System Features</div>
        <h2 class="section-h2">Built for secure,<br>efficient examinations</h2>
        <p class="section-sub">
            Every component is designed to support institutions in conducting
            trustworthy online assessments at scale.
        </p>

        <div class="feature-grid">

            <div class="feat-card">
                <div class="feat-icon">🧠</div>
                <h3 class="feat-h3">Online CBT Examination</h3>
                <p class="feat-p">Students take timed objective examinations online with automatic submission when time expires.</p>
                <a href="#how" class="feat-link">How it works →</a>
            </div>

            <div class="feat-card featured">
                <div class="feat-icon">🔐</div>
                <h3 class="feat-h3">Facial Biometric Verification</h3>
                <p class="feat-p">face-api.js powers real-time face matching against stored descriptors before any exam begins, preventing impersonation.</p>
                <a href="#how" class="feat-link">Learn more →</a>
            </div>

            <div class="feat-card">
                <div class="feat-icon">⚡</div>
                <h3 class="feat-h3">Instant Result Processing</h3>
                <p class="feat-p">Objective questions are auto-graded immediately on submission — scores, grades, and reports are available in seconds.</p>
                <a href="#about" class="feat-link">See grading →</a>
            </div>

            <div class="feat-card">
                <div class="feat-icon">🛡️</div>
                <h3 class="feat-h3">Session Security</h3>
                <p class="feat-p">Every session is protected with Laravel authentication and a face-verified session flag that guards the exam dashboard.</p>
            </div>

            <div class="feat-card">
                <div class="feat-icon">📊</div>
                <h3 class="feat-h3">Admin Analytics</h3>
                <p class="feat-p">Admins get a full dashboard with student records, attempt history, score distributions, and CSV exports.</p>
            </div>

            <div class="feat-card">
                <div class="feat-icon">📱</div>
                <h3 class="feat-h3">Device Flexible</h3>
                <p class="feat-p">The portal works on laptops and desktops — anywhere with a webcam for biometric capture and a stable browser.</p>
            </div>

        </div>

    </div>
</section>


<!-- ═══════════════ HOW IT WORKS ═══════════════ -->
<section id="how" class="how">
    <div class="how-inner">

        <div class="section-eyebrow">How It Works</div>
        <h2 class="section-h2">From registration<br>to results — in four steps</h2>

        <div class="steps-grid">

            <div class="step-card">
                <span class="step-num">STEP 01</span>
                <h3 class="step-h3">Register & Enroll</h3>
                <p class="step-p">Students create an account with their matric number, set a password, and capture their face biometric data during registration.</p>
            </div>

            <div class="step-card">
                <span class="step-num">STEP 02</span>
                <h3 class="step-h3">Login & Verify</h3>
                <p class="step-p">On exam day, students log in with their credentials then complete a live facial match against their stored descriptor.</p>
            </div>

            <div class="step-card">
                <span class="step-num">STEP 03</span>
                <h3 class="step-h3">Take the Exam</h3>
                <p class="step-p">Once verified, students access timed CBT examinations and answer objective questions before the countdown completes.</p>
            </div>

            <div class="step-card">
                <span class="step-num">STEP 04</span>
                <h3 class="step-h3">Get Your Result</h3>
                <p class="step-p">Submissions are auto-graded. Scores, percentage, and grade are calculated instantly and stored in the results database.</p>
            </div>

        </div>

    </div>
</section>


<!-- ═══════════════ ABOUT ═══════════════ -->
<section id="about" class="about">
    <div class="about-inner">

        <div>
            <span class="about-tag">Final Year Project</span>
            <h2 class="about-h2">An Academic Examination Platform</h2>
            <p class="about-p">
                This project focuses on the design and implementation of a secure
                computer-based testing platform that integrates facial biometric authentication
                to improve examination integrity and student identity verification.
            </p>
            <p class="about-p">
                Built with Laravel, MySQL, and face-api.js, the system handles
                the full examination lifecycle — from student registration through
                to admin result reporting.
            </p>

            <div class="about-stats">
                <div class="about-stat">
                    <div class="about-stat-val">Laravel</div>
                    <div class="about-stat-label">Backend framework</div>
                </div>
                <div class="about-stat">
                    <div class="about-stat-val">face-api</div>
                    <div class="about-stat-label">Biometric engine</div>
                </div>
                <div class="about-stat">
                    <div class="about-stat-val">MySQL</div>
                    <div class="about-stat-label">Data storage</div>
                </div>
                <div class="about-stat">
                    <div class="about-stat-val">CBT</div>
                    <div class="about-stat-label">Exam delivery</div>
                </div>
            </div>
        </div>

        <div class="about-img-wrap">
            <img
                src="https://images.unsplash.com/photo-1588072432836-e10032774350?q=80&w=1200"
                alt="University campus"
            >
        </div>

    </div>
</section>


<!-- ═══════════════ CTA BANNER ═══════════════ -->
<div class="cta-banner">
    <div style="position:relative;z-index:1">
        <div class="cta-label">Get Started Today</div>
        <h2 class="cta-h2">Ready to take your<br>examination?</h2>
        <p class="cta-p">Register your account, enroll your face biometric, and access your upcoming CBT examinations.</p>
    </div>
    <div class="cta-btns">
        <a href="{{ url('/student/register') }}" class="cta-btn-main">Register as Student</a>
        <a href="{{ url('/student/login') }}"    class="cta-btn-ghost">Already have an account</a>
    </div>
</div>


<!-- ═══════════════ FOOTER ═══════════════ -->
<footer>
    <div class="footer-inner">

        <div class="footer-top">
            <div>
                <div class="footer-brand-name">LASUSTECH CBT Portal</div>
                <div class="footer-brand-sub">Biometric-Based Examination System</div>
            </div>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Support</a>
                <a href="#">Contact</a>
                <a href="{{ url('/student/login') }}">Student Login</a>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="footer-copy">&copy; {{ date('Y') }} LASUSTECH CBT Portal. </div>
            <div class="footer-mono">LASUSTECH &mdash; SECURE CBT SYSTEM</div>
        </div>

    </div>
</footer>

</body>
</html>