@extends('layouts.newevent')

@section('title', 'Overlay Config')

@section('content')

    <div class="overlay-picker-wrapper">

        <div class="overlay-picker-header">
            <div>
                <h1 class="page-title">Overlay Configuration</h1>
                <p class="page-subtitle">Select a match to configure its broadcast overlay</p>
            </div>
        </div>

        @if ($matches->isEmpty())

            <div class="glass-card overlay-empty-state">
                <i data-lucide="tv-2"></i>
                <h3>No matches yet</h3>
                <p>Create a match first, then configure its overlay here.</p>
                <a href="{{ route('matches.create') }}" class="btn-primary-large">
                    <i data-lucide="plus"></i>
                    New Broadcast Event
                </a>
            </div>

        @else

            <div class="overlay-match-grid">
                @foreach ($matches as $match)
                    <a href="{{ route('overlay.edit', $match) }}" class="glass-card overlay-match-card">

                        <div class="overlay-match-card-header">
                            <span class="match-status-badge status-{{ $match->status }}">
                                <span class="status-dot"></span>
                                {{ ucfirst($match->status) }}
                            </span>

                            @if ($match->overlaySetting?->is_live)
                                <span class="overlay-live-pill">
                                    <i data-lucide="radio"></i>
                                    On Air
                                </span>
                            @endif
                        </div>

                        <h3 class="overlay-match-name">{{ $match->name }}</h3>

                        <div class="overlay-match-teams">
                            <span>{{ $match->team_a_display_name }}</span>
                            <span class="overlay-match-vs">vs</span>
                            <span>{{ $match->team_b_display_name }}</span>
                        </div>

                        <div class="overlay-match-footer">
                            <span class="overlay-theme-tag">
                                <i data-lucide="palette"></i>
                                {{ ucfirst($match->overlaySetting->theme ?? 'default') }}
                            </span>
                            <i data-lucide="chevron-right"></i>
                        </div>

                    </a>
                @endforeach
            </div>

        @endif

    </div>

@endsection