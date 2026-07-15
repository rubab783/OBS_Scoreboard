@props(['categories', 'activeCategory', 'match'])

<div class="category-pills-scroll">
    <a href="{{ route('overlay.select-template', $match) }}"
       class="category-pill {{ !$activeCategory ? 'category-pill-active' : '' }}">
        All
    </a>

    @foreach ($categories as $key => $label)
        <a href="{{ route('overlay.select-template', ['match' => $match, 'category' => $key]) }}"
           class="category-pill {{ $activeCategory === $key ? 'category-pill-active' : '' }}">
            {{ $label }}
        </a>
    @endforeach
</div>