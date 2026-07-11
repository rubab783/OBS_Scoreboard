@props(['template', 'match', 'selected' => false])

<div class="overlay-card-premium {{ $selected ? 'overlay-card-selected' : '' }}" data-template-name="{{ strtolower($template->name) }}">

    <div class="overlay-card-preview" style="--tpl-accent: {{ $template->accent_color }}; --tpl-secondary: {{ $template->secondary_color ?? $template->accent_color }}">

        @if ($template->thumbnail_url)
            <img src="{{ $template->thumbnail_url }}" alt="{{ $template->name }}" class="overlay-card-thumbnail">
        @else
            {{-- CSS-only mockup fallback when no thumbnail image is uploaded --}}
            <div class="tpl-mock-field @if($template->layout_style === 'fullscreen-center') tpl-mock-field-dark @endif"></div>

            @switch($template->layout_style)
                @case('bar-bottom-split')
                    <div class="tpl-mock-bar-split">
                        <span class="tpl-mock-chip tpl-mock-chip-accent">A</span>
                        <span class="tpl-mock-chip-center">0:0</span>
                        <span class="tpl-mock-chip tpl-mock-chip-secondary">B</span>
                    </div>
                    @break
                @case('pill-top-split')
                    <div class="tpl-mock-pill-top">TEAM A &nbsp;3:1&nbsp; TEAM B</div>
                    @break
                @case('list-panel')
                    <div class="tpl-mock-list">
                        <span class="tpl-mock-list-title">Team A</span>
                        <span class="tpl-mock-list-row"></span>
                        <span class="tpl-mock-list-row"></span>
                        <span class="tpl-mock-list-row"></span>
                    </div>
                    @break
                @case('card-team')
                    <div class="tpl-mock-team-card">
                        <span class="tpl-mock-logo-dot"></span>
                        <span>Team Name</span>
                    </div>
                    @break
                @case('pill-bottom-left')
                    <div class="tpl-mock-pill-left">
                        <span class="tpl-mock-pill-tag">Title</span>
                        <span class="tpl-mock-pill-text">Announcement text</span>
                    </div>
                    @break
                @case('pill-bottom-center')
                    <div class="tpl-mock-pill-center">Main announcement</div>
                    @break
                @case('banner-bottom')
                    <div class="tpl-mock-banner">Announcement title goes here</div>
                    @break
                @case('corner-badge')
                    <div class="tpl-mock-corner">Sponsor</div>
                    @break
                @case('card-penalty')
                    <div class="tpl-mock-penalty">
                        <span class="tpl-mock-penalty-swatch"></span>
                        <span>Player Name</span>
                    </div>
                    @break
                @case('fullscreen-center')
                    <div class="tpl-mock-fullscreen">
                        <span class="tpl-mock-fs-title">MATCH TITLE</span>
                        <span class="tpl-mock-fs-vs"><i class="tpl-mock-dot"></i> VS <i class="tpl-mock-dot tpl-mock-dot-2"></i></span>
                    </div>
                    @break
                @case('arrow-card')
                    <div class="tpl-mock-arrow"><i data-lucide="repeat"></i> Player Name</div>
                    @break
            @endswitch
        @endif

        @if ($selected)
            <div class="overlay-card-selected-overlay">
                <span class="overlay-card-check"><i data-lucide="check"></i></span>
            </div>
        @endif

        <span class="overlay-card-category-badge">{{ ucfirst(str_replace('_', ' ', $template->category)) }}</span>
    </div>

    <div class="overlay-card-body">
        <h4 class="overlay-card-name">{{ $template->name }}</h4>
        @if ($template->description)
            <p class="overlay-card-description">{{ $template->description }}</p>
        @endif

        <form action="{{ route('overlay.apply-template', [$match, $template]) }}" method="POST">
            @csrf
            <button type="submit" class="overlay-card-use-btn {{ $selected ? 'overlay-card-use-btn-selected' : '' }}"
                    @disabled($selected)>
                @if ($selected)
                    <i data-lucide="check-circle"></i> Currently Selected
                @else
                    <i data-lucide="sparkles"></i> Use Overlay
                @endif
            </button>
        </form>
    </div>

</div>