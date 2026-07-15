@extends('layouts.app')

@section('title','Players')

@section('content')

<div class="dash-app">

    <div class="dash-shell">

        <x-dashboard.sidebar />

        <main class="dash-main">

            <x-dashboard.topbar
                title="Players Management"
                subtitle="Create, edit and organize players for upcoming matches."
            />

            {{-- Header --}}
            <div class="page-header">

                <div class="page-header-left">

                    <h2></h2>

                    <p>
                        
                    </p>

                </div>

                <div class="page-header-right">

                    <a href="{{ route('dashboard') }}" class="btn btn-outline">
                        ← Dashboard
                    </a>

                    <a href="{{ route('players.create') }}" class="btn btn-primary">
                        + Add Player
                    </a>

                </div>

            </div>

            {{-- Stats --}}
            <div class="stats-grid">

                <div class="stat-card">
                    <h3>{{ $totalPlayers }}</h3>
                    <p>Total Players</p>
                </div>

                <div class="stat-card">
                    <h3>{{ $totalTeams }}</h3>
                    <p>Teams</p>
                </div>

                <div class="stat-card">
                    <h3>{{ $captains }}</h3>
                    <p>Captains</p>
                </div>

                <div class="stat-card">
                    <h3>{{ $starters }}</h3>
                    <p>Starters</p>
                </div>

            </div>

            {{-- Toolbar --}}
            <div class="toolbar">

                <form method="GET" class="toolbar-search">

                    <input
                        type="text"
                        name="search"
                        placeholder="Search players..."
                        value="{{ request('search') }}"
                    >

                </form>

                <div class="toolbar-meta">

                    Showing {{ $players->count() }}
                    of {{ $players->total() }} players

                </div>

            </div>

            <div class="table-card">

                @include('players.partials.card')

            </div>

        </main>

    </div>

</div>

@endsection