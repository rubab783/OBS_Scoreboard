<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/yellow-card.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="yc-overlay">

    <div class="yc-card"
         style="--accent-color: {{ $settings->accent_color ?? $template->accent_color }}">

        <div class="yc-icon">

            <div class="yc-yellow-card"></div>

        </div>

        <div class="yc-content">

            <span class="yc-title">

                YELLOW CARD

            </span>

            <span class="yc-player">

                {{ $match->team_a_display_name }}

            </span>

        </div>

    </div>

</div>

</body>

</html>