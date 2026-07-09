<div class="glass-card timer-control-card">

    <div class="timer-header">

        <p class="timer-label">
            Match Clock
        </p>

        <span class="timer-status">
            {{ ucfirst($match->timer_status) }}
        </span>

    </div>

    <div
        id="matchTimer"
        class="timer-display"
        data-seconds="{{ $match->clock_seconds }}"
        data-status="{{ $match->timer_status }}"
        data-match-id="{{ $match->id }}">

        00:00

    </div>

    <div class="timer-controls">

        <button
            id="timerStartBtn"
            class="timer-btn"
            type="button"
            title="Start">

            <i data-lucide="play"></i>

        </button>

        <button
            id="timerPauseBtn"
            class="timer-btn"
            type="button"
            title="Pause">

            <i data-lucide="pause"></i>

        </button>

        <button
            id="timerResetBtn"
            class="timer-btn timer-btn-reset"
            type="button"
            title="Reset">

            <i data-lucide="rotate-ccw"></i>

        </button>

    </div>

    <div class="period-selector">

        <label
            for="periodSelect"
            class="period-label">

            Match Period

        </label>

        <select
            id="periodSelect"
            class="period-select">

            @foreach ([
                '1st Half',
                '2nd Half',
                'Extra Time',
                'Penalties'
            ] as $period)

                <option
                    value="{{ $period }}"
                    @selected($match->period === $period)>

                    {{ $period }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="match-status-controls">

        <button
            class="status-btn"
            data-status="live"
            type="button">

            🔴 Go Live

        </button>

        <button
            class="status-btn"
            data-status="paused"
            type="button">

            ⏸ Pause

        </button>

        <button
            class="status-btn"
            data-status="ended"
            type="button">

            ✓ End Match

        </button>

    </div>

</div>