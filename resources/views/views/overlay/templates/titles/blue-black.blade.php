<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/blue-black-title.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="bbt-overlay">

    <div class="bbt-backdrop"></div>

    <div class="bbt-card">

        <div class="bbt-header">

            <span class="bbt-live">

                LIVE MATCH

            </span>

        </div>

        <div class="bbt-teams">

            <div class="bbt-team">

                @if($settings->show_logos && $match->team_a_logo_url)
                    <img src="{{ $match->team_a_logo_url }}" class="bbt-logo">
                @endif

                <span>{{ $match->team_a_display_name }}</span>

            </div>

            <div class="bbt-vs">

                VS

            </div>

            <div class="bbt-team">

                @if($settings->show_logos && $match->team_b_logo_url)
                    <img src="{{ $match->team_b_logo_url }}" class="bbt-logo">
                @endif

                <span>{{ $match->team_b_display_name }}</span>

            </div>

        </div>

    </div>

</div>

</body>

</html>