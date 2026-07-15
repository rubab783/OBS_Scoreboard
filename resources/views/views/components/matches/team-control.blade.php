@php
    $isTeamA = $team === 'a';

    $name = $isTeamA
        ? $match->team_a_display_name
        : $match->team_b_display_name;

    $logo = $isTeamA
        ? $match->team_a_logo_url
        : $match->team_b_logo_url;

    $color = $isTeamA
        ? ($match->team_a_color ?? '#7C3AED')
        : ($match->team_b_color ?? '#2563EB');

    $score = $isTeamA
        ? $match->score_a
        : $match->score_b;
@endphp

<div
    class="glass-card team-control-card"
    style="--team-color: {{ $color }}">

    <div class="team-control-header">

        @if($logo)

            <img
                src="{{ $logo }}"
                alt="{{ $name }}"
                class="team-control-logo">

        @else

            <div class="team-control-logo team-control-logo-fallback">

                <i data-lucide="shield"></i>

            </div>

        @endif

        <h2 class="team-control-name">
            {{ $name }}
        </h2>

    </div>

    <div
        class="score-display"
        id="team{{ strtoupper($team) }}Score"
        data-team="{{ $team }}"
        data-score="{{ $score }}">

        {{ $score }}

    </div>

    <div class="score-controls">

        <button
            class="score-btn score-btn-minus"
            type="button"
            data-team="{{ $team }}"
            data-action="decrement">

            <i data-lucide="minus"></i>

        </button>

        <button
            class="score-btn score-btn-plus"
            type="button"
            data-team="{{ $team }}"
            data-action="increment">

            <i data-lucide="plus"></i>

        </button>

    </div>

</div>