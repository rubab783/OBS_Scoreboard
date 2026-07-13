<div class="form-grid">

    <div class="form-group">

        <label>Team Name</label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $team->name ?? '') }}"
            required
        >

    </div>

    <div class="form-group">

        <label>Short Name</label>

        <input
            type="text"
            name="short_name"
            maxlength="10"
            value="{{ old('short_name', $team->short_name ?? '') }}"
            required
        >

    </div>

    <div class="form-group">

        <label>Primary Color</label>

        <input
            type="color"
            name="primary_color"
            value="{{ old('primary_color', $team->primary_color ?? '#2563eb') }}"
        >

    </div>

    <div class="form-group">

        <label>Secondary Color</label>

        <input
            type="color"
            name="secondary_color"
            value="{{ old('secondary_color', $team->secondary_color ?? '#111827') }}"
        >

    </div>

    <div class="form-group full-width">

        <label>Logo</label>

        <input
            type="file"
            name="logo"
            id="logoInput"
            accept="image/*"
        >

        <img
            id="logoPreview"
            class="logo-preview"
            style="display:none;"
        >

    </div>

    <div class="form-group full-width">

        <label>Description</label>

        <textarea
            name="description"
            rows="4"
        >{{ old('description', $team->description ?? '') }}</textarea>

    </div>

    @isset($team)

    <div class="form-group full-width">

        <label>

            <input
                type="checkbox"
                name="is_active"
                value="1"
                {{ old('is_active', $team->is_active) ? 'checked' : '' }}
            >

            Active Team

        </label>

    </div>

    @endisset

</div>

<script>

document
.getElementById('logoInput')
?.addEventListener('change',function(e){

const file=e.target.files[0];

if(!file) return;

const reader=new FileReader();

reader.onload=function(event){

const img=document.getElementById('logoPreview');

img.src=event.target.result;

img.style.display='block';

}

reader.readAsDataURL(file);

});

</script>