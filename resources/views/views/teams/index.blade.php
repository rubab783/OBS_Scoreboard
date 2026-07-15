@extends('layouts.app')

@section('title', 'Teams')

@section('content')

<div class="dash-app">

    <div class="dash-shell">

        <x-dashboard.sidebar />

        <main class="dash-main">

            <x-dashboard.topbar
                title="Teams"
                subtitle="Manage teams participating in your broadcasts"
            />

            <div class="page-toolbar">

                <form method="GET" class="toolbar-search">

                    <input
                        type="text"
                        name="search"
                        placeholder="Search teams..."
                        value="{{ request('search') }}"
                    >

                </form>

                <div class="toolbar-actions">

                    <a href="{{ route('dashboard') }}"
                       class="btn-outline">

                        ← Dashboard

                    </a>

                    <a href="{{ route('teams.create') }}"
                       class="btn-primary">

                        + Add Team

                    </a>

                </div>

            </div>

            <div class="card">

                @include('teams.partials.table')

            </div>

        </main>

    </div>

</div>

@endsection