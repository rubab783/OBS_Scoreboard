<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/red-card.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="rc-overlay">

    <div class="rc-card"
         style="--accent-color: {{ $settings->accent_color ?? $template->accent_color }}">

        <div class="rc-icon">

            <div class="rc-red-card"></div>

        </div>

        <div class="rc-content">

            <span class="rc-title">

                RED CARD

            </span>

            <span class="rc-player">

                {{ $match->team_a_display_name }}

            </span>

        </div>

    </div>

</div>

</body>

</html>