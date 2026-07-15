<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

@vite([
'resources/css/overlay/templates/blue-black.css',
'resources/js/overlay-render.js'
])

</head>

<body>

<div class="bb-overlay">

    <div class="bb-scoreboard">

        <div class="bb-team left"
             style="--team:{{ $match->team_a_color }}">

            @if($settings->show_logos && $match->team_a_logo_url)
                <img src="{{ $match->team_a_logo_url }}" class="bb-logo">
            @endif

            <span class="bb-name"
                  data-team-a>
                {{ $match->team_a_display_name }}
            </span>

        </div>

        <div class="bb-center">

            <span
                class="bb-score"
                data-score-a>
                {{ $match->score_a }}
            </span>

            @if($settings->show_timer)
                <span
                    class="bb-timer"
                    data-timer>
                    00:00
                </span>
            @endif

            <span
                class="bb-score"
                data-score-b>
                {{ $match->score_b }}
            </span>

        </div>

        <div class="bb-team right"
             style="--team:{{ $match->team_b_color }}">

            <span data-team-b>

                {{ $match->team_b_display_name }}

            </span>

            @if($settings->show_logos && $match->team_b_logo_url)
                <img src="{{ $match->team_b_logo_url }}" class="bb-logo">
            @endif

        </div>

    </div>

</div>

</body>

</html>