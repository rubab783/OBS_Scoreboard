<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/edge-series.css',
        'resources/js/overlay-render.js'
    ])
</head>

<body>

<div class="es-overlay">

    <div class="es-scoreboard">

        <div class="es-team left" style="--team-color:{{ $match->team_a_color }}">

            @if($settings->show_logos && $match->team_a_logo_url)
                <img src="{{ $match->team_a_logo_url }}" class="es-logo">
            @endif

            <span class="es-name" data-team-a>
                {{ $match->team_a_display_name }}
            </span>

        </div>

        <div class="es-center">

            @if($settings->show_period)
                <span class="es-period" data-period>
                    {{ $match->current_period ?? '1st Half' }}
                </span>
            @endif

            <div class="es-score-row">

                <span class="es-score" data-score-a>
                    {{ $match->score_a }}
                </span>

                <span class="es-divider">:</span>

                <span class="es-score" data-score-b>
                    {{ $match->score_b }}
                </span>

            </div>

            @if($settings->show_timer)
                <span class="es-timer" data-timer>
                    00:00
                </span>
            @endif

        </div>

        <div class="es-team right" style="--team-color:{{ $match->team_b_color }}">

            <span class="es-name" data-team-b>
                {{ $match->team_b_display_name }}
            </span>

            @if($settings->show_logos && $match->team_b_logo_url)
                <img src="{{ $match->team_b_logo_url }}" class="es-logo">
            @endif

        </div>

    </div>

</div>

</body>
</html>