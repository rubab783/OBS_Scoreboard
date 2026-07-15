<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/corner-badge.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="sc-overlay">

    <div class="sc-badge"
         style="--accent-color: {{ $settings->accent_color ?? $template->accent_color }}">

        <span class="sc-title">
            SPONSORED BY
        </span>

        @if($settings->show_sponsor && $settings->sponsor_logo_url)

            <img src="{{ $settings->sponsor_logo_url }}"
                 class="sc-logo">

        @else

            <div class="sc-placeholder">

                Sponsor

            </div>

        @endif

    </div>

</div>

</body>
</html>