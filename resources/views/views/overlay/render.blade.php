<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $match->name }} — Overlay</title>

    @vite(['resources/css/overlay-theme.css', 'resources/js/pages/overlay-render.js'])

</head>
<body class="overlay-body theme-{{ $settings->theme }}" data-animation="{{ $settings->animation_style }}">

    <div class="overlay-root"
         id="overlayRoot"
         data-match-id="{{ $match->id }}"
         style="--accent-color: {{ $settings->accent_color ?? '#7C3AED' }}">

        {{-- Scoreboard Bar --}}
        @if ($settings->show_score)
            <div class="scoreboard-bar">

                {{-- Team A --}}
                <div class="scoreboard-team scoreboard-team-a" style="--team-color: {{ $match->team_a_color ?? '#7C3AED' }}">
                    @if ($settings->show_logos && $match->team_a_logo_url)
                        <img src="{{ $match->team_a_logo_url }}" alt="{{ $match->team_a_display_name }}" class="scoreboard-logo">
                    @endif
                    <span class="scoreboard-team-name">{{ $match->team_a_display_name }}</span>
                    <span class="scoreboard-score" id="scoreA">{{ $match->score_a }}</span>
                </div>

                {{-- Center: Timer + Period --}}
                <div class="scoreboard-center">
                    @if ($settings->show_timer)
                        <span class="scoreboard-timer"
                              id="overlayTimer"
                              data-seconds="{{ $match->clock_seconds }}"
                              data-status="{{ $match->timer_status }}">00:00</span>
                    @endif

                    @if ($settings->show_period && $match->period)
                        <span class="scoreboard-period" id="overlayPeriod">{{ $match->period }}</span>
                    @endif
                </div>

                {{-- Team B --}}
                <div class="scoreboard-team scoreboard-team-b" style="--team-color: {{ $match->team_b_color ?? '#2563EB' }}">
                    <span class="scoreboard-score" id="scoreB">{{ $match->score_b }}</span>
                    <span class="scoreboard-team-name">{{ $match->team_b_display_name }}</span>
                    @if ($settings->show_logos && $match->team_b_logo_url)
                        <img src="{{ $match->team_b_logo_url }}" alt="{{ $match->team_b_display_name }}" class="scoreboard-logo">
                    @endif
                </div>

            </div>
        @endif

        {{-- Sponsor Logo --}}
        @if ($settings->show_sponsor && $settings->sponsor_logo_url)
            <div class="sponsor-corner">
                <img src="{{ $settings->sponsor_logo_url }}" alt="Sponsor" class="sponsor-logo">
            </div>
        @endif

        {{-- Ticker --}}
        @if ($settings->show_ticker && $settings->ticker_text)
            <div class="ticker-bar">
                <div class="ticker-track">
                    <span class="ticker-text">{{ $settings->ticker_text }}</span>
                    <span class="ticker-text">{{ $settings->ticker_text }}</span>
                </div>
            </div>
        @endif

    </div>

</body>
</html>