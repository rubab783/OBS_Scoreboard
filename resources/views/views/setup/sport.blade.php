@extends('layouts.app')

@section('title','Select Sport')

@section('content')

<div class="wizard">

    <div class="wizard-head">

        <span class="step">
            Step 1 of 6
        </span>

        <h1>
            What sport will you stream?
        </h1>

        <p>
            Select your sport to unlock compatible overlays.
        </p>

    </div>

    <div class="sport-grid">

        <a href="{{ route('setup.overlay') }}" class="sport-card">
            ⚽
            <span>Football</span>
        </a>

        <a href="{{ route('setup.overlay') }}" class="sport-card">
            🏀
            <span>Basketball</span>
        </a>

        <a href="{{ route('setup.overlay') }}" class="sport-card">
            🏏
            <span>Cricket</span>
        </a>

        <a href="{{ route('setup.overlay') }}" class="sport-card">
            🎮
            <span>Esports</span>
        </a>

    </div>

</div>

@endsection