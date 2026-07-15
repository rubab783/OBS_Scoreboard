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
    const syncDot = document.getElementById('syncDot');
    const lastSyncedAt = document.getElementById('lastSyncedAt');
    const timerStatusPill = document.getElementById('timerStatusPill');

    const timerStartBtn = document.getElementById('timerStartBtn');
    const timerPauseBtn = document.getElementById('timerPauseBtn');
    const timerResetBtn = document.getElementById('timerResetBtn');
    const statusButtons = document.querySelectorAll('.status-btn');

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

        if (timerStatusPill) {
            timerStatusPill.textContent = timerStatus.charAt(0).toUpperCase() + timerStatus.slice(1);
            timerStatusPill.dataset.status = timerStatus;
        }
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
       Keyboard shortcut — spacebar toggles start/pause.
       Standard on broadcast control surfaces; ignored while
       typing in the period <select> or any input/textarea.
       ────────────────────────────────────────────── */

    document.addEventListener('keydown', (e) => {
        if (e.code !== 'Space') return;

        const tag = document.activeElement?.tagName;
        if (tag === 'SELECT' || tag === 'INPUT' || tag === 'TEXTAREA') return;

        e.preventDefault();
        timerStatus === 'running' ? pauseTimer() : startTimer();
    });

    /* ──────────────────────────────────────────────
       Score controls
       ────────────────────────────────────────────── */

    document.querySelectorAll('.score-btn').forEach((btn) => {
        btn.addEventListener('click', () => {
            const team = btn.dataset.team;
            const action = btn.dataset.action;
            const scoreEl = team === 'a' ? teamAScoreEl : teamBScoreEl;
            if (!scoreEl) return;

            let current = parseInt(scoreEl.dataset.score, 10);
            current = action === 'increment' ? current + 1 : Math.max(0, current - 1);

            scoreEl.dataset.score = current;
            scoreEl.textContent = current;

            // Small punch animation so a score change is unmistakable to
            // an operator glancing away from the screen mid-broadcast.
            scoreEl.classList.remove('score-bump');
            void scoreEl.offsetWidth; // restart the CSS animation
            scoreEl.classList.add('score-bump');

            persistScore(team, current);
        });
    });

    /* ──────────────────────────────────────────────
       Status + Period controls
       ────────────────────────────────────────────── */

    function setActiveStatusButton(newStatus) {
        statusButtons.forEach((btn) => {
            btn.classList.toggle('active', btn.dataset.status === newStatus);
        });
    }

    statusButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            const newStatus = btn.dataset.status;
            statusBadge.className = `match-status-badge status-${newStatus}`;
            statusText.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
            setActiveStatusButton(newStatus);
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
        if (syncDot) syncDot.dataset.state = 'syncing';
    }

    function markSynced() {
        if (syncStatusText) syncStatusText.textContent = 'Synced to overlay';
        if (syncDot) syncDot.dataset.state = 'synced';
        if (lastSyncedAt) {
            const now = new Date();
            lastSyncedAt.textContent = `Last synced at ${now.toLocaleTimeString()}`;
        }
    }

    function markSyncFailed() {
        if (syncStatusText) syncStatusText.textContent = 'Sync failed — retrying next change';
        if (syncDot) syncDot.dataset.state = 'failed';
    }

    /* ──────────────────────────────────────────────
       Persistence (fetch to backend, which then
       broadcasts to the OBS overlay over WebSocket)
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