@extends('layouts.app')

@section('title','Edit Team')

@section('content')

<div class="dash-app">

<div class="dash-shell">

<x-dashboard.sidebar/>

<main class="dash-main">

<x-dashboard.topbar
title="Edit Team"
subtitle="Update team details and branding"
/>

<div class="page-toolbar">

    <div>

        <h2>Edit {{ $team->name }}</h2>

        <p>
            Keep your team information up to date.
        </p>

    </div>

    <div class="toolbar-actions">

        <a
            href="{{ route('dashboard') }}"
            class="btn-outline">

            ← Dashboard

        </a>

        <a
            href="{{ route('teams.index') }}"
            class="btn-primary">

            All Teams

        </a>

    </div>

</div>

@if(session('success'))

<div class="alert-success">

{{ session('success') }}

</div>

@endif

@if($errors->any())

<div class="alert-danger">

<ul>

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<div class="team-edit-layout">

    <div class="card">

        <form
            action="{{ route('teams.update',$team) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            @include('teams.partials.form')

            <div class="form-actions">

                <a
                    href="{{ route('teams.index') }}"
                    class="btn-outline">

                    Cancel

                </a>

                <button
                    class="btn-primary">

                    Save Changes

                </button>

            </div>

        </form>

    </div>

    <aside class="team-sidebar">

        <div class="card">

            <div class="team-profile">

                @if($team->logo)

                    <img
                        src="{{ asset('storage/'.$team->logo) }}"
                        class="team-profile-logo"
                    >

                @else

                    <div class="team-profile-placeholder">

                        {{ strtoupper(substr($team->short_name,0,2)) }}

                    </div>

                @endif

                <h3>{{ $team->name }}</h3>

                <p>{{ $team->short_name }}</p>

                @if($team->is_active)

                    <span class="badge badge-success">

                        Active

                    </span>

                @else

                    <span class="badge badge-danger">

                        Inactive

                    </span>

                @endif

            </div>

        </div>

        <div class="card">

            <h3 class="sidebar-title">

                Statistics

            </h3>

            <div class="mini-stat">

                <span>Players</span>

                <strong>{{ $team->players()->count() }}</strong>

            </div>

            <div class="mini-stat">

                <span>Created</span>

                <strong>{{ $team->created_at->format('d M Y') }}</strong>

            </div>

            <div class="mini-stat">

                <span>Primary Color</span>

                <div class="color-chip">

                    <span
                        class="color-dot"
                        style="background:{{ $team->primary_color }}"
                    ></span>

                    {{ $team->primary_color }}

                </div>

            </div>

        </div>

    </aside>

</div>

<div class="card danger-zone">

<h3>

Danger Zone

</h3>

<p>

Deleting this team permanently removes it from the application.

</p>

<form
action="{{ route('teams.destroy',$team) }}"
method="POST"
onsubmit="return confirm('Delete this team permanently?')">

@csrf
@method('DELETE')

<button class="btn-danger">

Delete Team

</button>

</form>

</div>

</main>

</div>

</div>

@endsection