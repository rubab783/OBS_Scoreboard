<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

@vite([
'resources/css/overlay/templates/red-swish.css',
'resources/js/overlay-render.js'
])

</head>

<body>

<div class="rs-overlay">

    <div class="rs-scoreboard">

        <div class="rs-team rs-left"
             style="--team-color: {{ $match->team_a_color }}">

            @if($settings->show_logos && $match->team_a_logo_url)
                <img src="{{ $match->team_a_logo_url }}" class="rs-logo">
            @endif

            <span
                class="rs-name"
                data-team-a>

                {{ $match->team_a_display_name }}

            </span>

        </div>


        <div class="rs-center">

            <span
                class="rs-score"
                data-score-a>

                {{ $match->score_a }}

            </span>

            @if($settings->show_timer)

                <div class="rs-clock">

                    <span data-timer>00:00</span>

                </div>

            @endif

            <span
                class="rs-score"
                data-score-b>

                {{ $match->score_b }}

            </span>

            @if($settings->show_period)

                <div class="rs-period">

                    {{ $match->period ?? '1ST' }}

                </div>

            @endif

        </div>


        <div class="rs-team rs-right"
             style="--team-color: {{ $match->team_b_color }}">

            <span
                class="rs-name"
                data-team-b>

                {{ $match->team_b_display_name }}

            </span>

            @if($settings->show_logos && $match->team_b_logo_url)
                <img src="{{ $match->team_b_logo_url }}" class="rs-logo">
            @endif

        </div>

    </div>

</div>

</body>
</html>