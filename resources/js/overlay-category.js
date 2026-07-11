document.addEventListener('DOMContentLoaded', () => {
    const scrollContainer = document.querySelector('.category-pills-scroll');

    if (!scrollContainer) {
        return;
    }

    const pills = Array.from(scrollContainer.querySelectorAll('.category-pill'));

    pills.forEach((pill, index) => {
        pill.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowRight' && pills[index + 1]) {
                event.preventDefault();
                pills[index + 1].focus();
            }
            if (event.key === 'ArrowLeft' && pills[index - 1]) {
                event.preventDefault();
                pills[index - 1].focus();
            }
        });
    });

    // Keep the active pill scrolled into view on load.
    const activePill = scrollContainer.querySelector('.category-pill-active');
    activePill?.scrollIntoView({ behavior: 'instant', inline: 'center', block: 'nearest' });
});