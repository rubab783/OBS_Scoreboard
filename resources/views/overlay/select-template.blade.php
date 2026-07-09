@extends('layouts.newevent')

@section('title', 'Select Overlay — ' . $match->name)

@section('content')

    <div class="wizard-wrapper">

        <div class="wizard-progress">
            <div class="wizard-progress-bar"><div class="wizard-progress-fill" style="width: 66%"></div></div>
            <span class="wizard-progress-label">2 / 3</span>
        </div>

        <a href="{{ route('overlay.select-sport', $match) }}" class="overlay-back-link">
            <i data-lucide="arrow-left"></i> Back
        </a>

        <span class="wizard-step-tag">Step 2 of 3</span>
        <h1 class="page-title">Select an Overlay for {{ $match->sport }}</h1>
        <p class="page-subtitle">Choose the overlay design you want to use for your stream</p>

        <div class="template-toolbar">
            <div class="category-tabs" id="categoryTabs">
                <a href="{{ route('overlay.select-template', $match) }}"
                   class="category-tab {{ !$activeCategory ? 'category-tab-active' : '' }}">All</a>
                @foreach ($categories as $key => $label)
                    <a href="{{ route('overlay.select-template', ['match' => $match, 'category' => $key]) }}"
                       class="category-tab {{ $activeCategory === $key ? 'category-tab-active' : '' }}">{{ $label }}</a>
                @endforeach
            </div>

            <div class="template-search">
                <i data-lucide="search"></i>
                <input type="text" id="templateSearchInput" placeholder="Search from {{ $templates->count() }} overlays">
            </div>
        </div>

        @if ($templates->isEmpty())

            <div class="glass-card overlay-empty-state">
                <i data-lucide="layout-template"></i>
                <h3>No templates found</h3>
                <p>Try a different category or sport.</p>
            </div>

        @else

            <div class="template-grid" id="templateGrid">
                @foreach ($templates as $template)
                    <form action="{{ route('overlay.apply-template', [$match, $template]) }}" method="POST"
                          class="template-card" data-template-name="{{ strtolower($template->name) }}">
                        @csrf

                        <button type="submit" class="template-card-button">

                            <div class="template-preview" style="--tpl-accent: {{ $template->accent_color }}; --tpl-secondary: {{ $template->secondary_color ?? $template->accent_color }}">

                                @switch($template->layout_style)

                                    @case('bar-bottom-split')
                                        <div class="tpl-mock-field"></div>
                                        <div class="tpl-mock-bar-split">
                                            <span class="tpl-mock-chip tpl-mock-chip-accent">A</span>
                                            <span class="tpl-mock-chip-center">0:0</span>
                                            <span class="tpl-mock-chip tpl-mock-chip-secondary">B</span>
                                        </div>
                                        @break

                                    @case('pill-top-split')
                                        <div class="tpl-mock-field"></div>
                                        <div class="tpl-mock-pill-top">TEAM A &nbsp;3:1&nbsp; TEAM B</div>
                                        @break

                                    @case('list-panel')
                                        <div class="tpl-mock-field"></div>
                                        <div class="tpl-mock-list">
                                            <span class="tpl-mock-list-title">Team A</span>
                                            <span class="tpl-mock-list-row"></span>
                                            <span class="tpl-mock-list-row"></span>
                                            <span class="tpl-mock-list-row"></span>
                                        </div>
                                        @break

                                    @case('card-team')
                                        <div class="tpl-mock-field"></div>
                                        <div class="tpl-mock-team-card">
                                            <span class="tpl-mock-logo-dot"></span>
                                            <span>Team Name</span>
                                        </div>
                                        @break

                                    @case('pill-bottom-left')
                                        <div class="tpl-mock-field"></div>
                                        <div class="tpl-mock-pill-left">
                                            <span class="tpl-mock-pill-tag">Title</span>
                                            <span class="tpl-mock-pill-text">Announcement text</span>
                                        </div>
                                        @break

                                    @case('pill-bottom-center')
                                        <div class="tpl-mock-field"></div>
                                        <div class="tpl-mock-pill-center">Main announcement</div>
                                        @break

                                    @case('banner-bottom')
                                        <div class="tpl-mock-field"></div>
                                        <div class="tpl-mock-banner">Announcement title goes here</div>
                                        @break

                                    @case('corner-badge')
                                        <div class="tpl-mock-field"></div>
                                        <div class="tpl-mock-corner">Sponsor</div>
                                        @break

                                    @case('card-penalty')
                                        <div class="tpl-mock-field"></div>
                                        <div class="tpl-mock-penalty">
                                            <span class="tpl-mock-penalty-swatch"></span>
                                            <span>Player Name</span>
                                        </div>
                                        @break

                                    @case('fullscreen-center')
                                        <div class="tpl-mock-field tpl-mock-field-dark"></div>
                                        <div class="tpl-mock-fullscreen">
                                            <span class="tpl-mock-fs-title">MATCH TITLE</span>
                                            <span class="tpl-mock-fs-vs">
                                                <i class="tpl-mock-dot"></i> VS <i class="tpl-mock-dot tpl-mock-dot-2"></i>
                                            </span>
                                        </div>
                                        @break

                                    @case('arrow-card')
                                        <div class="tpl-mock-field"></div>
                                        <div class="tpl-mock-arrow">
                                            <i data-lucide="repeat"></i> Player Name
                                        </div>
                                        @break

                                    @default
                                        <div class="tpl-mock-field"></div>
                                @endswitch

                            </div>

                            <span class="template-name">{{ $template->name }}</span>

                        </button>
                    </form>
                @endforeach
            </div>

        @endif

    </div>

@endsection

@push('scripts')
    @vite(['resources/js/overlay-templates.js'])
@endpush