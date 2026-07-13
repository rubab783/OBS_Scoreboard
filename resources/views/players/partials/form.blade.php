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
                    @selected(old('team_id', $player->team_id ?? '') == $team->id)
                >
                    {{ $team->name }}
                </option>

            @endforeach

        </select>

    </div>

    {{-- Name --}}
    <div class="form-group">

        <label>Player Name</label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $player->name ?? '') }}"
            required
        >

    </div>

    {{-- Jersey --}}
    <div class="form-group">

        <label>Jersey Number</label>

        <input
            type="text"
            name="jersey_number"
            value="{{ old('jersey_number', $player->jersey_number ?? '') }}"
        >

    </div>

    {{-- Position --}}
    <div class="form-group">

        <label>Position</label>

        <select name="position">

            <option value="">Choose Position</option>

            @foreach(['Goalkeeper','Defender','Midfielder','Forward'] as $position)

                <option
                    value="{{ $position }}"
                    @selected(old('position', $player->position ?? '') == $position)
                >
                    {{ $position }}
                </option>

            @endforeach

        </select>

    </div>
@if(!empty($player?->photo_url))

<div class="player-photo-preview">

    <img
        src="{{ $player->photo_url }}"
        alt="{{ $player->name }}"
    >

</div>

@endif
    {{-- Photo --}}
    <div class="form-group">

        <label>Player Photo</label>

        <input
            type="file"
            name="photo"
        >

    </div>

</div>

<div class="checkbox-grid">

    <label>

        <input
            type="checkbox"
            name="is_captain"
            value="1"
            @checked(old('is_captain', $player->is_captain ?? false))
        >

        Team Captain

    </label>

    <label>

        <input
            type="checkbox"
            name="is_starter"
            value="1"
            @checked(old('is_starter', $player->is_starter ?? false))
        >

        Starting XI

    </label>

</div>

<div class="form-actions">

    <button class="btn-primary">

        Save Player

    </button>

</div>