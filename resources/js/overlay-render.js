document.addEventListener('DOMContentLoaded', () => {
    const timerEl = document.getElementById('overlayTimer');

    if (!timerEl) {
        return;
    }

    let baseSeconds = parseInt(timerEl.dataset.seconds || '0', 10);
    let timerStatus = timerEl.dataset.status || 'stopped';
    let runStartedAt = timerStatus === 'running' ? Date.now() : null;

    function formatTime(totalSeconds) {
        const mins = Math.floor(totalSeconds / 60).toString().padStart(2, '0');
        const secs = Math.floor(totalSeconds % 60).toString().padStart(2, '0');
        return `${mins}:${secs}`;
    }

    function currentElapsedSeconds() {
        if (timerStatus === 'running' && runStartedAt) {
            return baseSeconds + Math.floor((Date.now() - runStartedAt) / 1000);
        }
        return baseSeconds;
    }

    function renderTimer() {
        timerEl.textContent = formatTime(currentElapsedSeconds());
    }

    renderTimer();

    if (timerStatus === 'running') {
        setInterval(renderTimer, 250);
    }
});