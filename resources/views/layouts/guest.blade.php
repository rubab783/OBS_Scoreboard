<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>


 <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign In — ScoreCastPro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --black:     #070709;
            --deep:      #0d0d12;
            --surface:   #13131a;
            --card:      #1a1a24;
            --border:    rgba(255,255,255,0.07);
            --border-hi: rgba(255,255,255,0.14);
            --accent:    #3b82f6;
            --accent2:   #6366f1;
            --green:     #22c55e;
            --red:       #ef4444;
            --text:      #f0f0f5;
            --muted:     rgba(240,240,245,0.45);
            --dimmed:    rgba(240,240,245,0.25);
        }

        html, body { height: 100%; font-family: 'DM Sans', sans-serif; }

        body {
            background: var(--black);
            color: var(--text);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── NOISE ── */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none; z-index: 0; opacity: 0.4;
        }

        /* ══════════════════════════
           LEFT — Dark Panel
        ══════════════════════════ */
        .left-panel {
            flex: 0 0 50%;
            position: relative;
            overflow:;
            background: var(--deep);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 36px 44px;
            height: 140vh;
        }

        .left-panel::before {
            content: '';
            position: absolute; inset: 0;
            background: url('https://images.unsplash.com/photo-1508098682722-e99c43a406b2?w=1400&q=80') center/cover no-repeat;
            opacity: 0.2;
        }

        .left-panel::after {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(160deg, rgba(7,7,9,0.92) 0%, rgba(13,13,18,0.85) 50%, rgba(10,20,50,0.88) 100%);
        }

        /* Grid lines on left panel */
        .left-grid {
            position: absolute; inset: 0; z-index: 1;
            background-image:
                linear-gradient(rgba(59,130,246,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,0.04) 1px, transparent 1px);
            background-size: 50px 50px;
            mask-image: radial-gradient(ellipse 80% 80% at 30% 50%, black 20%, transparent 100%);
        }

        .left-glow {
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59,130,246,0.1) 0%, transparent 70%);
            top: -80px; left: -100px;
            pointer-events: none; z-index: 1;
        }

        .left-content {
            position: relative; z-index: 2;
            display: flex; flex-direction: column;
            height: 100%;
        }

        /* Logo */
        .logo {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 52px;
            text-decoration: none;
        }
        .logo-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--accent), #1d4ed8);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
        }
        .logo-text {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px;
            letter-spacing: 0.06em;
            color: var(--text);
        }
        .logo-text span { color: var(--green); }

        /* Scoreboard widget */
        .scoreboard-widget {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-hi);
            border-radius: 10px;
            padding: 16px 22px;
            margin-bottom: 40px;
            max-width: 420px;
        }
        .sb-labels {
            display: flex; justify-content: space-between;
            font-size: 9px; font-weight: 500;
            letter-spacing: 0.12em; text-transform: uppercase;
            color: var(--dimmed); margin-bottom: 8px;
        }
        .sb-row {
            display: flex; justify-content: space-between; align-items: center;
        }
        .sb-side { display: flex; flex-direction: column; }
        .sb-team-name { font-size: 11px; color: var(--muted); margin-bottom: 3px; letter-spacing: 0.06em; text-transform: uppercase; }
        .sb-score-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 48px; line-height: 1; color: var(--text);
        }
        .sb-center { text-align: center; }
        .sb-time {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 22px; color: var(--text); letter-spacing: 0.06em;
        }
        .sb-live-badge {
            display: inline-flex; align-items: center; gap: 5px;
            margin-top: 5px;
            font-size: 10px; font-weight: 500;
            letter-spacing: 0.1em; color: var(--red);
        }
        .live-dot {
            width: 6px; height: 6px;
            background: var(--red); border-radius: 50%;
            animation: blink 1.4s ease-in-out infinite;
        }
        @keyframes blink { 0%,100%{opacity:1;} 50%{opacity:0.3;} }

        /* Headline */
        .left-headline {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(40px, 4.5vw, 54px);
            line-height: 0.95;
            letter-spacing: 0.02em;
            margin-bottom: 28px;
        }
        .left-headline .accent { color: var(--accent); }

        /* Feature list */
        .feature-list { display: flex; flex-direction: column; gap: 14px; margin-bottom: 40px; }
        .feature-item { display: flex; align-items: center; gap: 14px; }
        .feature-icon {
            width: 32px; height: 32px; flex-shrink: 0;
            border-radius: 50%;
            border: 1px solid var(--border-hi);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
            background: rgba(59,130,246,0.08);
        }
        .feature-text { font-size: 14px; font-weight: 300; color: var(--muted); }

        /* Testimonial */
        .testimonial {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--border-hi);
            border-radius: 10px;
            padding: 22px 24px;
            margin-top: auto;
        }
        .testi-stars { color: #f59e0b; font-size: 13px; letter-spacing: 3px; margin-bottom: 10px; }
        .testi-quote { font-size: 13px; font-weight: 300; color: var(--muted); line-height: 1.65; margin-bottom: 14px; }
        .testi-author { display: flex; align-items: center; gap: 10px; }
        .testi-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; color: #fff; flex-shrink: 0;
        }
        .testi-name { font-size: 13px; font-weight: 500; color: var(--text); }
        .testi-role { font-size: 11px; color: var(--dimmed); }

        /* ══════════════════════════
           RIGHT — Form Panel
        ══════════════════════════ */
        .right-panel {
            flex: 1;
            background: var(--black);
            display: flex;
            align-items: center;
            justify-content: center;
        
            position: relative; z-index: 1;
        }

        .form-box { width: 100%; max-width: 400px; margin-top:16rem}

        .form-heading {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px;
            letter-spacing: 0.03em;
            color: var(--text);
            margin-top:30px;
            margin-bottom: 8px;
            line-height: 1;
        }
        .form-sub {
            font-size: 14px; font-weight: 300;
            color: var(--muted); margin-bottom: 28px; line-height: 1.6;
        }

        /* Error box */
        .error-box {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.3);
            border-radius: 6px;
            padding: 12px 16px;
            margin-bottom: 20px;
        }
        .error-box p { font-size: 13px; color: #fca5a5; }

        /* Social buttons */
        .social-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 20px; }

        .social-btn {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            padding: 11px 16px;
            border-radius: 6px;
            font-size: 13px; font-weight: 500;
            cursor: pointer; transition: all 0.2s;
            text-decoration: none;
        }
        .social-btn-outline {
            background: transparent;
            border: 1px solid var(--border-hi);
            color: var(--text);
        }
        .social-btn-outline:hover { border-color: rgba(255,255,255,0.3); background: rgba(255,255,255,0.04); }

        .social-btn-dark {
            background: var(--card);
            border: 1px solid var(--border-hi);
            color: var(--text);
        }
        .social-btn-dark:hover { background: rgba(255,255,255,0.08); }

        /* Divider */
        .divider {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 22px;
        }
        .divider-line { flex: 1; height: 1px; background: var(--border-hi); }
        .divider-text { font-size: 11px; color: var(--dimmed); white-space: nowrap; letter-spacing: 0.04em; }

        /* Form fields */
        .field { margin-bottom: 16px; }
        .field-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 7px; }
        .field label { display: block; font-size: 13px; font-weight: 500; color: var(--muted); }
        .field-link { font-size: 12px; color: var(--accent); text-decoration: none; font-weight: 500; }
        .field-link:hover { color: #60a5fa; }

        .input-wrap { position: relative; }
        .input-wrap input {
            width: 100%;
            padding: 12px 16px;
            background: var(--card);
            border: 1px solid var(--border-hi);
            border-radius: 6px;
            font-size: 14px; font-weight: 300;
            color: var(--text);
            outline: none;
            transition: border-color 0.2s, background 0.2s;
            font-family: 'DM Sans', sans-serif;
        }
        .input-wrap input::placeholder { color: black; }
        .input-wrap input:focus {
            border-color: rgba(59,130,246,0.6);
            background: rgba(59,130,246,0.04);
        }
        .input-wrap .eye-btn {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: var(--dimmed); font-size: 16px; padding: 4px;
            transition: color 0.2s;
        }
        .input-wrap .eye-btn:hover { color: var(--muted); }

        /* Remember me */
        .remember-row { display: flex; align-items: center; gap: 8px; margin-bottom: 22px; }
        .remember-row input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--accent);
            cursor: pointer; flex-shrink: 0;
        }
        .remember-row label { font-size: 13px; font-weight: 300; color: var(--muted); cursor: pointer; }

        /* Submit */
        .submit-btn {
            width: 100%; padding: 13px;
            background: linear-gradient(90deg, var(--accent), #2563eb);
            color: #fff; border: none; border-radius: 6px;
            font-size: 15px; font-weight: 500;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer; transition: opacity 0.2s, transform 0.15s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            margin-bottom: 20px;
            letter-spacing: 0.01em;
        }
        .submit-btn:hover { opacity: 0.9; transform: translateY(-1px); }

        /* Footer link */
        .form-footer { text-align: center; font-size: 13px; color: var(--muted); }
        .form-footer a { color: var(--accent); font-weight: 500; text-decoration: none; }
        .form-footer a:hover { color: #60a5fa; }

        /* Trust badges */
        .trust-row {
            display: flex; justify-content: center; gap: 20px;
            margin-top: 24px; padding-top: 20px;
            border-top: 1px solid var(--border);
        }
        .trust-item { font-size: 11px; color: var(--dimmed); }

        @media (max-width: 900px) {
            .left-panel { display: none; }
            .right-panel { padding: 40px 24px; }
        }
    </style>
</head>









<body>

<!-- LEFT PANEL -->
<div class="left-panel">
    <div class="left-grid"></div>
    <div class="left-glow"></div>
    <div class="left-content">

        <!-- Logo -->
        <a href="/" class="logo">
            <div class="logo-icon">⚡</div>
            <span class="logo-text">ScoreCast<span>Pro</span></span>
        </a>

        <!-- Live Scoreboard Widget -->
        <div class="scoreboard-widget">
            <div class="sb-labels">
                <span>Home</span>
                <span>Map 2 &nbsp;·&nbsp; Round 24</span>
                <span>Away</span>
            </div>
            <div class="sb-row">
                <div class="sb-side">
                    <span class="sb-team-name">Liquid</span>
                    <span class="sb-score-num">13</span>
                </div>
                <div class="sb-center">
                    <div class="sb-time">04:12</div>
                    <div class="sb-live-badge">
                        <span class="live-dot"></span> LIVE
                    </div>
                </div>
                <div class="sb-side" style="text-align:right;">
                    <span class="sb-team-name">NAVI</span>
                    <span class="sb-score-num">11</span>
                </div>
            </div>
        </div>

        <!-- Headline -->
        <h1 class="left-headline">
            Your stream deserves<br>
            <span class="accent">broadcast-quality</span><br>
            overlays.
        </h1>

        <!-- Features -->
        <div class="feature-list">
            <div class="feature-item">
                <div class="feature-icon">⏱</div>
                <span class="feature-text">Sub-50ms real-time score sync</span>
            </div>
            <div class="feature-item">
                <div class="feature-icon">🔗</div>
                <span class="feature-text">Secure, one-click OBS integration</span>
            </div>
            <div class="feature-item">
                <div class="feature-icon">⭐</div>
                <span class="feature-text">Trusted by 4,200+ streamers</span>
            </div>
        </div>

        <!-- Testimonial -->
        <div class="testimonial">
            <div class="testi-stars">★★★★★</div>
            <p class="testi-quote">
                "Set it up in 2 minutes before our first match. The overlay looked like a TV broadcast. Viewers couldn't believe it."
            </p>
            <div class="testi-author">
                <div class="testi-avatar">MJ</div>
                <div>
                    <div class="testi-name">Marcus Johnson</div>
                    <div class="testi-role">YouTube Live · 12K subscribers</div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- RIGHT PANEL -->
<div class="right-panel">
    <div class="form-box">

        <h2 class="form-heading">Welcome back 👋</h2>
        <p class="form-sub">Sign in to your ScoreCast Pro account to manage your matches and overlays.</p>

        {{-- Errors --}}
        @if ($errors->any())
        <div class="error-box">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        {{-- Session Status --}}
        @if (session('status'))
        <div style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.3);border-radius:6px;padding:12px 16px;margin-bottom:20px;">
            <p style="font-size:13px;color:#86efac;">{{ session('status') }}</p>
        </div>
        @endif

        <!-- Social Buttons -->
        <div class="social-row">
            <button class="social-btn social-btn-outline">
                <svg width="17" height="17" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                Google
            </button>
            <button class="social-btn social-btn-dark">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                GitHub
            </button>
        </div>

        <!-- Divider -->
        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">or continue with email</span>
            <div class="divider-line"></div>
        </div>

           {{ $slot }}

        <!-- Form -->
     

        <p class="form-footer">
            Don't have an account?
            <a href="{{ route('register') }}">Create one free →</a>
        </p>

        <div class="trust-row">
            <span class="trust-item">🔒 Secure login</span>
            <span class="trust-item">🌍 GDPR compliant</span>
            <span class="trust-item">✅ No spam</span>
        </div>

    </div>
</div>

<script>
    function togglePwd(inputId, btnId) {
        const input = document.getElementById(inputId);
        const btn   = document.getElementById(btnId);
        if (input.type === 'password') {
            input.type = 'text'; btn.textContent = '🙈';
        } else {
            input.type = 'password'; btn.textContent = '👁';
        }
    }
</script>

</body>
</html>
