<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/lower-banner.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="sl-overlay">

    <div class="sl-banner"
         style="--accent-color: {{ $settings->accent_color ?? $template->accent_color }}">

        <div class="sl-left">

            <span class="sl-text">
                Sponsored By
            </span>

        </div>

        <div class="sl-right">

            @if($settings->show_sponsor && $settings->sponsor_logo_url)

                <img src="{{ $settings->sponsor_logo_url }}"
                     class="sl-logo">

            @else

                <div class="sl-placeholder">

                    Sponsor Logo

                </div>

            @endif

        </div>

    </div>

</div>

</body>

</html>