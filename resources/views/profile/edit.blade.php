@extends('layouts.dashboard')

@section('title','Profile')

@php
$title='My Profile';
$subtitle='Manage your account information and security.';
@endphp

@section('content')

<div class="profile-page">

<div class="profile-grid">

<div class="profile-card">

<div class="profile-avatar">

{{ strtoupper(substr(Auth::user()->name,0,1)) }}

</div>

<div class="profile-name">

{{ Auth::user()->name }}

</div>

<div class="profile-email">

{{ Auth::user()->email }}

</div>

<div class="profile-role">

Administrator

</div>

</div>

<div class="profile-content">

@include('profile.partials.profile-information-form')

@include('profile.partials.update-password-form')

@include('profile.partials.delete-user-form')

</div>

</div>

</div>

@endsection