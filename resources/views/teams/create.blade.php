@extends('layouts.app')

@section('title', 'Create Team')

@section('content')

<div class="page-header">

    <div>
        <h1>Create Team</h1>
        <p>Add a team for matches, players and overlays.</p>
    </div>

    <div class="page-actions">

        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            ← Dashboard
        </a>

        <a href="{{ route('teams.index') }}" class="btn btn-outline">
            All Teams
        </a>

    </div>

</div>

@if($errors->any())
<div class="alert danger">
    <strong>Please fix the following errors:</strong>

    <ul style="margin-top:10px;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card">

<form
action="{{ route('teams.store') }}"
method="POST"
enctype="multipart/form-data"
>

@csrf

@include('teams.partials.form')

<div class="form-actions">

<a
href="{{ route('teams.index') }}"
class="btn btn-outline"
>

Cancel

</a>

<button class="btn btn-primary">

Create Team

</button>

</div>

</form>

</div>

@endsection