document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('templateSearchInput');
    const grid = document.getElementById('templateGrid');
    const skeleton = document.getElementById('templateSkeleton');
    const emptyState = document.getElementById('templateEmptyState');
    const countLabel = document.getElementById('templateCountLabel');

    if (!searchInput || !grid) {
        return;
    }

    window.lucide?.createIcons();

    let searchTimeout = null;

    searchInput.addEventListener('input', () => {
        clearTimeout(searchTimeout);

        // Brief skeleton flash for perceived responsiveness on filter.
        grid.style.display = 'none';
        skeleton.hidden = false;

        searchTimeout = setTimeout(() => {
            applyFilter(searchInput.value.trim().toLowerCase());
            skeleton.hidden = true;
            grid.style.display = '';
        }, 180);
    });

    function applyFilter(query) {
        const cards = grid.querySelectorAll('.overlay-card-premium');
        let visibleCount = 0;

        cards.forEach((card) => {
            const name = card.dataset.templateName || '';
            const matches = name.includes(query);
            card.style.display = matches ? '' : 'none';
            if (matches) visibleCount++;
        });

        if (emptyState) {
            emptyState.hidden = visibleCount !== 0;
        }

        if (countLabel) {
            countLabel.textContent = `${visibleCount} overlay${visibleCount === 1 ? '' : 's'} available`;
        }
    }
});