document.addEventListener('DOMContentLoaded', () => {
    const liveToggleBtn = document.getElementById('liveToggleBtn');
    const liveToggleCard = document.getElementById('liveToggleCard');
    const copyOverlayUrlBtn = document.getElementById('copyOverlayUrlBtn');

    if (!liveToggleBtn && !copyOverlayUrlBtn) {
        return;
    }

    window.lucide?.createIcons();

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content');

    /* ── Live On Air toggle ── */

    if (liveToggleBtn && liveToggleCard) {
        const matchId = liveToggleCard.dataset.matchId;

        liveToggleBtn.addEventListener('click', async () => {
            const isCurrentlyLive = liveToggleCard.dataset.live === '1';
            const newLiveState = !isCurrentlyLive;

            liveToggleCard.dataset.live = newLiveState ? '1' : '0';
            liveToggleBtn.classList.toggle('toggle-on', newLiveState);

            try {
                const response = await fetch(`/overlay-config/${matchId}/toggle-live`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        Accept: 'application/json',
                    },
                    body: JSON.stringify({ is_live: newLiveState }),
                });

                if (!response.ok) throw new Error('Request failed');
            } catch (error) {
                liveToggleCard.dataset.live = isCurrentlyLive ? '1' : '0';
                liveToggleBtn.classList.toggle('toggle-on', isCurrentlyLive);
                console.error('Failed to toggle live status:', error);
            }
        });
    }

    /* ── Copy OBS Browser Source URL ── */

    if (copyOverlayUrlBtn) {
        const urlInput = document.getElementById('overlaySourceUrl');

        copyOverlayUrlBtn.addEventListener('click', async () => {
            if (!urlInput || !urlInput.value) return;

            const success = await copyTextToClipboard(urlInput.value);
            showCopyFeedback(copyOverlayUrlBtn, success);
        });
    }

    /**
     * Attempts the modern Clipboard API first, falls back to the
     * legacy execCommand approach for browsers/contexts that block it.
     */
    async function copyTextToClipboard(text) {
        if (navigator.clipboard && window.isSecureContext) {
            try {
                await navigator.clipboard.writeText(text);
                return true;
            } catch (error) {
                console.warn('Clipboard API failed, trying fallback:', error);
            }
        }

        try {
            const tempInput = document.createElement('textarea');
            tempInput.value = text;
            tempInput.style.position = 'fixed';
            tempInput.style.opacity = '0';
            document.body.appendChild(tempInput);
            tempInput.focus();
            tempInput.select();
            const copied = document.execCommand('copy');
            document.body.removeChild(tempInput);
            return copied;
        } catch (error) {
            console.error('Fallback copy failed:', error);
            return false;
        }
    }

    function showCopyFeedback(button, success) {
        const originalHTML = button.innerHTML;

        button.innerHTML = success
            ? '<i data-lucide="check"></i> Copied'
            : '<i data-lucide="x"></i> Failed';

        button.classList.toggle('copy-btn-success', success);
        button.classList.toggle('copy-btn-error', !success);
        window.lucide?.createIcons();

        setTimeout(() => {
            button.innerHTML = originalHTML;
            button.classList.remove('copy-btn-success', 'copy-btn-error');
            window.lucide?.createIcons();
        }, 2000);
    }
    /* ── Theme card selection + accent color presets ── */

    document.querySelectorAll('.theme-option').forEach((option) => {
        option.addEventListener('click', () => {
            document.querySelectorAll('.theme-option').forEach((el) => el.classList.remove('theme-option-active'));
            option.classList.add('theme-option-active');
        });
    });

    const accentColorInput = document.getElementById('accentColorInput');

    document.querySelectorAll('.color-swatch-preset').forEach((swatch) => {
        swatch.addEventListener('click', () => {
            if (accentColorInput) {
                accentColorInput.value = swatch.dataset.color;
            }
        });
    });
});