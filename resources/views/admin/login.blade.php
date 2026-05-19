<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Portal — LASU CBT</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family: system-ui;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:40px 20px;
            background:
                radial-gradient(circle at top left, rgba(37,99,235,0.22), transparent 30%),
                radial-gradient(circle at bottom right, rgba(59,130,246,0.12), transparent 30%),
                #020617;
            overflow:hidden;
            position:relative;
        }

        /* BACKGROUND EFFECTS */
        .bg-orb-1{
            position:absolute;
            width:450px;
            height:450px;
            background:rgba(37,99,235,0.18);
            border-radius:50%;
            top:-150px;
            left:-120px;
            filter:blur(90px);
        }

        .bg-orb-2{
            position:absolute;
            width:450px;
            height:450px;
            background:rgba(15,23,42,0.35);
            border-radius:50%;
            bottom:-150px;
            right:-120px;
            filter:blur(90px);
        }

        /* MAIN WRAPPER */
        .wrapper{
            position:relative;
            z-index:10;
            width:100%;
            max-width:1180px;
            display:grid;
            grid-template-columns:1fr 470px;
            gap:70px;
            align-items:center;
        }

        /* LEFT CONTENT */
        .left-panel{
            color:white;
        }

        .back-home{
            display:inline-block;
            margin-bottom:40px;
            color:#94a3b8;
            text-decoration:none;
            font-size:14px;
            font-weight:500;
            transition:0.2s ease;
        }

        .back-home:hover{
            color:#60a5fa;
        }

        .badge{
            display:inline-flex;
            align-items:center;
            gap:10px;
            background:rgba(37,99,235,0.08);
            border:1px solid rgba(59,130,246,0.18);
            padding:12px 18px;
            border-radius:999px;
            margin-bottom:30px;
            color:#bfdbfe;
            font-size:14px;
            font-weight:600;
        }

        .badge-dot{
            width:10px;
            height:10px;
            background:#4ade80;
            border-radius:50%;
        }

        .hero-title{
            font-size:68px;
            line-height:1.02;
            font-weight:900;
            margin-bottom:24px;
            letter-spacing:-2px;
        }

        .hero-title span{
            color:#60a5fa;
            display:block;
        }

        .hero-text{
            color:#94a3b8;
            font-size:18px;
            line-height:1.9;
            max-width:620px;
            margin-bottom:45px;
        }

        /* FEATURES */
        .features{
            display:flex;
            flex-direction:column;
            gap:24px;
        }

        .feature{
            display:flex;
            gap:18px;
            align-items:flex-start;
        }

        .feature-number{
            width:56px;
            height:56px;
            border-radius:18px;
            background:rgba(37,99,235,0.08);
            border:1px solid rgba(59,130,246,0.18);
            display:flex;
            align-items:center;
            justify-content:center;
            color:#60a5fa;
            font-size:18px;
            font-weight:800;
            flex-shrink:0;
        }

        .feature h3{
            font-size:18px;
            margin-bottom:6px;
            color:white;
        }

        .feature p{
            color:#94a3b8;
            line-height:1.7;
            font-size:14px;
        }

        /* LOGIN CARD */
        .login-card{
            background:rgba(15,23,42,0.9);
            border:1px solid rgba(255,255,255,0.06);
            border-radius:34px;
            padding:42px;
            box-shadow:
                0 25px 80px rgba(0,0,0,0.45),
                inset 0 1px 0 rgba(255,255,255,0.03);
            backdrop-filter:blur(20px);
        }

        .mobile-logo{
            display:none;
        }

        .login-card h2{
            color:white;
            font-size:36px;
            font-weight:900;
            margin-bottom:10px;
        }

        .login-subtitle{
            color:#94a3b8;
            font-size:15px;
            line-height:1.8;
            margin-bottom:35px;
        }

        /* ERROR */
        .error-box{
            background:rgba(239,68,68,0.1);
            border:1px solid rgba(239,68,68,0.2);
            color:#fca5a5;
            padding:16px 18px;
            border-radius:18px;
            margin-bottom:24px;
            font-size:14px;
        }

        /* FORM */
        .form-group{
            margin-bottom:22px;
        }

        .form-group label{
            display:block;
            color:#cbd5e1;
            font-size:14px;
            font-weight:600;
            margin-bottom:10px;
        }

        .form-control{
            width:100%;
            background:#0f172a;
            border:1px solid #334155;
            border-radius:18px;
            padding:17px 18px;
            color:white;
            font-size:15px;
            outline:none;
            transition:0.25s ease;
        }

        .form-control::placeholder{
            color:#64748b;
        }

        .form-control:focus{
            border-color:#3b82f6;
            box-shadow:0 0 0 5px rgba(59,130,246,0.14);
        }

        /* BUTTON */
        .login-btn{
            width:100%;
            border:none;
            background:#2563eb;
            color:white;
            padding:18px;
            border-radius:18px;
            font-size:15px;
            font-weight:700;
            cursor:pointer;
            transition:0.25s ease;
            margin-top:8px;
            box-shadow:0 15px 30px rgba(37,99,235,0.25);
        }

        .login-btn:hover{
            background:#1d4ed8;
            transform:translateY(-1px);
        }

        /* FOOTER */
        .footer{
            margin-top:32px;
            padding-top:24px;
            border-top:1px solid rgba(255,255,255,0.06);
            text-align:center;
            color:#64748b;
            font-size:13px;
        }

        /* RESPONSIVE */
        @media(max-width:992px){

            .wrapper{
                grid-template-columns:1fr;
                max-width:520px;
            }

            .left-panel{
                display:none;
            }

            .mobile-logo{
                display:block;
                text-align:center;
                margin-bottom:30px;
            }

            .mobile-logo-box{
                width:74px;
                height:74px;
                border-radius:24px;
                background:#2563eb;
                margin:0 auto 20px;
                display:flex;
                align-items:center;
                justify-content:center;
                color:white;
                font-size:30px;
                font-weight:900;
                box-shadow:0 15px 35px rgba(37,99,235,0.3);
            }

            .mobile-logo h1{
                color:white;
                font-size:32px;
                font-weight:900;
            }

            .mobile-logo p{
                color:#94a3b8;
                margin-top:6px;
                font-size:14px;
            }

            .login-card{
                padding:32px 26px;
            }

            .login-card h2{
                font-size:30px;
            }
        }

    </style>
</head>

<body>

    <!-- BACKGROUND -->
    <div class="bg-orb-1"></div>
    <div class="bg-orb-2"></div>

    <!-- MAIN -->
    <div class="wrapper">

        <!-- LEFT -->
        <div class="left-panel">

            <a href="/" class="back-home">
                ← Back To Homepage
            </a>

            <div class="badge">
                <div class="badge-dot"></div>
                Administrator Access Portal
            </div>

            <h1 class="hero-title">
                LASU CBT
                <span>Administration System</span>
            </h1>

            <p class="hero-text">
                Secure management platform for examination coordination,
                question administration, biometric verification,
                student monitoring, and CBT result processing.
            </p>

            <!-- FEATURES -->
            <div class="features">

                <div class="feature">

                    <div class="feature-number">
                        01
                    </div>

                    <div>
                        <h3>Secure Examination Control</h3>

                        <p>
                            Manage examinations, schedules,
                            questions, and CBT sessions securely.
                        </p>
                    </div>

                </div>

                <div class="feature">

                    <div class="feature-number">
                        02
                    </div>

                    <div>
                        <h3>Student Monitoring</h3>

                        <p>
                            Track candidate examination activities
                            and biometric verification processes.
                        </p>
                    </div>

                </div>

                <div class="feature">

                    <div class="feature-number">
                        03
                    </div>

                    <div>
                        <h3>Result Processing</h3>

                        <p>
                            Automatically process examination scores,
                            grading, and performance summaries.
                        </p>
                    </div>

                </div>

            </div>

        </div>

        <!-- LOGIN CARD -->
        <div class="login-card">

            <!-- MOBILE -->
            <div class="mobile-logo">

                <div class="mobile-logo-box">
                    L
                </div>

                <h1>LASU CBT</h1>

                <p>
                    Administrator Examination Portal
                </p>

            </div>

            <!-- TITLE -->
            <h2>
                Administrator Login
            </h2>

            <p class="login-subtitle">
                Sign in to access the CBT management dashboard
                and examination administration system.
            </p>

            <!-- ERROR -->
            @if ($errors->any())

                <div class="error-box">
                    {{ $errors->first() }}
                </div>

            @endif

            <!-- FORM -->
            <form method="POST" action="/admin/login">

                @csrf

                <!-- EMAIL -->
                <div class="form-group">

                    <label>
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter administrator email"
                        class="form-control"
                        required
                    >

                </div>

                <!-- PASSWORD -->
                <div class="form-group">

                    <label>
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter password"
                        class="form-control"
                        required
                    >

                </div>

                <!-- BUTTON -->
                <button type="submit" class="login-btn">
                    Login To Dashboard
                </button>

            </form>

            <!-- FOOTER -->
            <div class="footer">
                © {{ date('Y') }} LASU CBT Examination System
            </div>

        </div>

    </div>

</body>
</html>