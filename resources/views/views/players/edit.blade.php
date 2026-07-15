@extends('layouts.app')

@section('title','Edit Player')

@section('content')

<div class="dash-app">

<div class="dash-shell">

<x-dashboard.sidebar/>

<main class="dash-main">

<x-dashboard.topbar
title="Edit Player"
subtitle="Update player information"
/>

<div class="page-actions" style="margin-bottom:20px">

    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
        ← Dashboard
    </a>

    <a href="{{ route('players.index') }}" class="btn btn-outline">
        Players
    </a>

</div>

<div class="card">

<form
action="{{ route('players.update',$player) }}"
method="POST"
enctype="multipart/form-data"
>

@csrf
@method('PUT')

@include('players.partials.form')

</form>

</div>

</main>

</div>

</div>

@endsection