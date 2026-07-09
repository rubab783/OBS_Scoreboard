@extends('layouts.app')
@section('title', 'Create Team')

@push('styles')
<style>
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .anim    { animation: slideUp 0.4s ease both; }
    .anim-d1 { animation-delay: 0.04s; }
    .anim-d2 { animation-delay: 0.08s; }
    .anim-d3 { animation-delay: 0.12s; }

    /* ── Page Header ── */
    .page-header {
        display: flex; align-items: flex-start;
        justify-content: space-between;
        gap: 16px; margin-bottom: 24px; flex-wrap: wrap;
    }
    .page-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 38px; font-weight: 700;
        line-height: 0.95; letter-spacing: 0.01em;
        color: var(--text); margin-bottom: 7px;
    }
    .page-sub { font-size: 13px; font-weight: 300; color: var(--muted); }

    /* ── Form Panel ── */
    .form-panel {
        background: var(--card);
        border: 1px solid var(--border-hi);
        border-radius: var(--radius-lg);
        overflow: hidden;
        max-width: 680px;
    }
    .panel-header {
        display: flex; align-items: center; gap: 9px;
        padding: 14px 20px;
        border-bottom: 1px solid var(--border);
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 15px; font-weight: 700;
        letter-spacing: 0.04em; color: var(--text);
    }
    .form-body { padding: 24px; display: flex; flex-direction: column; gap: 18px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .form-footer {
        display: flex; justify-content: flex-end; align-items: center; gap: 10px;
        padding: 16px 20px;
        border-top: 1px solid var(--border);
    }

    /* ── Fields ── */
    .field { display: flex; flex-direction: column; gap: 7px; }
    .field-label {
        font-size: 10.5px; font-weight: 600;
        letter-spacing: 0.09em; text-transform: uppercase;
        color: var(--muted);
    }
    .field-input {
        background: var(--surface, #0f0f17);
        border: 1px solid var(--border-hi);
        border-radius: var(--radius);
        padding: 10px 13px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px; font-weight: 300;
        color: var(--text); outline: none;
        transition: border-color 0.15s, background 0.15s, box-shadow 0.15s;
        -webkit-appearance: none;
    }
    .field-input::placeholder { color: var(--dimmed); }
    .field-input:focus {
        border-color: rgba(59,130,246,0.45);
        background: rgba(59,130,246,0.04);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.08);
    }
    .field-input.is-error { border-color: rgba(239,68,68,0.5); }
    .field-error { font-size: 11.5px; color: var(--red); }
    .field-hint { font-size: 11.5px; color: var(--dimmed); line-height: 1.5; }

    /* Checkbox toggle */
    .toggle-wrap {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 14px;
        background: var(--surface, #0f0f17);
        border: 1px solid var(--border-hi);
        border-radius: var(--radius);
        cursor: pointer;
        transition: border-color 0.15s;
    }
    .toggle-wrap:hover { border-color: var(--border-hover); }
    .toggle-wrap input[type="checkbox"] {
        width: 36px; height: 20px;
        appearance: none; -webkit-appearance: none;
        background: rgba(255,255,255,0.1);
        border: 1px solid var(--border-hi);
        border-radius: 999px; cursor: pointer;
        position: relative; flex-shrink: 0;
        transition: background 0.2s, border-color 0.2s;
    }
    .toggle-wrap input[type="checkbox"]::after {
        content: '';
        position: absolute; top: 2px; left: 2px;
        width: 14px; height: 14px;
        background: var(--dimmed); border-radius: 50%;
        transition: transform 0.2s, background 0.2s;
    }
    .toggle-wrap input[type="checkbox"]:checked {
        background: var(--blue);
        border-color: var(--blue);
    }
    .toggle-wrap input[type="checkbox"]:checked::after {
        transform: translateX(16px);
        background: #fff;
    }
    .toggle-text strong { display: block; font-size: 13px; color: var(--text); font-weight: 500; margin-bottom: 1px; }
    .toggle-text span { font-size: 11.5px; color: var(--dimmed); }

    /* Color swatches */
    .color-row { display: flex; gap: 8px; flex-wrap: wrap; margin-top: 2px; }
    .color-swatch {
        width: 28px; height: 28px; border-radius: 7px;
        border: 2px solid transparent;
        cursor: pointer;
        transition: transform 0.15s, border-color 0.15s;
    }
    .color-swatch:hover { transform: scale(1.1); }
    .color-swatch.selected { border-color: #fff; transform: scale(1.05); }

    /* Logo preview */
    .logo-preview-wrap {
        display: flex; align-items: center; gap: 14px;
        padding: 12px 14px;
        background: var(--surface, #0f0f17);
        border: 1px solid var(--border-hi);
        border-radius: var(--radius);
    }
    .logo-preview {
        width: 48px; height: 48px; border-radius: 10px;
        background: var(--card-hi);
        border: 1px solid var(--border-hi);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; overflow: hidden;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 20px; font-weight: 700; color: var(--dimmed);
    }
    .logo-preview img { width: 100%; height: 100%; object-fit: cover; display: none; }
    .logo-upload-label {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 7px 13px;
        background: var(--card-hi);
        border: 1px solid var(--border-hi);
        border-radius: var(--radius);
        font-size: 12px; font-weight: 500; color: var(--muted);
        cursor: pointer;
        transition: background 0.15s, color 0.15s, border-color 0.15s;
    }
    .logo-upload-label:hover { background: rgba(255,255,255,0.07); color: var(--text); border-color: var(--border-hover); }

    /* Divider */
    .form-divider {
        height: 1px; background: var(--border);
        margin: 4px 0;
    }
    .form-section-label {
        font-size: 10px; font-weight: 600;
        letter-spacing: 0.12em; text-transform: uppercase;
        color: var(--dimmed); margin-bottom: -4px;
    }

    @media (max-width: 560px) {
        .form-row { grid-template-columns: 1fr; }
        .page-title { font-size: 30px; }
    }
</style>
@endpush

@section('content')

{{-- ── Header ── --}}
<div class="page-header anim anim-d1">
    <div>
        <h1 class="page-title">Create Team</h1>
        <p class="page-sub">Add a new team to the scoreboard system</p>
    </div>
    <div style="margin-top:4px">
        <a href="{{ route('teams.index') }}" class="topbar-btn">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
            </svg>
            Back to Teams
        </a>
    </div>
</div>

{{-- ── Form ── --}}
<div class="form-panel anim anim-d2">

    <div class="panel-header">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
        </svg>
        Team Details
    </div>

    <form method="POST" action="{{ route('teams.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-body">

            {{-- Names --}}
            <p class="form-section-label">Identity</p>

            <div class="field">
                <label class="field-label" for="name">Team Name</label>
                <input
                    class="field-input {{ $errors->has('name') ? 'is-error' : '' }}"
                    type="text" id="name" name="name"
                    value="{{ old('name') }}"
                    placeholder="e.g. Team Alpha"
                    required autocomplete="off"
                >
                @error('name') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="field">
                    <label class="field-label" for="short_name">Short Name / Tag</label>
                    <input
                        class="field-input {{ $errors->has('short_name') ? 'is-error' : '' }}"
                        type="text" id="short_name" name="short_name"
                        value="{{ old('short_name') }}"
                        placeholder="e.g. ALF"
                        maxlength="6" autocomplete="off"
                    >
                    @error('short_name') <span class="field-error">{{ $message }}</span> @enderror
                    <span class="field-hint">Max 6 characters. Shown on scoreboard.</span>
                </div>

                <div class="field">
                    <label class="field-label" for="description">Description</label>
                    <input
                        class="field-input"
                        type="text" id="description" name="description"
                        value="{{ old('description') }}"
                        placeholder="Optional short bio"
                        autocomplete="off"
                    >
                </div>
            </div>

            <div class="form-divider"></div>

            {{-- Branding --}}
            <p class="form-section-label">Branding</p>

            {{-- Logo --}}
            <div class="field">
                <label class="field-label">Team Logo</label>
                <div class="logo-preview-wrap">
                    <div class="logo-preview" id="logoPreview">
                        <img id="logoImg" src="" alt="">
                        <span id="logoPlaceholder">?</span>
                    </div>
                    <div>
                        <label class="logo-upload-label" for="logo">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/>
                                <path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3"/>
                            </svg>
                            Upload Logo
                        </label>
                        <input type="file" id="logo" name="logo" accept="image/*" style="display:none"
                               onchange="previewLogo(this)">
                        <p class="field-hint" style="margin-top:6px">PNG, JPG or SVG. Recommended 200×200px.</p>
                    </div>
                </div>
                @error('logo') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            {{-- Primary Color --}}
            <div class="field">
                <label class="field-label">Primary Color</label>
                <div class="color-row" id="colorSwatches">
                    @foreach(['#3b82f6','#8b5cf6','#ec4899','#22c55e','#f59e0b','#ef4444','#06b6d4','#f97316','#a855f7','#14b8a6'] as $c)
                        <div class="color-swatch {{ $c === '#3b82f6' ? 'selected' : '' }}"
                             style="background:{{ $c }}"
                             onclick="selectColor('{{ $c }}', this)"
                             title="{{ $c }}">
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="primary_color" id="primaryColorInput" value="{{ old('primary_color', '#3b82f6') }}">
                @error('primary_color') <span class="field-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-divider"></div>

            {{-- Status --}}
            <p class="form-section-label">Settings</p>

            <div class="field">
                <label class="field-label">Status</label>
                <label class="toggle-wrap" for="is_active">
                    <input type="checkbox" id="is_active" name="is_active" value="1"
                           {{ old('is_active', true) ? 'checked' : '' }}>
                    <div class="toggle-text">
                        <strong>Active</strong>
                        <span>Team is visible and available for match selection</span>
                    </div>
                </label>
            </div>

        </div>

        <div class="form-footer anim anim-d3">
            <a href="{{ route('teams.index') }}" class="topbar-btn">Cancel</a>
            <button type="submit" class="topbar-btn primary" id="submitBtn">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                Create Team
            </button>
        </div>

    </form>
</div>

@endsection

@push('scripts')
<script>
    function selectColor(color, el) {
        document.querySelectorAll('#colorSwatches .color-swatch').forEach(s => s.classList.remove('selected'));
        el.classList.add('selected');
        document.getElementById('primaryColorInput').value = color;

        const placeholder = document.getElementById('logoPlaceholder');
        placeholder.style.color = color;

        const shortInput = document.getElementById('short_name');
        placeholder.textContent = shortInput.value
            ? shortInput.value.substring(0, 2).toUpperCase()
            : '?';
    }

    function previewLogo(input) {
        if (!input.files || !input.files[0]) return;
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('logoImg');
            const placeholder = document.getElementById('logoPlaceholder');
            img.src = e.target.result;
            img.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }

    // Update avatar preview as user types short name
    document.getElementById('short_name')?.addEventListener('input', function() {
        const placeholder = document.getElementById('logoPlaceholder');
        if (document.getElementById('logoImg').style.display !== 'block') {
            placeholder.textContent = this.value
                ? this.value.substring(0, 2).toUpperCase()
                : '?';
        }
    });

    // Loading state on submit
    document.querySelector('form')?.addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.textContent = 'Creating…';
    });
</script>
@endpush