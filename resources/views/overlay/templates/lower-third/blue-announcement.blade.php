<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/blue-announcement.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="ba-overlay">

    <div class="ba-container"
         style="--accent-color: {{ $settings->accent_color ?? $template->accent_color }}">

        <div class="ba-accent"></div>

        <div class="ba-content">

            <span class="ba-title">
                LIVE ANNOUNCEMENT
            </span>

            <span class="ba-text">

                {{ $settings->ticker_text ?: 'Announcement text goes here' }}

            </span>

        </div>

    </div>

</div>

</body>
</html>