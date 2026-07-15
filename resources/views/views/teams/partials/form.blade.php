<div class="form-grid">

    {{-- Team Name --}}
    <div class="form-group">

        <label>Team Name</label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $team->name ?? '') }}"
            placeholder="Manchester United"
            required
        >

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    {{-- Short Name --}}
    <div class="form-group">

        <label>Short Name</label>

        <input
            type="text"
            name="short_name"
            maxlength="10"
            value="{{ old('short_name', $team->short_name ?? '') }}"
            placeholder="MUN"
            required
        >

        @error('short_name')
            <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    {{-- Primary Color --}}
    <div class="form-group">

        <label>Primary Color</label>

        <input
            type="color"
            name="primary_color"
            value="{{ old('primary_color', $team->primary_color ?? '#2563eb') }}"
        >

    </div>

    {{-- Secondary Color --}}
    <div class="form-group">

        <label>Secondary Color</label>

        <input
            type="color"
            name="secondary_color"
            value="{{ old('secondary_color', $team->secondary_color ?? '#ffffff') }}"
        >

    </div>

    {{-- Logo --}}
    <div class="form-group full-width">

        <label>Team Logo</label>

        <input
            type="file"
            name="logo"
            accept="image/*"
        >

        <small class="helper-text">

            PNG or JPG • Max 2MB

        </small>

    </div>

    {{-- Description --}}
    <div class="form-group full-width">

        <label>Description</label>

        <textarea
            rows="5"
            name="description"
            placeholder="Write a short description..."
        >{{ old('description', $team->description ?? '') }}</textarea>

    </div>

    {{-- Active --}}
    @isset($team)

    <div class="form-group full-width">

        <label class="switch-row">

            <input
                type="checkbox"
                name="is_active"
                value="1"
                {{ old('is_active', $team->is_active) ? 'checked' : '' }}
            >

            <span>

                Active Team

            </span>

        </label>

    </div>

    @endisset

</div>