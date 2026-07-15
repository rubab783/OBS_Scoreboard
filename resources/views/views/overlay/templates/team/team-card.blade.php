<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    @vite([
        'resources/css/overlay/templates/team-card.css',
        'resources/js/overlay-render.js'
    ])

</head>

<body>

<div class="tc-overlay">

    <div  class="tc-card" style="--accent-color: {{ $settings->accent_color ?? $template->accent_color }}">

        @if($settings->show_logos && $match->team_a_logo_url)
            <img src="{{ $match->team_a_logo_url }}" class="tc-logo">
        @endif

        <div class="tc-content">

            <span class="tc-label">
                TEAM INTRODUCTION
            </span>

            <h1 class="tc-team">
                {{ $match->team_a_display_name }}
            </h1>

            <p class="tc-subtitle">
                Ready for today's match
            </p>

        </div>

        <div class="tc-accent"></div>

    </div>

</div>

</body>
</html>