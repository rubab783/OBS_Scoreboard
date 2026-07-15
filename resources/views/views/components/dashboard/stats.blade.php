@php
    $pausedCount     = $pausedCount ?? 0;
    $createdThisWeek = $createdThisWeek ?? 0;
    $createdLastWeek = $createdLastWeek ?? 0;

    if ($createdLastWeek > 0) {
        $trendPct = round((($createdThisWeek - $createdLastWeek) / $createdLastWeek) * 100);
    } else {
        $trendPct = $createdThisWeek > 0 ? 100 : 0;
    }

    $trendDirection = $trendPct > 0 ? 'up' : ($trendPct < 0 ? 'down' : 'flat');
@endphp

<div class="stats-grid">

    <div class="stat-card live">

        @if($activeCount > 0)
            <span class="stat-live-dot" title="Live events on air"></span>
        @endif

        <div class="stat-icon">
            <i data-lucide="radio"></i>
        </div>

        <div class="stat-content">

            <div class="stat-top-row">
                <h2>{{ $activeCount }}</h2>

                @if($trendPct !== 0)
                    <span class="stat-trend {{ $trendDirection }}">
                        <i data-lucide="{{ $trendDirection === 'up' ? 'trending-up' : 'trending-down' }}"></i>
                        {{ abs($trendPct) }}%
                    </span>
                @endif
            </div>

            <span>Live Events{{ $pausedCount > 0 ? " ({$pausedCount} paused)" : '' }}</span>

        </div>

    </div>

    <div class="stat-card paused">

        <div class="stat-icon">
            <i data-lucide="pause-circle"></i>
        </div>

        <div class="stat-content">
            <h2>{{ $pausedCount }}</h2>
            <span>Paused</span>
        </div>

    </div>

    <div class="stat-card scheduled">

        <div class="stat-icon">
            <i data-lucide="calendar-days"></i>
        </div>

        <div class="stat-content">
            <h2>{{ $scheduledCount }}</h2>
            <span>Scheduled</span>
        </div>

    </div>

    <div class="stat-card archived">

        <div class="stat-icon">
            <i data-lucide="archive"></i>
        </div>

        <div class="stat-content">
            <h2>{{ $archivedCount }}</h2>
            <span>Archived</span>
        </div>

    </div>

</div>
