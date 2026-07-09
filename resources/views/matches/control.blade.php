@extends('layouts.newevent')

@section('title', 'Match Control Panel')

@section('content')

<div class="control-panel-wrapper">

    <x-matches.control-header
        :match="$match"
    />

    <div class="control-grid">

        <x-matches.team-control
            :match="$match"
            team="a"
        />

        <x-matches.timer-control
            :match="$match"
        />

        <x-matches.team-control
            :match="$match"
            team="b"
        />

    </div>

    <x-matches.sync-status />

</div>

@endsection

@push('scripts')
    @vite(['resources/js/match-control.js'])
@endpush