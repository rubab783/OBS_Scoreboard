@extends('layouts.newevent')

@section('title', 'Select Sport — ' . $match->name)

@section('content')

    <div class="wizard-wrapper">

        <div class="wizard-progress">
            <div class="wizard-progress-bar"><div class="wizard-progress-fill" style="width: 33%"></div></div>
            <span class="wizard-progress-label">1 / 3</span>
        </div>

        <a href="{{ route('overlay.edit', $match) }}" class="overlay-back-link">
            <i data-lucide="arrow-left"></i> Back
        </a>

        <span class="wizard-step-tag">Step 1 of 3</span>
        <h1 class="page-title">What sport are you streaming?</h1>
        <p class="page-subtitle">Select a sport to see compatible overlay designs</p>

        <form action="{{ route('overlay.update-sport', $match) }}" method="POST" class="sport-grid">
            @csrf

            @php
                $sportIcons = [
                    'Football' => 'circle-dot', 'Basketball' => 'circle', 'Cricket' => 'baseline',
                    'Esports' => 'gamepad-2', 'Volleyball' => 'circle-dashed', 'Rugby' => 'oval',
                    'Hockey' => 'shell', 'Tennis' => 'circle-small',
                ];
            @endphp

            @foreach ($sports as $sport)
                <button type="submit" name="sport" value="{{ $sport }}"
                        class="sport-card {{ $match->sport === $sport ? 'sport-card-active' : '' }}">
                    <i data-lucide="{{ $sportIcons[$sport] ?? 'trophy' }}"></i>
                    <span>{{ $sport }}</span>
                </button>
            @endforeach
        </form>

    </div>

@endsection