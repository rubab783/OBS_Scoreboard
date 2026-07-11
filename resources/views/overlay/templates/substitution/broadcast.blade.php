<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/broadcast-substitution.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="bs-overlay">

    <div class="bs-card">

        <div class="bs-title">

            SUBSTITUTION

        </div>

        <div class="bs-team">

            {{ $match->team_a_display_name }}

        </div>

        <div class="bs-players">

            <div class="bs-row in">

                <span class="bs-indicator">IN</span>

                <span class="bs-name">

                    Player Coming In

                </span>

            </div>

            <div class="bs-row out">

                <span class="bs-indicator">OUT</span>

                <span class="bs-name">

                    Player Going Out

                </span>

            </div>

        </div>

    </div>

</div>

</body>

</html>