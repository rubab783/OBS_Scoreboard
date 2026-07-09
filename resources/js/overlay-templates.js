document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('templateSearchInput');
    const grid = document.getElementById('templateGrid');

    if (!searchInput || !grid) {
        return;
    }

    window.lucide?.createIcons();

    searchInput.addEventListener('input', () => {
        const query = searchInput.value.trim().toLowerCase();
        const cards = grid.querySelectorAll('.template-card');

        cards.forEach((card) => {
            const name = card.dataset.templateName || '';
            card.style.display = name.includes(query) ? '' : 'none';
        });
    });
});