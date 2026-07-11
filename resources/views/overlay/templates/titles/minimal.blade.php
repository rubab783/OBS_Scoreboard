<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/title-minimal.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="minimal-title-overlay">

    <div class="minimal-title-card">

        <span class="minimal-label">

            LIVE EVENT

        </span>

        <h1 class="minimal-match-title">

            {{ $match->team_a_display_name }}

            <span class="minimal-vs">vs</span>

            {{ $match->team_b_display_name }}

        </h1>

        @if($settings->show_timer)

            <div class="minimal-timer" data-timer>

                00:00

            </div>

        @endif

    </div>

</div>

</body>

</html>