<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/green-light.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="gl-overlay">

    <div class="gl-banner"
         style="--accent-color: {{ $settings->accent_color ?? $template->accent_color }}">

        <div class="gl-left">

            <span class="gl-live-dot"></span>

            <span class="gl-label">
                LIVE
            </span>

        </div>

        <div class="gl-content">

            {{ $settings->ticker_text ?: 'Welcome to the Live Broadcast' }}

        </div>

    </div>

</div>

</body>
</html>