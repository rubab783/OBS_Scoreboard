@extends('layouts.app')

@section('title','Match Setup')

@section('content')

<div class="wizard-form">

    <h1>Match Information</h1>

    <div class="form-grid">

        <input
            type="text"
            placeholder="Team A">

        <input
            type="text"
            placeholder="Team B">

        <input
            type="date">

        <input
            type="time">

        <input
            type="text"
            placeholder="Tournament">

    </div>

    <a href="{{ route('setup.branding') }}"
       class="btn-primary">
       Continue
    </a>

</div>

@endsection