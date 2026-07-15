@extends('layouts.newevent')

@section('title', 'Configure Overlay — ' . $match->name)

@section('content')

    <div class="configure-wrapper">

        <a href="{{ route('overlay.select-template', $match) }}" class="overlay-back-link">
            <i data-lucide="arrow-left"></i> Back
        </a>

        @include('overlay.components.wizard-progress', ['step' => 3, 'totalSteps' => 3, 'label' => 'Configure Overlay'])

        <div class="configure-header">
            <div>
                <h1 class="wizard-heading configure-heading">{{ $match->name }}</h1>
                <p class="wizard-subheading configure-subheading">Fine-tune your overlay — changes preview instantly on the left</p>
            </div>

            <div class="overlay-live-toggle glass-card"
                 id="liveToggleCard"
                 data-live="{{ $settings->is_live ? '1' : '0' }}"
                 data-match-id="{{ $match->id }}">
                <span class="overlay-live-label">
                    <i data-lucide="radio"></i>
                    On Air
                </span>
                <button type="button" class="toggle-switch {{ $settings->is_live ? 'toggle-on' : '' }}" id="liveToggleBtn">
                    <span class="toggle-knob"></span>
                </button>
            </div>
        </div>

        <div class="configure-columns">

            {{-- Live Preview --}}
            <div class="configure-preview-panel glass-card">
                <div class="configure-preview-label">
                    <i data-lucide="monitor-play"></i>
                    Live Preview
                    <span class="configure-preview-hint">Unsaved changes shown in real time</span>
                </div>

                <div class="configure-preview-frame">
                    <iframe id="livePreviewFrame"
                            src="{{ route('overlay.preview', $match) }}?{{ http_build_query($settings->only(['theme','animation_style','accent_color','show_logos','show_timer','show_score','show_period','show_sponsor','show_ticker','ticker_text'])) }}"
                            title="Overlay live preview"></iframe>
                </div>
            </div>

            {{-- Settings --}}
            <div class="configure-settings-panel">

                <form action="{{ route('overlay.update', $match) }}" method="POST" enctype="multipart/form-data" id="configureForm" data-preview-url="{{ route('overlay.preview', $match) }}">
                    @csrf
                    @method('PUT')

                    <div class="glass-card overlay-config-card">
                        <div class="card-title">
                            <div class="card-icon card-icon-purple"><i data-lucide="palette"></i></div>
                            <div><h3>Appearance</h3><span>Theme, animation, color</span></div>
                        </div>

                        <div class="form-group">
                            <label>Theme</label>
                            <div class="theme-option-row">
                                @foreach (['default' => 'Default', 'minimal' => 'Minimal', 'broadcast-bold' => 'Bold'] as $value => $label)
                                    <label class="theme-option {{ $settings->theme === $value ? 'theme-option-active' : '' }}">
                                        <input type="radio" name="theme" value="{{ $value }}" @checked($settings->theme === $value)>
                                        <span class="theme-option-swatch theme-swatch-{{ $value }}"></span>
                                        {{ $label }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Animation Style</label>
                            <select name="animation_style" class="period-select">
                                @foreach (['none' => 'None', 'fade' => 'Fade', 'slide' => 'Slide'] as $value => $label)
                                    <option value="{{ $value }}" @selected($settings->animation_style === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Accent Color</label>
                            <div class="color-input-row">
                                <input type="color" name="accent_color" id="accentColorInput" class="color-picker" value="{{ $settings->accent_color ?? '#7C3AED' }}">
                                <div class="color-swatch-presets">
                                    @foreach (['#7C3AED', '#2563EB', '#EF4444', '#16A34A', '#F59E0B', '#EC4899'] as $preset)
                                        <button type="button" class="color-swatch-preset" style="--swatch-color: {{ $preset }}" data-color="{{ $preset }}"></button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card overlay-config-card">
                        <div class="card-title">
                            <div class="card-icon card-icon-green"><i data-lucide="eye"></i></div>
                            <div><h3>Visible Elements</h3><span>What appears on the broadcast</span></div>
                        </div>

                        @foreach ([
                            'show_logos'  => ['Team Logos', 'image'],
                            'show_timer'  => ['Match Timer', 'clock-3'],
                            'show_score'  => ['Scoreboard', 'hash'],
                            'show_period' => ['Period / Half', 'flag'],
                        ] as $field => [$label, $icon])
                            <div class="overlay-toggle-row">
                                <span class="overlay-toggle-label"><i data-lucide="{{ $icon }}"></i>{{ $label }}</span>
                                <label class="toggle-switch-input">
                                    <input type="checkbox" name="{{ $field }}" value="1" @checked($settings->$field)>
                                    <span class="toggle-switch-visual"></span>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="glass-card overlay-config-card">
                        <div class="card-title">
                            <div class="card-icon card-icon-pink"><i data-lucide="megaphone"></i></div>
                            <div><h3>Sponsor & Ticker</h3><span>Branding and scrolling text</span></div>
                        </div>

                        <div class="overlay-toggle-row">
                            <span class="overlay-toggle-label"><i data-lucide="image"></i>Show Sponsor Logo</span>
                            <label class="toggle-switch-input">
                                <input type="checkbox" name="show_sponsor" value="1" @checked($settings->show_sponsor)>
                                <span class="toggle-switch-visual"></span>
                            </label>
                        </div>

                        <label class="logo-dropzone">
                            <input type="file" name="sponsor_logo" hidden accept="image/*">
                            @if ($settings->sponsor_logo_url)
                                <img src="{{ $settings->sponsor_logo_url }}" alt="Sponsor" class="logo-dropzone-preview">
                                <span class="logo-dropzone-replace"><i data-lucide="refresh-cw"></i> Replace</span>
                            @else
                                <i data-lucide="image-plus"></i>
                                <span>Drop sponsor logo here or click to upload</span>
                            @endif
                        </label>

                        <div class="overlay-toggle-row">
                            <span class="overlay-toggle-label"><i data-lucide="scroll-text"></i>Show Ticker</span>
                            <label class="toggle-switch-input">
                                <input type="checkbox" name="show_ticker" value="1" @checked($settings->show_ticker)>
                                <span class="toggle-switch-visual"></span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Ticker Text</label>
                            <input type="text" name="ticker_text" placeholder="e.g. Live from National Stadium" value="{{ $settings->ticker_text }}">
                        </div>
                    </div>

                    <div class="overlay-save-bar glass-card">
                        <button type="button" class="btn-secondary" id="resetSettingsBtn">
                            <i data-lucide="rotate-ccw"></i> Reset
                        </button>
                        <button type="submit" class="btn-primary-large">
                            <i data-lucide="save"></i> Save Overlay Settings
                        </button>
                    </div>

                </form>

            </div>

        </div>

        <div class="glass-card overlay-source-card">
            <div class="overlay-source-info">
                <div class="card-icon card-icon-purple"><i data-lucide="link"></i></div>
                <div><h4>OBS Browser Source URL</h4><p>Add this URL as a Browser Source in OBS Studio</p></div>
            </div>
            <div class="overlay-source-url-row">
                <input type="text" readonly value="{{ route('overlay.render', $match) }}" id="overlaySourceUrl" class="overlay-source-input">
                <button type="button" class="btn-secondary" id="copyOverlayUrlBtn">
                    <i data-lucide="copy"></i> Copy
                </button>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    @vite(['resources/js/pages/live-preview.js', 'resources/js/pages/overlay-config.js'])
@endpush