<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scorify — Live Sports Broadcasting</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --black:    #070709;
            --deep:     #0d0d12;
            --surface:  #13131a;
            --card:     #1a1a24;
            --border:   rgba(255,255,255,0.07);
            --border-hi: rgba(255,255,255,0.14);
            --accent:   #3b82f6;
            --accent2:  #6366f1;
            --green:    #22c55e;
            --amber:    #f59e0b;
            --red:      #ef4444;
            --text:     #f0f0f5;
            --muted:    rgba(240,240,245,0.45);
            --dimmed:   rgba(240,240,245,0.25);
            --display:  'Bebas Neue', sans-serif;
            --body:     'DM Sans', sans-serif;
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--black);
            color: var(--text);
            font-family: var(--body);
            font-size: 16px;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ─── NOISE TEXTURE OVERLAY ─── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: 0.4;
        }

        /* ─── REUSABLE ─── */
        .container { max-width: 1180px; margin: 0 auto; padding: 0 28px; position: relative; z-index: 1; }

        .label {
            display: inline-block;
            font-family: var(--body);
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--accent);
            border: 1px solid rgba(59,130,246,0.3);
            padding: 5px 12px;
            border-radius: 2px;
            margin-bottom: 20px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--accent);
            color: #fff;
            font-family: var(--body);
            font-size: 14px;
            font-weight: 500;
            padding: 13px 26px;
            border-radius: 3px;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
            border: none;
            cursor: pointer;
        }
        .btn-primary:hover { background: #2563eb; transform: translateY(-1px); }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: var(--text);
            font-family: var(--body);
            font-size: 14px;
            font-weight: 400;
            padding: 13px 26px;
            border-radius: 3px;
            border: 1px solid var(--border-hi);
            text-decoration: none;
            transition: border-color 0.2s, transform 0.15s;
        }
        .btn-ghost:hover { border-color: rgba(255,255,255,0.35); transform: translateY(-1px); }

        /* ─── NAVBAR ─── */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 0 28px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(7,7,9,0.85);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
        }

        .nav-logo {
            font-family: var(--display);
            font-size: 22px;
            letter-spacing: 0.05em;
            color: var(--text);
            text-decoration: none;
        }
        .nav-logo span { color: var(--accent); }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
            list-style: none;
        }
        .nav-links a {
            font-size: 13px;
            font-weight: 400;
            color: var(--muted);
            text-decoration: none;
            transition: color 0.2s;
        }
        .nav-links a:hover { color: var(--text); }

        .nav-actions { display: flex; align-items: center; gap: 10px; }

        .nav-login {
            font-size: 13px;
            font-weight: 400;
            color: var(--muted);
            text-decoration: none;
            padding: 8px 16px;
            transition: color 0.2s;
        }
        .nav-login:hover { color: var(--text); }

        .nav-cta {
            font-size: 13px;
            font-weight: 500;
            color: #fff;
            text-decoration: none;
            background: var(--accent);
            padding: 8px 18px;
            border-radius: 3px;
            transition: background 0.2s;
        }
        .nav-cta:hover { background: #2563eb; }

        @media (max-width: 768px) {
            .nav-links { display: none; }
        }

        /* ─── HERO ─── */
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            padding: 120px 28px 80px;
            overflow: hidden;
        }

        /* Grid lines background */
        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(59,130,246,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(59,130,246,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%);
        }

        /* Glow orbs */
        .hero-glow-1 {
            position: absolute;
            width: 600px; height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(59,130,246,0.12) 0%, transparent 70%);
            top: -100px; left: -150px;
            pointer-events: none;
        }
        .hero-glow-2 {
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99,102,241,0.08) 0%, transparent 70%);
            bottom: 0; right: -100px;
            pointer-events: none;
        }

        .hero-inner {
            max-width: 1180px;
            margin: 0 auto;
            width: 100%;
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(59,130,246,0.1);
            border: 1px solid rgba(59,130,246,0.25);
            padding: 6px 14px 6px 8px;
            border-radius: 999px;
            font-size: 12px;
            color: #93bbfc;
            margin-bottom: 32px;
        }
        .hero-badge-dot {
            width: 6px; height: 6px;
            background: var(--green);
            border-radius: 50%;
            box-shadow: 0 0 6px var(--green);
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.3); }
        }

        .hero-title {
            font-family: var(--display);
            font-size: clamp(72px, 10vw, 128px);
            line-height: 0.92;
            letter-spacing: 0.02em;
            margin-bottom: 28px;
        }
        .hero-title .line2 { color: var(--accent); }
        .hero-title .line3 { color: var(--muted); font-size: 0.7em; }

        .hero-sub {
            font-size: 17px;
            font-weight: 300;
            color: var(--muted);
            max-width: 520px;
            line-height: 1.7;
            margin-bottom: 40px;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 64px;
        }

        /* Live scoreboard preview */
        .hero-scoreboard {
            background: var(--surface);
            border: 1px solid var(--border-hi);
            border-radius: 6px;
            padding: 14px 20px;
            display: inline-flex;
            align-items: center;
            gap: 0;
            font-family: var(--display);
            max-width: 560px;
        }
        .sb-team {
            font-size: 18px;
            letter-spacing: 0.06em;
            color: var(--text);
            flex: 1;
        }
        .sb-team.right { text-align: right; }
        .sb-score-block {
            display: flex;
            align-items: center;
            gap: 0;
            padding: 0 20px;
            border-left: 1px solid var(--border);
            border-right: 1px solid var(--border);
            margin: 0 16px;
        }
        .sb-score {
            font-size: 36px;
            line-height: 1;
            color: var(--text);
        }
        .sb-divider {
            font-size: 24px;
            color: var(--dimmed);
            padding: 0 10px;
        }
        .sb-meta {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }
        .sb-live {
            display: flex;
            align-items: center;
            gap: 5px;
            font-family: var(--body);
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.1em;
            color: var(--green);
        }
        .sb-live-dot {
            width: 5px; height: 5px;
            background: var(--green);
            border-radius: 50%;
            animation: pulse 1.5s ease-in-out infinite;
        }
        .sb-timer {
            font-family: var(--body);
            font-size: 13px;
            color: var(--muted);
        }

        .hero-stats {
            display: flex;
            align-items: center;
            gap: 32px;
            margin-top: 28px;
        }
        .hero-stat { text-align: center; }
        .hero-stat-num {
            font-family: var(--display);
            font-size: 28px;
            color: var(--text);
            display: block;
        }
        .hero-stat-label {
            font-size: 11px;
            color: var(--dimmed);
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }
        .hero-stat-sep {
            width: 1px;
            height: 36px;
            background: var(--border-hi);
        }

        /* ─── TICKER ─── */
        .ticker-wrap {
            background: var(--surface);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            overflow: hidden;
            padding: 14px 0;
        }
        .ticker-track {
            display: flex;
            gap: 0;
            animation: ticker 30s linear infinite;
            width: max-content;
        }
        @keyframes ticker {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }
        .ticker-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 40px;
            border-right: 1px solid var(--border);
            font-size: 12px;
            font-weight: 400;
            color: var(--muted);
            white-space: nowrap;
        }
        .ticker-score {
            font-family: var(--display);
            font-size: 15px;
            color: var(--text);
            letter-spacing: 0.06em;
        }
        .ticker-live {
            background: rgba(34,197,94,0.15);
            color: var(--green);
            font-size: 9px;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 2px 7px;
            border-radius: 2px;
        }
        .ticker-ended {
            background: rgba(255,255,255,0.06);
            color: var(--dimmed);
            font-size: 9px;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 2px 7px;
            border-radius: 2px;
        }

        /* ─── SECTION BASE ─── */
        section { padding: 100px 0; position: relative; z-index: 1; }

        .section-header {
            margin-bottom: 56px;
        }
        .section-header.centered { text-align: center; }

        .section-title {
            font-family: var(--display);
            font-size: clamp(40px, 5vw, 60px);
            line-height: 1.0;
            letter-spacing: 0.02em;
            margin-bottom: 14px;
        }

        .section-sub {
            font-size: 16px;
            font-weight: 300;
            color: var(--muted);
            max-width: 520px;
            line-height: 1.7;
        }
        .section-header.centered .section-sub { margin: 0 auto; }

        /* ─── PLATFORMS BAR ─── */
        .platforms-bar {
            padding: 36px 0;
            border-bottom: 1px solid var(--border);
        }
        .platforms-inner {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }
        .platforms-label {
            font-size: 11px;
            font-weight: 400;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--dimmed);
            margin-right: 6px;
            white-space: nowrap;
        }
        .platform-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--card);
            border: 1px solid var(--border-hi);
            padding: 7px 14px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: 500;
            color: var(--muted);
            transition: border-color 0.2s, color 0.2s;
        }
        .platform-chip:hover { border-color: rgba(255,255,255,0.3); color: var(--text); }

        /* ─── PROBLEM / COMPARISON ─── */
        .problem-section { background: var(--deep); }

        .comparison-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2px;
            border: 1px solid var(--border-hi);
            border-radius: 6px;
            overflow: hidden;
            margin-top: 56px;
        }
        @media (max-width: 768px) { .comparison-grid { grid-template-columns: 1fr; } }

        .cmp-col {
            padding: 36px;
            background: var(--card);
        }
        .cmp-col.right {
            background: linear-gradient(135deg, rgba(59,130,246,0.06), rgba(99,102,241,0.04));
            border-left: 2px solid rgba(59,130,246,0.35);
        }

        .cmp-head {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            margin-bottom: 28px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border);
        }
        .cmp-col.left .cmp-head { color: var(--red); }
        .cmp-col.right .cmp-head { color: var(--green); }

        .cmp-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
            font-size: 14px;
            color: var(--muted);
            line-height: 1.5;
        }
        .cmp-icon {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            flex-shrink: 0;
            margin-top: 1px;
        }
        .cmp-icon.bad { background: rgba(239,68,68,0.15); color: var(--red); }
        .cmp-icon.good { background: rgba(34,197,94,0.15); color: var(--green); }

        .workflow-row {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
        }
        .wf-tag {
            font-size: 11px;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 2px;
            background: rgba(255,255,255,0.05);
            color: var(--dimmed);
            border: 1px solid var(--border);
        }
        .wf-arrow { color: var(--dimmed); font-size: 13px; }

        .cmp-highlight {
            margin-top: 20px;
            padding: 16px 18px;
            background: rgba(59,130,246,0.1);
            border: 1px solid rgba(59,130,246,0.2);
            border-radius: 4px;
            font-size: 13px;
            color: #93bbfc;
            font-weight: 400;
        }

        /* ─── FEATURES ─── */
        .features-section { background: var(--black); }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border-hi);
            border-radius: 6px;
            overflow: hidden;
        }
        @media (max-width: 900px) { .features-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 560px) { .features-grid { grid-template-columns: 1fr; } }

        .feature-tile {
            background: var(--deep);
            padding: 32px;
            transition: background 0.2s;
        }
        .feature-tile:hover { background: var(--card); }

        .feature-icon-wrap {
            width: 40px; height: 40px;
            border-radius: 4px;
            background: rgba(59,130,246,0.12);
            border: 1px solid rgba(59,130,246,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-bottom: 18px;
        }

        .feature-tile h4 {
            font-family: var(--body);
            font-size: 15px;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 8px;
        }
        .feature-tile p {
            font-size: 13px;
            font-weight: 300;
            color: var(--muted);
            line-height: 1.6;
        }

        /* ─── STEPS ─── */
        .steps-section { background: var(--deep); }

        .steps-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            position: relative;
        }
        @media (max-width: 768px) { .steps-row { grid-template-columns: 1fr; } }

        /* connector line */
        .steps-row::before {
            content: '';
            position: absolute;
            top: 44px;
            left: calc(33.33% - 12px);
            right: calc(33.33% - 12px);
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(59,130,246,0.4), transparent);
            pointer-events: none;
        }
        @media (max-width: 768px) { .steps-row::before { display: none; } }

        .step-card {
            background: var(--card);
            border: 1px solid var(--border-hi);
            border-radius: 6px;
            padding: 32px;
        }

        .step-number {
            font-family: var(--display);
            font-size: 52px;
            line-height: 1;
            color: var(--accent);
            margin-bottom: 20px;
            opacity: 0.8;
        }

        .step-card h3 {
            font-family: var(--body);
            font-size: 17px;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 14px;
        }

        .step-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .step-list li {
            font-size: 13px;
            font-weight: 300;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .step-list li::before {
            content: '—';
            color: var(--accent);
            font-size: 11px;
        }

        /* ─── OVERLAY GALLERY ─── */
        .gallery-section { background: var(--black); }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 56px;
        }
        @media (max-width: 900px) { .gallery-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 560px) { .gallery-grid { grid-template-columns: 1fr; } }

        .gallery-card {
            background: var(--card);
            border: 1px solid var(--border-hi);
            border-radius: 6px;
            overflow: hidden;
            transition: border-color 0.2s, transform 0.2s;
        }
        .gallery-card:hover { border-color: rgba(59,130,246,0.5); transform: translateY(-3px); }

        .ov-preview {
            height: 110px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }
        .ov-1 { background: linear-gradient(135deg, #0a0e1a, #0f1629); }
        .ov-2 { background: linear-gradient(135deg, #12082a, #1a0a35); }
        .ov-3 { background: linear-gradient(135deg, #041220, #071d30); }
        .ov-4 { background: linear-gradient(135deg, #0d0d0d, #1a1a1a); }
        .ov-5 { background: linear-gradient(135deg, #1a0a2e, #0d0520); }
        .ov-6 { background: linear-gradient(135deg, #051008, #071a0a); }

        .ov-bar {
            width: 100%;
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 4px;
            padding: 8px 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .ov-team { font-family: var(--display); font-size: 13px; letter-spacing: 0.06em; color: #fff; }
        .ov-score-text { font-family: var(--display); font-size: 16px; letter-spacing: 0.04em; color: #fff; }

        .gallery-info {
            padding: 16px 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .gallery-info h4 {
            font-size: 14px;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 4px;
        }
        .gallery-info p {
            font-size: 12px;
            font-weight: 300;
            color: var(--muted);
        }

        .gallery-badge {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 4px 9px;
            border-radius: 2px;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .badge-blue { background: rgba(59,130,246,0.15); color: #60a5fa; border: 1px solid rgba(59,130,246,0.25); }
        .badge-gray { background: rgba(255,255,255,0.06); color: var(--dimmed); border: 1px solid var(--border); }
        .badge-green { background: rgba(34,197,94,0.12); color: #4ade80; border: 1px solid rgba(34,197,94,0.2); }
        .badge-purple { background: rgba(99,102,241,0.15); color: #a5b4fc; border: 1px solid rgba(99,102,241,0.25); }
        .badge-amber { background: rgba(245,158,11,0.12); color: #fbbf24; border: 1px solid rgba(245,158,11,0.2); }

        /* ─── CUSTOMIZATION ─── */
        .custom-section { background: var(--deep); }

        .custom-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }
        @media (max-width: 900px) {
            .custom-layout { grid-template-columns: 1fr; gap: 48px; }
        }

        .custom-list { list-style: none; display: flex; flex-direction: column; gap: 12px; margin: 24px 0 36px; }
        .custom-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: var(--muted);
        }
        .custom-check {
            width: 18px; height: 18px;
            border-radius: 50%;
            background: rgba(34,197,94,0.15);
            color: var(--green);
            font-size: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .custom-demo {
            background: var(--card);
            border: 1px solid var(--border-hi);
            border-radius: 6px;
            padding: 28px;
        }

        .custom-scoreboard {
            background: var(--deep);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 18px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: var(--display);
            letter-spacing: 0.04em;
            margin-bottom: 20px;
        }
        .csb-team { font-size: 16px; color: var(--text); }
        .csb-score { font-size: 26px; color: var(--text); }

        .palette-row {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }
        .swatch {
            width: 26px; height: 26px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: transform 0.15s, border-color 0.15s;
        }
        .swatch:hover { transform: scale(1.15); border-color: rgba(255,255,255,0.4); }
        .swatch.active { border-color: #fff; }

        .upload-zone {
            border: 1px dashed rgba(255,255,255,0.15);
            border-radius: 4px;
            padding: 22px;
            text-align: center;
            font-size: 12px;
            color: var(--dimmed);
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .upload-zone:hover { border-color: rgba(255,255,255,0.3); }

        /* ─── TESTIMONIALS ─── */
        .testimonials-section { background: var(--black); }

        .testi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }
        @media (max-width: 768px) { .testi-grid { grid-template-columns: 1fr; } }

        .testi-card {
            background: var(--card);
            border: 1px solid var(--border-hi);
            border-radius: 6px;
            padding: 28px;
        }

        .stars {
            display: flex;
            gap: 3px;
            margin-bottom: 16px;
        }
        .star { color: var(--amber); font-size: 13px; }

        .testi-text {
            font-size: 14px;
            font-weight: 300;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .testi-author {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .testi-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--body);
            font-size: 12px;
            font-weight: 500;
            color: #fff;
            flex-shrink: 0;
        }
        .testi-name { font-size: 13px; font-weight: 500; color: var(--text); }
        .testi-role { font-size: 11px; color: var(--dimmed); }

        /* ─── PRICING ─── */
        .pricing-section { background: var(--deep); }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }
        @media (max-width: 768px) { .pricing-grid { grid-template-columns: 1fr; } }

        .price-card {
            background: var(--card);
            border: 1px solid var(--border-hi);
            border-radius: 6px;
            padding: 32px;
        }
        .price-card.featured {
            border-color: rgba(59,130,246,0.5);
            background: linear-gradient(160deg, rgba(59,130,246,0.06), var(--card));
            position: relative;
        }

        .featured-badge {
            position: absolute;
            top: -11px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--accent);
            color: #fff;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 4px 14px;
            border-radius: 2px;
            white-space: nowrap;
        }

        .price-tier {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 12px;
        }

        .price-amount {
            font-family: var(--display);
            font-size: 52px;
            line-height: 1;
            color: var(--text);
            margin-bottom: 6px;
        }
        .price-amount sup { font-size: 24px; vertical-align: top; margin-top: 10px; display: inline-block; }
        .price-period { font-size: 12px; color: var(--dimmed); margin-bottom: 28px; }

        .price-divider {
            height: 1px;
            background: var(--border);
            margin-bottom: 24px;
        }

        .price-features { list-style: none; display: flex; flex-direction: column; gap: 10px; margin-bottom: 28px; }
        .price-features li {
            font-size: 13px;
            font-weight: 300;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .price-features li::before {
            content: '✓';
            color: var(--green);
            font-size: 11px;
            font-weight: 500;
        }

        .price-btn {
            display: block;
            text-align: center;
            padding: 12px;
            border-radius: 3px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }
        .price-btn-ghost {
            background: transparent;
            border: 1px solid var(--border-hi);
            color: var(--text);
        }
        .price-btn-ghost:hover { border-color: rgba(255,255,255,0.4); }
        .price-btn-solid {
            background: var(--accent);
            color: #fff;
            border: none;
        }
        .price-btn-solid:hover { background: #2563eb; }

        /* ─── FAQ ─── */
        .faq-section { background: var(--black); }

        .faq-list { max-width: 720px; margin: 0 auto; display: flex; flex-direction: column; gap: 2px; }

        details.faq-item {
            background: var(--card);
            border: 1px solid var(--border-hi);
            border-radius: 4px;
            overflow: hidden;
        }
        details.faq-item[open] { border-color: rgba(59,130,246,0.3); }

        details.faq-item summary {
            font-size: 15px;
            font-weight: 400;
            color: var(--text);
            padding: 18px 22px;
            cursor: pointer;
            list-style: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            user-select: none;
        }
        details.faq-item summary::-webkit-details-marker { display: none; }
        details.faq-item summary::after {
            content: '+';
            color: var(--accent);
            font-size: 20px;
            font-weight: 300;
            line-height: 1;
            transition: transform 0.2s;
        }
        details.faq-item[open] summary::after { content: '−'; }

        .faq-answer {
            font-size: 14px;
            font-weight: 300;
            color: var(--muted);
            padding: 0 22px 20px;
            line-height: 1.7;
        }

        /* ─── CTA SECTION ─── */
        .cta-section {
            padding: 120px 0;
            background: var(--deep);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-section::before {
            content: '';
            position: absolute;
            width: 800px; height: 400px;
            background: radial-gradient(ellipse, rgba(59,130,246,0.08) 0%, transparent 70%);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        .cta-eyebrow {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 20px;
        }

        .cta-title {
            font-family: var(--display);
            font-size: clamp(48px, 7vw, 90px);
            line-height: 0.95;
            letter-spacing: 0.02em;
            margin-bottom: 20px;
        }

        .cta-sub {
            font-size: 16px;
            font-weight: 300;
            color: var(--muted);
            margin-bottom: 40px;
        }

        .cta-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        /* ─── FOOTER ─── */
        footer {
            background: var(--black);
            border-top: 1px solid var(--border);
            padding: 56px 28px;
        }
        .footer-inner {
            max-width: 1180px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
        }
        @media (max-width: 768px) { .footer-inner { grid-template-columns: 1fr 1fr; } }

        .footer-brand-logo {
            font-family: var(--display);
            font-size: 22px;
            letter-spacing: 0.05em;
            color: var(--text);
            margin-bottom: 12px;
        }
        .footer-brand-logo span { color: var(--accent); }

        .footer-desc {
            font-size: 13px;
            font-weight: 300;
            color: var(--dimmed);
            line-height: 1.7;
            max-width: 240px;
        }

        .footer-col h5 {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text);
            margin-bottom: 16px;
        }
        .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .footer-col ul li a {
            font-size: 13px;
            font-weight: 300;
            color: var(--dimmed);
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-col ul li a:hover { color: var(--text); }

        .footer-bottom {
            max-width: 1180px;
            margin: 40px auto 0;
            padding-top: 24px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        .footer-bottom p { font-size: 12px; color: var(--dimmed); }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero-badge { animation: fadeInUp 0.5s ease both; }
        .hero-title { animation: fadeInUp 0.5s 0.1s ease both; }
        .hero-sub { animation: fadeInUp 0.5s 0.2s ease both; }
        .hero-actions { animation: fadeInUp 0.5s 0.3s ease both; }
        .hero-scoreboard { animation: fadeInUp 0.5s 0.4s ease both; }
        .hero-stats { animation: fadeInUp 0.5s 0.5s ease both; }

    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <a href="/" class="nav-logo">Scori<span>fy</span></a>

    <ul class="nav-links">
        <li><a href="#features">Features</a></li>
        <li><a href="#gallery">Overlays</a></li>
        <li><a href="#pricing">Pricing</a></li>
        <li><a href="#faq">FAQ</a></li>
    </ul>

    <div class="nav-actions">
        <a href="{{route('login')}}" class="nav-login">Log in</a>
        <a href="/register" class="nav-cta">Get Started</a>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-glow-1"></div>
    <div class="hero-glow-2"></div>
    <div class="hero-inner">

        <div class="hero-badge">
            <span class="hero-badge-dot"></span>
            Real-time WebSocket broadcasting
        </div>

        <h1 class="hero-title">
            LIVE<br>
            <span class="line2">SCORES.</span><br>
            <span class="line3">ZERO DELAY.</span>
        </h1>

        <p class="hero-sub">
            Professional broadcast overlays for OBS Studio.
            One tap updates scores across every connected stream — no page refresh, no lag.
        </p>

        <div class="hero-actions">
            <a href="/register" class="btn-primary">Start Broadcasting →</a>
            <a href="#features" class="btn-ghost">See Features</a>
        </div>

        <div class="hero-scoreboard">
            <span class="sb-team">TEAM LIQUID</span>
            <div class="sb-score-block">
                <span class="sb-score">13</span>
                <span class="sb-divider">—</span>
                <span class="sb-score">11</span>
            </div>
            <div class="sb-meta">
                <span class="sb-live"><span class="sb-live-dot"></span> LIVE</span>
                <span class="sb-timer">47:22</span>
            </div>
            <span class="sb-team right">NATUS VINCERE</span>
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <span class="hero-stat-num">500+</span>
                <span class="hero-stat-label">Matches</span>
            </div>
            <div class="hero-stat-sep"></div>
            <div class="hero-stat">
                <span class="hero-stat-num">&lt;20ms</span>
                <span class="hero-stat-label">Latency</span>
            </div>
            <div class="hero-stat-sep"></div>
            <div class="hero-stat">
                <span class="hero-stat-num">6</span>
                <span class="hero-stat-label">Overlay Styles</span>
            </div>
            <div class="hero-stat-sep"></div>
            <div class="hero-stat">
                <span class="hero-stat-num">4.9★</span>
                <span class="hero-stat-label">Rating</span>
            </div>
        </div>

    </div>
</section>

<!-- LIVE TICKER -->
<div class="ticker-wrap">
    <div class="ticker-track">
        <!-- first copy -->
        <div class="ticker-item"><span class="ticker-score">FC United 2–1 Real City</span><span class="ticker-live">Live</span></div>
        <div class="ticker-item"><span class="ticker-score">NAVI 14–12 Team Liquid</span><span class="ticker-ended">Ended</span></div>
        <div class="ticker-item"><span class="ticker-score">PAK 145/4 IND</span><span class="ticker-live">Live</span></div>
        <div class="ticker-item"><span class="ticker-score">Heat 88–76 Bulls</span><span class="ticker-ended">Ended</span></div>
        <div class="ticker-item"><span class="ticker-score">Arsenal 3–0 Chelsea</span><span class="ticker-live">Live</span></div>
        <div class="ticker-item"><span class="ticker-score">Vitality 9–5 G2</span><span class="ticker-ended">Ended</span></div>
        <!-- duplicate for seamless loop -->
        <div class="ticker-item"><span class="ticker-score">FC United 2–1 Real City</span><span class="ticker-live">Live</span></div>
        <div class="ticker-item"><span class="ticker-score">NAVI 14–12 Team Liquid</span><span class="ticker-ended">Ended</span></div>
        <div class="ticker-item"><span class="ticker-score">PAK 145/4 IND</span><span class="ticker-live">Live</span></div>
        <div class="ticker-item"><span class="ticker-score">Heat 88–76 Bulls</span><span class="ticker-ended">Ended</span></div>
        <div class="ticker-item"><span class="ticker-score">Arsenal 3–0 Chelsea</span><span class="ticker-live">Live</span></div>
        <div class="ticker-item"><span class="ticker-score">Vitality 9–5 G2</span><span class="ticker-ended">Ended</span></div>
    </div>
</div>

<!-- PLATFORMS BAR -->
<div class="platforms-bar">
    <div class="container">
        <div class="platforms-inner">
            <span class="platforms-label">Integrates with</span>
            <span class="platform-chip">⬛ OBS Studio</span>
            <span class="platform-chip">🎬 Streamlabs</span>
            <span class="platform-chip">▶ YouTube Live</span>
            <span class="platform-chip">💜 Twitch</span>
            <span class="platform-chip">🔵 Facebook Live</span>
        </div>
    </div>
</div>

<!-- PROBLEM SECTION -->
<section class="problem-section">
    <div class="container">
        <div class="section-header">
            <span class="label">The Problem</span>
            <h2 class="section-title">Stop fighting<br>outdated tools on match day.</h2>
            <p class="section-sub">Manual graphics, clunky OBS scenes, zero real-time control. Sound familiar?</p>
        </div>

        <div class="comparison-grid">
            <div class="cmp-col left">
                <div class="cmp-head">✕ &nbsp; Without Scorify Pro</div>
                <div class="cmp-item"><span class="cmp-icon bad">✕</span>Score updates lag behind live play</div>
                <div class="cmp-item"><span class="cmp-icon bad">✕</span>OBS overlays require manual editing</div>
                <div class="cmp-item"><span class="cmp-icon bad">✕</span>Scoreboards look dated and amateur</div>
                <div class="cmp-item"><span class="cmp-icon bad">✕</span>Requires a dedicated graphics operator</div>
                <div class="workflow-row">
                    <span class="wf-tag">Edit Graphic</span>
                    <span class="wf-arrow">→</span>
                    <span class="wf-tag">Export PNG</span>
                    <span class="wf-arrow">→</span>
                    <span class="wf-tag">Switch to OBS</span>
                    <span class="wf-arrow">→</span>
                    <span class="wf-tag">Update Scene</span>
                </div>
            </div>
            <div class="cmp-col right">
                <div class="cmp-head">✓ &nbsp; With Scorify Pro</div>
                <div class="cmp-item"><span class="cmp-icon good">✓</span>One tap updates scores instantly</div>
                <div class="cmp-item"><span class="cmp-icon good">✓</span>Auto-synced via WebSockets — no refresh</div>
                <div class="cmp-item"><span class="cmp-icon good">✓</span>Broadcast-quality visuals always</div>
                <div class="cmp-item"><span class="cmp-icon good">✓</span>Run your entire stream solo</div>
                <div class="workflow-row">
                    <span class="wf-tag">Tap +1</span>
                    <span class="wf-arrow">→</span>
                    <span class="wf-tag">Score Updates</span>
                    <span class="wf-arrow">→</span>
                    <span class="wf-tag">OBS Syncs</span>
                </div>
                <div class="cmp-highlight">
                    Instant control + broadcast-quality overlays in under 2 minutes.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="features-section" id="features">
    <div class="container">
        <div class="section-header centered">
            <span class="label">Key Features</span>
            <h2 class="section-title">Everything for<br>live sports broadcasting.</h2>
            <p class="section-sub">Built for streamers and tournament organizers who need reliability under pressure.</p>
        </div>
        <div class="features-grid">
            <div class="feature-tile">
                <div class="feature-icon-wrap">⚡</div>
                <h4>Real-Time Scores</h4>
                <p>Update scoreboards instantly from any device. Changes propagate to OBS in under 20ms via WebSockets.</p>
            </div>
            <div class="feature-tile">
                <div class="feature-icon-wrap">🎬</div>
                <h4>OBS Integration</h4>
                <p>Paste a single Browser Source URL into OBS. No plugins, no configuration — it just works.</p>
            </div>
            <div class="feature-tile">
                <div class="feature-icon-wrap">⏱</div>
                <h4>Live Match Timer</h4>
                <p>Start, pause and reset a synchronized match clock that updates across all connected overlays.</p>
            </div>
            <div class="feature-tile">
                <div class="feature-icon-wrap">📺</div>
                <h4>Overlay Themes</h4>
                <p>Six professional broadcast layouts — from TV-style lower thirds to esports HUD displays.</p>
            </div>
            <div class="feature-tile">
                <div class="feature-icon-wrap">📱</div>
                <h4>Mobile Control</h4>
                <p>The entire admin dashboard is mobile-responsive. Control your match from courtside or pitch.</p>
            </div>
            <div class="feature-tile">
                <div class="feature-icon-wrap">📊</div>
                <h4>Match History</h4>
                <p>Every match is automatically archived with full score history and timestamps.</p>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="steps-section">
    <div class="container">
        <div class="section-header centered">
            <span class="label">How It Works</span>
            <h2 class="section-title">Up and running<br>in 3 steps.</h2>
            <p class="section-sub">No technical skills required. No software to install.</p>
        </div>
        <div class="steps-row">
            <div class="step-card">
                <div class="step-number">01</div>
                <h3>Create Your Match</h3>
                <ul class="step-list">
                    <li>Add team names and logos</li>
                    <li>Choose your overlay theme</li>
                    <li>Set the match timer</li>
                </ul>
            </div>
            <div class="step-card">
                <div class="step-number">02</div>
                <h3>Control From Any Device</h3>
                <ul class="step-list">
                    <li>Tap to update scores</li>
                    <li>Start and pause the timer</li>
                    <li>Change status live</li>
                </ul>
            </div>
            <div class="step-card">
                <div class="step-number">03</div>
                <h3>Go Live on OBS</h3>
                <ul class="step-list">
                    <li>Copy your overlay URL</li>
                    <li>Add as Browser Source in OBS</li>
                    <li>Broadcast instantly</li>
                </ul>
            </div>
        </div>
        <div style="text-align:center; margin-top: 40px;">
            <a href="/register" class="btn-primary">Start Broadcasting →</a>
        </div>
    </div>
</section>

<!-- OVERLAY GALLERY -->
<section class="gallery-section" id="gallery">
    <div class="container">
        <div class="section-header">
            <span class="label">Overlay Gallery</span>
            <h2 class="section-title">Broadcast-quality overlays.<br>Multiple layouts.</h2>
            <p class="section-sub">Every style is fully customizable. Colors, fonts and logos — make it completely yours.</p>
        </div>
        <div class="gallery-grid">
            <div class="gallery-card">
                <div class="ov-preview ov-1">
                    <div class="ov-bar">
                        <span class="ov-team">FC UNITED</span>
                        <span class="ov-score-text">2 — 1</span>
                        <span class="ov-team">REAL CITY</span>
                    </div>
                </div>
                <div class="gallery-info">
                    <div><h4>Top Bar</h4><p>Score bar pinned to top of stream</p></div>
                    <span class="gallery-badge badge-blue">Popular</span>
                </div>
            </div>
            <div class="gallery-card">
                <div class="ov-preview ov-2">
                    <div class="ov-bar">
                        <span class="ov-team">TEAM A</span>
                        <span class="ov-score-text">1 — 1</span>
                        <span class="ov-team">TEAM B</span>
                    </div>
                </div>
                <div class="gallery-info">
                    <div><h4>Bottom Dock</h4><p>Traditional lower-third scoreboard</p></div>
                    <span class="gallery-badge badge-gray">Classic</span>
                </div>
            </div>
            <div class="gallery-card">
                <div class="ov-preview ov-3">
                    <div class="ov-bar">
                        <span class="ov-team">● LIVE</span>
                        <span class="ov-score-text">3 — 0</span>
                        <span class="ov-team">90'</span>
                    </div>
                </div>
                <div class="gallery-info">
                    <div><h4>Minimal Float</h4><p>Compact floating display, modern style</p></div>
                    <span class="gallery-badge badge-gray">Clean</span>
                </div>
            </div>
            <div class="gallery-card">
                <div class="ov-preview ov-4">
                    <div class="ov-bar">
                        <span class="ov-team">FC UNITED</span>
                        <span class="ov-score-text">3 — 2</span>
                        <span class="ov-team">REAL CITY</span>
                    </div>
                </div>
                <div class="gallery-info">
                    <div><h4>TV Broadcast</h4><p>Sports-channel style for professional streams</p></div>
                    <span class="gallery-badge badge-amber">Premium</span>
                </div>
            </div>
            <div class="gallery-card">
                <div class="ov-preview ov-5">
                    <div class="ov-bar">
                        <span class="ov-team">TEAM 52</span>
                        <span class="ov-score-text">14 — 12</span>
                        <span class="ov-team">TEAM 88</span>
                    </div>
                </div>
                <div class="gallery-info">
                    <div><h4>Esports HUD</h4><p>High-contrast for gaming broadcasts</p></div>
                    <span class="gallery-badge badge-purple">Gaming</span>
                </div>
            </div>
            <div class="gallery-card">
                <div class="ov-preview ov-6">
                    <div class="ov-bar">
                        <span class="ov-team">PAK</span>
                        <span class="ov-score-text">145/4</span>
                        <span class="ov-team">IND</span>
                    </div>
                </div>
                <div class="gallery-info">
                    <div><h4>Cricket</h4><p>Wickets, overs and innings tracking</p></div>
                    <span class="gallery-badge badge-green">Coming Soon</span>
                </div>
            </div>
        </div>
        <div style="text-align:center; margin-top: 48px;">
            <a href="/register" class="btn-primary">Browse Overlay Library →</a>
        </div>
    </div>
</section>

<!-- CUSTOMIZATION -->
<section class="custom-section">
    <div class="container">
        <div class="custom-layout">
            <div>
                <span class="label">Customization</span>
                <h2 class="section-title">Your brand.<br>Your colors.<br>Your style.</h2>
                <p class="section-sub">Customize every element to match your stream identity. Upload logos, choose colors, save presets.</p>
                <ul class="custom-list">
                    <li><span class="custom-check">✓</span> Team color auto-theming</li>
                    <li><span class="custom-check">✓</span> Upload logos (PNG / SVG)</li>
                    <li><span class="custom-check">✓</span> Multiple display modes</li>
                    <li><span class="custom-check">✓</span> Dark and light overlays</li>
                    <li><span class="custom-check">✓</span> Save reusable presets</li>
                </ul>
                <a href="/register" class="btn-primary">Start Customizing →</a>
            </div>
            <div>
                <div class="custom-demo">
                    <div class="custom-scoreboard">
                        <span class="csb-team">FC UNITED</span>
                        <span class="csb-score">2 — 1</span>
                        <span class="csb-team">REAL CITY</span>
                    </div>
                    <div class="palette-row">
                        <div class="swatch active" style="background:#3b82f6;"></div>
                        <div class="swatch" style="background:#ef4444;"></div>
                        <div class="swatch" style="background:#f97316;"></div>
                        <div class="swatch" style="background:#14b8a6;"></div>
                        <div class="swatch" style="background:#8b5cf6;"></div>
                        <div class="swatch" style="background:#ec4899;"></div>
                        <div class="swatch" style="background:#f59e0b;"></div>
                    </div>
                    <div class="upload-zone">
                        Drop team logo here · PNG or SVG
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header centered">
            <span class="label">Testimonials</span>
            <h2 class="section-title">Loved by streamers<br>and organizers.</h2>
        </div>
        <div class="testi-grid">
            <div class="testi-card">
                <div class="stars"><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span></div>
                <p class="testi-text">"Best scoreboard system we've ever used. Set it up in minutes before a tournament and it worked flawlessly the entire day."</p>
                <div class="testi-author">
                    <div class="testi-avatar">AK</div>
                    <div><div class="testi-name">Ahmed Khan</div><div class="testi-role">Tournament Director</div></div>
                </div>
            </div>
            <div class="testi-card">
                <div class="stars"><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span></div>
                <p class="testi-text">"Setup took less than 5 minutes. I just pasted the URL into OBS and the scoreboard was live. Incredibly smooth."</p>
                <div class="testi-author">
                    <div class="testi-avatar">SW</div>
                    <div><div class="testi-name">Sarah Wilson</div><div class="testi-role">Esports Streamer</div></div>
                </div>
            </div>
            <div class="testi-card">
                <div class="stars"><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span><span class="star">★</span></div>
                <p class="testi-text">"Perfect for local football tournaments. Our viewers said the stream looked completely professional for the first time."</p>
                <div class="testi-author">
                    <div class="testi-avatar">DB</div>
                    <div><div class="testi-name">David Brooks</div><div class="testi-role">Club Organizer</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PRICING -->
<section class="pricing-section" id="pricing">
    <div class="container">
        <div class="section-header centered">
            <span class="label">Pricing</span>
            <h2 class="section-title">Pick your plan.<br>Start streaming.</h2>
        </div>
        <div class="pricing-grid">
            <div class="price-card">
                <div class="price-tier">Free</div>
                <div class="price-amount">$0</div>
                <div class="price-period">Forever free</div>
                <div class="price-divider"></div>
                <ul class="price-features">
                    <li>1 active match</li>
                    <li>Basic overlay theme</li>
                    <li>Real-time updates</li>
                </ul>
                <a href="/register" class="price-btn price-btn-ghost">Get Started</a>
            </div>
            <div class="price-card featured">
                <div class="featured-badge">Most Popular</div>
                <div class="price-tier">Pro</div>
                <div class="price-amount"><sup>$</sup>19</div>
                <div class="price-period">per month</div>
                <div class="price-divider"></div>
                <ul class="price-features">
                    <li>Unlimited matches</li>
                    <li>All 6 overlay themes</li>
                    <li>Mobile control</li>
                    <li>Match history</li>
                    <li>Logo uploads</li>
                </ul>
                <a href="/register" class="price-btn price-btn-solid">Start Free Trial</a>
            </div>
            <div class="price-card">
                <div class="price-tier">Custom</div>
                <div class="price-amount" style="font-size:36px; padding-top:8px;">Contact</div>
                <div class="price-period">for organizations</div>
                <div class="price-divider"></div>
                <ul class="price-features">
                    <li>White label branding</li>
                    <li>Dedicated support</li>
                    <li>Custom integrations</li>
                    <li>SLA guarantee</li>
                </ul>
                <a href="mailto:hello@scorify.com" class="price-btn price-btn-ghost">Contact Sales</a>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="faq-section" id="faq">
    <div class="container">
        <div class="section-header centered">
            <span class="label">FAQ</span>
            <h2 class="section-title">Frequently asked<br>questions.</h2>
        </div>
        <div class="faq-list">
            <details class="faq-item">
                <summary>Does it work with OBS Studio?</summary>
                <p class="faq-answer">Yes — add your overlay URL as a Browser Source in OBS. The scoreboard updates instantly in real-time without you touching OBS again.</p>
            </details>
            <details class="faq-item">
                <summary>Do I need to install any software?</summary>
                <p class="faq-answer">No. Scorify Pro is entirely web-based. You only need a browser for the admin dashboard and OBS Studio for your stream.</p>
            </details>
            <details class="faq-item">
                <summary>Can I use my own team logos?</summary>
                <p class="faq-answer">Yes, Pro users can upload PNG or SVG logos for both teams. Logos auto-resize and display cleanly in all overlay themes.</p>
            </details>
            <details class="faq-item">
                <summary>Is mobile control included?</summary>
                <p class="faq-answer">Yes. The entire admin dashboard is fully responsive. You can update scores and control the timer from your phone during a live match.</p>
            </details>
            <details class="faq-item">
                <summary>How fast are the updates?</summary>
                <p class="faq-answer">Scores propagate to the OBS overlay in under 20ms via WebSockets. For all practical purposes, it's instant.</p>
            </details>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <p class="cta-eyebrow">Ready to go live?</p>
        <h2 class="cta-title">BROADCAST<br>LIKE A PRO.</h2>
        <p class="cta-sub">Join streamers already using Scorify Pro.</p>
        <div class="cta-actions">
            <a href="/register" class="btn-primary">Start Free →</a>
            <a href="#features" class="btn-ghost">See Features</a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="footer-inner">
        <div>
            <div class="footer-brand-logo">Scori<span>fy</span></div>
            <p class="footer-desc">Professional real-time sports broadcasting overlays for OBS Studio and streaming platforms.</p>
        </div>
        <div class="footer-col">
            <h5>Product</h5>
            <ul>
                <li><a href="#features">Features</a></li>
                <li><a href="#gallery">Overlays</a></li>
                <li><a href="#pricing">Pricing</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h5>Company</h5>
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Blog</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h5>Support</h5>
            <ul>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#">Documentation</a></li>
                <li><a href="#">Status</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} Scorify Pro. All rights reserved.</p>
        <p>Built with Laravel 12 · Real-time via WebSockets</p>

    </div>
</footer>

</body>
</html>