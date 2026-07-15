@php
    // Build the sport filter options from the sports actually present in
    // this user's matches, instead of a hardcoded list that drifts out of
    // sync with what's really in the data.
    $availableSports = ($matches ?? collect())
        ->pluck('sport')
        ->filter()
        ->unique()
        ->sort()
        ->values();
@endphp

<div class="dashboard-toolbar glass-panel">

    <div class="toolbar-left">

        <div class="toolbar-search">

            <i data-lucide="search"></i>

            <input
                id="dash-search-input"
                type="text"
                placeholder="Search matches, teams or sports..."
                autocomplete="off">

        </div>

    </div>

    <div class="toolbar-right">

        <span class="toolbar-result-count" id="dash-result-count"></span>

        <select id="dash-filter-sport" class="toolbar-select">
            <option value="">All Sports</option>
            @foreach($availableSports as $sport)
                <option value="{{ strtolower($sport) }}">{{ $sport }}</option>
            @endforeach
        </select>

        <select id="dash-filter-status" class="toolbar-select">
            <option value="">All Status</option>
            <option value="live">Live</option>
            <option value="paused">Paused</option>
            <option value="scheduled">Scheduled</option>
            <option value="ended">Ended</option>
        </select>

        <select id="dash-sort" class="toolbar-select">
            <option value="newest">Newest First</option>
            <option value="oldest">Oldest First</option>
            <option value="name-asc">Name A–Z</option>
            <option value="name-desc">Name Z–A</option>
        </select>

        <button type="button" id="dash-filter-reset" class="toolbar-reset" hidden>
            <i data-lucide="x"></i>
            Clear
        </button>

    </div>

</div>
