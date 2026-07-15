@extends('layouts.newevent')

@section('title', 'Select Overlay — ' . $match->name)

@section('content')

    <div class="wizard-stage wizard-stage-wide">

        <a href="{{ route('overlay.select-sport', $match) }}" class="overlay-back-link">
            <i data-lucide="arrow-left"></i> Back
        </a>

        @include('overlay.components.wizard-progress', ['step' => 2, 'totalSteps' => 3, 'label' => 'Select Overlay'])

        <div class="wizard-hero-text">
            <h1 class="wizard-heading">Select an Overlay for {{ $match->sport }}</h1>
            <p class="wizard-subheading">Choose the design you want to broadcast — you can fine-tune it in the next step</p>
        </div>

        <div class="template-gallery-toolbar">
            @include('overlay.components.category-tabs', ['categories' => $categories, 'activeCategory' => $activeCategory, 'match' => $match])

            <div class="template-search-premium">
                <i data-lucide="search"></i>
                <input type="text" id="templateSearchInput" placeholder="Search from {{ $templates->count() }} overlays">
            </div>
        </div>

        <p class="template-count-label" id="templateCountLabel">{{ $templates->count() }} overlays available</p>

        <div id="templateSkeleton" class="overlay-card-grid overlay-card-grid-skeleton" hidden>
            @for ($i = 0; $i < 6; $i++)
                <div class="overlay-card-skeleton"></div>
            @endfor
        </div>

        @if ($templates->isEmpty())

            <div class="glass-card overlay-empty-state" id="templateEmptyState">
                <i data-lucide="layout-template"></i>
                <h3>No overlays found</h3>
                <p>Try a different category or search term.</p>
            </div>

        @else

            <div class="overlay-card-grid" id="templateGrid">
                @foreach ($templates as $template)
                    @include('overlay.components.overlay-card', [
                        'template' => $template,
                        'match'    => $match,
                        'selected' => $selectedTemplateId === $template->id,
                    ])
                @endforeach
            </div>

            <div class="glass-card overlay-empty-state" id="templateEmptyState" hidden>
                <i data-lucide="search-x"></i>
                <h3>No matches for your search</h3>
                <p>Try a different keyword.</p>
            </div>

        @endif

    </div>

@endsection

@push('scripts')
    @vite(['resources/js/pages/overlay-search.js', 'resources/js/pages/overlay-category.js'])
@endpush