@extends('layouts.dashboard')

@section('title', 'Dashboard')

@php
    $title = 'Dashboard';
    $subtitle = 'Monitor live matches and manage your broadcasts.';
@endphp

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
@endpush

@section('content')

{{-- Stats --}}
<x-dashboard.stats
    :activeCount="$activeCount"
    :pausedCount="$pausedCount"
    :scheduledCount="$scheduledCount"
    :archivedCount="$archivedCount"
    :createdThisWeek="$createdThisWeek"
    :createdLastWeek="$createdLastWeek"
/>

{{-- Toolbar --}}
<x-dashboard.toolbar :matches="$matches" />

{{-- Match List --}}
<div class="matches-section glass-panel">

    <div class="matches-header">

        <div>
            <h2>Live Events</h2>
            <p id="dash-events-summary">{{ $matches->count() }} {{ Str::plural('Event', $matches->count()) }}</p>
        </div>

        <a href="{{ route('matches.create') }}" class="btn-primary">
            <i data-lucide="plus"></i>
            Create Event
        </a>

    </div>

    <div id="dash-events-list" class="matches-list">

        @forelse($matches as $match)

            @include('components.dashboard.matches')

        @empty

            <div class="matches-empty">

                <i data-lucide="calendar-x"></i>

                <h3>No Events Yet</h3>

                <p>Create your first sporting event to start streaming.</p>

                <a href="{{ route('matches.create') }}" class="btn-primary">
                    <i data-lucide="plus"></i>
                    Create Event
                </a>

            </div>

        @endforelse

    </div>

    {{-- Shown only when filters/search hide every card --}}
    <div id="dash-no-results" class="matches-empty" hidden>
        <i data-lucide="search-x"></i>
        <h3>No matching events</h3>
        <p>Try a different search term or clear your filters.</p>
    </div>

</div>

@endsection

@push('scripts')
<script>
(function () {
    const searchInput   = document.getElementById('dash-search-input');
    const sportFilter    = document.getElementById('dash-filter-sport');
    const statusFilter   = document.getElementById('dash-filter-status');
    const sortSelect      = document.getElementById('dash-sort');
    const resetBtn        = document.getElementById('dash-filter-reset');
    const resultCount     = document.getElementById('dash-result-count');
    const eventsList       = document.getElementById('dash-events-list');
    const noResults        = document.getElementById('dash-no-results');
    const eventsSummary     = document.getElementById('dash-events-summary');

    if (!eventsList) return;

    const getCards = () => Array.from(eventsList.querySelectorAll('.event-card'));

    function applyFilters() {
        const query  = (searchInput?.value || '').trim().toLowerCase();
        const sport  = sportFilter?.value || '';
        const status = statusFilter?.value || '';
        const sort   = sortSelect?.value || 'newest';

        const cards = getCards();
        let visibleCount = 0;

        cards.forEach(card => {
            const matchesQuery  = !query || card.dataset.search.includes(query);
            const matchesSport  = !sport || card.dataset.sport === sport;
            const matchesStatus = !status || card.dataset.status === status;
            const visible = matchesQuery && matchesSport && matchesStatus;

            card.classList.toggle('match-card-hidden', !visible);
            if (visible) visibleCount++;
        });

        // Sort visible + hidden cards together so order is preserved
        // once filters are cleared again.
        const sorted = cards.sort((a, b) => {
            switch (sort) {
                case 'oldest':
                    return Number(a.dataset.created) - Number(b.dataset.created);
                case 'name-asc':
                    return a.dataset.name.localeCompare(b.dataset.name);
                case 'name-desc':
                    return b.dataset.name.localeCompare(a.dataset.name);
                case 'newest':
                default:
                    return Number(b.dataset.created) - Number(a.dataset.created);
            }
        });

        sorted.forEach(card => eventsList.appendChild(card));

        const filtersActive = Boolean(query || sport || status);
        if (resetBtn) resetBtn.hidden = !filtersActive;

        if (resultCount) {
            resultCount.textContent = filtersActive
                ? `${visibleCount} of ${cards.length} shown`
                : '';
        }

        if (eventsSummary && !filtersActive) {
            eventsSummary.textContent = `${cards.length} ${cards.length === 1 ? 'Event' : 'Events'}`;
        }

        if (noResults) {
            noResults.hidden = !(cards.length > 0 && visibleCount === 0);
        }
    }

    [searchInput, sportFilter, statusFilter, sortSelect].forEach(el => {
        if (!el) return;
        el.addEventListener(el.tagName === 'SELECT' ? 'change' : 'input', applyFilters);
    });

    if (resetBtn) {
        resetBtn.addEventListener('click', () => {
            if (searchInput) searchInput.value = '';
            if (sportFilter) sportFilter.value = '';
            if (statusFilter) statusFilter.value = '';
            applyFilters();
        });
    }

    applyFilters();

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
})();
</script>
@endpush
