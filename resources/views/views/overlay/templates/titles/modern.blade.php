<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/title-modern.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="mt-overlay">

    <div class="mt-card">

        <span class="mt-label">

            MATCH DAY

        </span>

        <h1 class="mt-title">

            {{ $match->team_a_display_name }}

            <span class="mt-vs">VS</span>

            {{ $match->team_b_display_name }}

        </h1>

        @if($settings->show_period)

            <p class="mt-period">

                {{ $match->period ?? 'Kick Off' }}

            </p>

        @endif

    </div>

</div>

</body>

</html>