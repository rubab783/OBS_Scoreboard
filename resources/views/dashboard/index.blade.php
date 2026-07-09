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
    :scheduledCount="$scheduledCount"
    :archivedCount="$archivedCount"
/>

{{-- Toolbar --}}
<x-dashboard.toolbar />

{{-- Match List --}}
<div class="matches-section glass-panel">

    <div class="matches-header">

        <div>
            <h2>Live Events</h2>
            <p>{{ $matches->count() }} Events</p>
        </div>

        <a href="{{ route('matches.create') }}" class="btn-primary">
            Create Event
        </a>

    </div>

    <div id="dash-events-list" class="matches-list">

        @forelse($matches as $match)

            @include('components.dashboard.matches')

        @empty

            <div class="matches-empty">

                <i data-lucide="calendar-x"></i>

                <h3>No Events Found</h3>

                <p>Create your first sporting event.</p>

            </div>

        @endforelse

    </div>

</div>

@endsection

@push('scripts')

<script>

const searchInput = document.getElementById('dash-search-input');

if (searchInput) {

    searchInput.addEventListener('keyup', function () {

        const keyword = this.value.toLowerCase();

        document.querySelectorAll('#dash-events-list .match-card').forEach(card => {

            card.style.display = card.innerText.toLowerCase().includes(keyword)
                ? ''
                : 'none';

        });

    });

}

if (typeof lucide !== 'undefined') {
    lucide.createIcons();
}

</script>

@endpush