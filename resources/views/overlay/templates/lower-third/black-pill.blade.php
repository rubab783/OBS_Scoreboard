<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/black-pill.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="bp-overlay">

    <div class="bp-pill"
         style="--accent-color: {{ $settings->accent_color ?? $template->accent_color }}">

        <div class="bp-dot"></div>

        <span class="bp-text">

            {{ $settings->ticker_text ?: 'Breaking Announcement' }}

        </span>

    </div>

</div>

</body>
</html>