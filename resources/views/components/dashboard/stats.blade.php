<div class="stats-grid">

    <div class="stat-card live">

        <div class="stat-icon">
            <i data-lucide="radio"></i>
        </div>

        <div class="stat-content">

            <h2>{{ $activeCount }}</h2>

            <span>Live Events</span>

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