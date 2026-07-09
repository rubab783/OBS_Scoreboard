@extends('layouts.app')

@section('title','Select Overlay')

@section('content')

<div class="wizard">

    <div class="wizard-head">

        <span class="step">
            Step 2 of 6
        </span>

        <h1>Select an Overlay</h1>

    </div>

    <div class="overlay-grid">

        @for($i=1;$i<=20;$i++)

            <div class="overlay-card">

                <div class="overlay-preview">
                    Preview
                </div>

                <div class="overlay-name">
                    Dark Blue {{ $i }}
                </div>

            </div>

        @endfor

    </div>

    <div class="wizard-actions">

        <a href="{{ route('setup.match') }}"
           class="btn-primary">
            Continue
        </a>

    </div>

</div>

@endsection