@extends('layouts.newevent')

@section('title','New Event')

@section('content')

<div class="event-page">

    <form
        action="{{ route('matches.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="event-form">

        @csrf

        <x-matches.page-header />

        <x-matches.metadata-card />

        <x-matches.teams-card />

        <x-matches.settings-card />

        <x-matches.footer-actions />

    </form>

</div>

@endsection