<div class="toolbar">

    <div class="toolbar-left">

        <div class="toolbar-title">
            <h2>Matches</h2>
            <span>{{ $matches->count() }} {{ Str::plural('Event', $matches->count()) }}</span>
        </div>

        <div class="toolbar-search">
            <i data-lucide="search"></i>

            <input
                id="dash-search-input"
                type="search"
                placeholder="Search by match, team or sport..."
                autocomplete="off">
        </div>

    </div>

    <div class="toolbar-right">

        <button
            type="button"
            class="toolbar-btn">
            <i data-lucide="filter"></i>
            <span>Filters</span>
        </button>

        <button
            type="button"
            class="toolbar-btn">
            <i data-lucide="arrow-up-down"></i>
            <span>Sort</span>
        </button>

        <div class="toolbar-divider"></div>

        <div class="view-toggle">

            <button
                type="button"
                id="dash-view-cards"
                class="toolbar-btn active"
                aria-label="Card View">

                <i data-lucide="layout-grid"></i>

            </button>

            <button
                type="button"
                id="dash-view-rows"
                class="toolbar-btn"
                aria-label="List View">

                <i data-lucide="rows-3"></i>

            </button>

        </div>

        <a
            href="{{ route('matches.create') }}"
            class="btn-primary">

            <i data-lucide="plus"></i>
            <span>New Match</span>

        </a>

    </div>

</div>