<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/starting-lineup.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="sl-overlay">

    <div class="sl-header">

        <span class="sl-title">
            STARTING LINEUP
        </span>

        <span class="sl-team-name">
            {{ $match->team_a_display_name }}
        </span>

    </div>

    <div class="sl-panel">

        @for($i = 1; $i <= 11; $i++)

            <div class="sl-player">

                <span class="sl-number">
                    {{ $i }}
                </span>

                <span class="sl-player-name">
                    Player {{ $i }}
                </span>

            </div>

        @endfor

    </div>

</div>

</body>
</html>