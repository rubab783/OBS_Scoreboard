document.addEventListener('DOMContentLoaded', () => {
    const timerEl = document.getElementById('matchTimer');

    // Guard: only run on the Match Control page.
    if (!timerEl) {
        return;
    }

    // Render Lucide icons for this page if Lucide is already loaded globally
    // (e.g. via CDN in the layout). Safe no-op if not present.
    window.lucide?.createIcons();

    const matchId = timerEl.dataset.matchId;

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content');

    const teamAScoreEl = document.getElementById('teamAScore');
    const teamBScoreEl = document.getElementById('teamBScore');
    const statusBadge = document.getElementById('matchStatusBadge');
    const statusText = document.getElementById('matchStatusText');
    const periodSelect = document.getElementById('periodSelect');
    const syncStatusText = document.getElementById('syncStatusText');
    const lastSyncedAt = document.getElementById('lastSyncedAt');

    const timerStartBtn = document.getElementById('timerStartBtn');
    const timerPauseBtn = document.getElementById('timerPauseBtn');
    const timerResetBtn = document.getElementById('timerResetBtn');

    /* ──────────────────────────────────────────────
       Timer state (drift-corrected)
       ────────────────────────────────────────────── */

    let baseSeconds = parseInt(timerEl.dataset.seconds || '0', 10);
    let timerStatus = timerEl.dataset.status || 'stopped';
    let runStartedAt = null;
    let intervalHandle = null;

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
        timerEl.dataset.status = timerStatus;
    }

    function startTickLoop() {
        if (intervalHandle) return;
        intervalHandle = setInterval(renderTimer, 250);
    }

    function stopTickLoop() {
        clearInterval(intervalHandle);
        intervalHandle = null;
    }

    function startTimer() {
        if (timerStatus === 'running') return;
        timerStatus = 'running';
        runStartedAt = Date.now();
        startTickLoop();
        renderTimer();
        persistTimer();
    }

    function pauseTimer() {
        if (timerStatus !== 'running') return;
        baseSeconds = currentElapsedSeconds();
        timerStatus = 'paused';
        runStartedAt = null;
        stopTickLoop();
        renderTimer();
        persistTimer();
    }

    function resetTimer() {
        baseSeconds = 0;
        timerStatus = 'stopped';
        runStartedAt = null;
        stopTickLoop();
        renderTimer();
        persistTimer();
    }

    renderTimer();
    if (timerStatus === 'running') {
        runStartedAt = Date.now();
        startTickLoop();
    }

    timerStartBtn?.addEventListener('click', startTimer);
    timerPauseBtn?.addEventListener('click', pauseTimer);
    timerResetBtn?.addEventListener('click', resetTimer);

    /* ──────────────────────────────────────────────
       Score controls
       ────────────────────────────────────────────── */

    document.querySelectorAll('.score-btn').forEach((btn) => {
        btn.addEventListener('click', () => {
            const team = btn.dataset.team;
            const action = btn.dataset.action;
            const scoreEl = team === 'a' ? teamAScoreEl : teamBScoreEl;

            let current = parseInt(scoreEl.dataset.score, 10);
            current = action === 'increment' ? current + 1 : Math.max(0, current - 1);

            scoreEl.dataset.score = current;
            scoreEl.textContent = current;

            persistScore(team, current);
        });
    });

    /* ──────────────────────────────────────────────
       Status + Period controls
       ────────────────────────────────────────────── */

    document.querySelectorAll('.status-btn').forEach((btn) => {
        btn.addEventListener('click', () => {
            const newStatus = btn.dataset.status;
            statusBadge.className = `match-status-badge status-${newStatus}`;
            statusText.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
            persistStatus(newStatus);
        });
    });

    periodSelect?.addEventListener('change', () => {
        persistPeriod(periodSelect.value);
    });

    /* ──────────────────────────────────────────────
       Sync indicator helpers
       ────────────────────────────────────────────── */

    function markSyncing() {
        if (syncStatusText) syncStatusText.textContent = 'Syncing...';
    }

    function markSynced() {
        if (syncStatusText) syncStatusText.textContent = 'Synced';
        if (lastSyncedAt) {
            const now = new Date();
            lastSyncedAt.textContent = `Last synced at ${now.toLocaleTimeString()}`;
        }
    }

    function markSyncFailed() {
        if (syncStatusText) syncStatusText.textContent = 'Sync failed';
    }

    /* ──────────────────────────────────────────────
       Persistence (fetch to backend)
       ────────────────────────────────────────────── */

    async function postUpdate(payload) {
        if (!matchId) return;

        markSyncing();

        try {
            const response = await fetch(`/matches/${matchId}/control-update`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    Accept: 'application/json',
                },
                body: JSON.stringify(payload),
            });

            if (!response.ok) throw new Error('Request failed');

            markSynced();
        } catch (error) {
            markSyncFailed();
            console.error('Match control sync error:', error);
        }
    }

    function persistScore(team, value) {
        postUpdate({ type: 'score', team, value });
    }

    function persistTimer() {
        postUpdate({
            type: 'timer',
            clock_seconds: baseSeconds,
            timer_status: timerStatus,
        });
    }

    function persistStatus(status) {
        postUpdate({ type: 'status', status });
    }

    function persistPeriod(period) {
        postUpdate({ type: 'period', period });
    }
});