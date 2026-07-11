@extends('layouts.newevent')

@section('title', 'Select Sport — ' . $match->name)

@section('content')

    <div class="wizard-stage">

        <a href="{{ route('overlay.edit', $match) }}" class="overlay-back-link">
            <i data-lucide="arrow-left"></i> Back
        </a>

        @include('overlay.components.wizard-progress', [
    'step' => 1,
    'totalSteps' => 3,
    'label' => 'Select Sport'
])
        <div class="wizard-hero-text">
            <h1 class="wizard-heading">What sport are you streaming?</h1>
            <p class="wizard-subheading">Select your sport to see compatible overlay designs for {{ $match->name }}</p>
        </div>

        <form action="{{ route('overlay.update-sport', $match) }}" method="POST" class="sport-grid-premium" id="sportForm">
            @csrf

            @php
                $sportIcons = [
                    'Football'   => 'circle-dot',
                    'Basketball' => 'circle',
                    'Cricket'    => 'baseline',
                    'Esports'    => 'gamepad-2',
                    'Volleyball' => 'circle-dashed',
                    'Rugby'      => 'oval',
                    'Hockey'     => 'shell',
                    'Tennis'     => 'circle-small',
                ];
            @endphp

            @foreach ($sports as $sport)
                <button type="submit" name="sport" value="{{ $sport }}"
                        class="sport-card-premium {{ $match->sport === $sport ? 'sport-card-premium-active' : '' }}">
                    <span class="sport-card-glow"></span>
                    <span class="sport-card-icon-ring">
                        <i data-lucide="{{ $sportIcons[$sport] ?? 'trophy' }}"></i>
                    </span>
                    <span class="sport-card-label">{{ $sport }}</span>
                    @if ($match->sport === $sport)
                        <span class="sport-card-check"><i data-lucide="check"></i></span>
                    @endif
                </button>
            @endforeach
        </form>

    </div>

@endsection