@extends('layouts.app')

@section('title', 'Add Player')

@section('content')

@if ($errors->any())
    <div style="background:#fee2e2;color:#991b1b;padding:16px;border-radius:8px;margin-bottom:20px;">
        <strong>Validation Errors:</strong>

        <ul style="margin-top:10px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="page-header">

    <div>
        <h1>Add New Player</h1>
        <p>Create a player for your upcoming matches.</p>
    </div>

    <div class="page-actions">

        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            ← Dashboard
        </a>

        <a href="{{ route('players.index') }}" class="btn btn-outline">
            Players
        </a>

    </div>

</div>

<div class="card">

    <form
        action="{{ route('players.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div class="form-grid">

            {{-- Team --}}
            <div class="form-group">

                <label>Team</label>

                <select name="team_id" required>

                    <option value="">Select Team</option>

                    @foreach($teams as $team)

                        <option
                            value="{{ $team->id }}"
                            @selected(old('team_id') == $team->id)
                        >
                            {{ $team->name }}
                        </option>

                    @endforeach

                </select>

                @error('team_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>

            {{-- Player Name --}}
            <div class="form-group">

                <label>Player Name</label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                >

                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>

            {{-- Jersey Number --}}
            <div class="form-group">

                <label>Jersey Number</label>

                <input
                    type="number"
                    name="jersey_number"
                    value="{{ old('jersey_number') }}"
                >

                @error('jersey_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>

            {{-- Position --}}
            <div class="form-group">

                <label>Position</label>

                <select name="position">

                    <option value="">Select Position</option>

                    <option value="Goalkeeper" @selected(old('position') == 'Goalkeeper')>
                        Goalkeeper
                    </option>

                    <option value="Defender" @selected(old('position') == 'Defender')>
                        Defender
                    </option>

                    <option value="Midfielder" @selected(old('position') == 'Midfielder')>
                        Midfielder
                    </option>

                    <option value="Forward" @selected(old('position') == 'Forward')>
                        Forward
                    </option>

                </select>

                @error('position')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>

            {{-- Photo --}}
            <div class="form-group">

                <label>Player Photo</label>

                <input
                    type="file"
                    name="photo"
                    accept="image/*"
                >

                @error('photo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

            </div>

            {{-- Captain --}}
            <div class="form-group checkbox-group">

                <label>

                    <input
                        type="checkbox"
                        name="is_captain"
                        value="1"
                        @checked(old('is_captain'))
                    >

                    Team Captain

                </label>

            </div>

            {{-- Starter --}}
            <div class="form-group checkbox-group">

                <label>

                    <input
                        type="checkbox"
                        name="is_starter"
                        value="1"
                        @checked(old('is_starter'))
                    >

                    Starting XI

                </label>

            </div>

        </div>

        <div class="form-actions">

            <a href="{{ route('players.index') }}" class="btn btn-outline">
                Cancel
            </a>

            <button type="submit" class="btn btn-primary">
                Save Player
            </button>

        </div>

    </form>

</div>

@endsection

