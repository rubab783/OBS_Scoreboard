/**
 * Theme manager — light/dark toggle.
 *
 * - The initial theme is rendered server-side on <html data-theme="...">
 *   so there is no flash of the wrong theme on page load.
 * - Toggling flips the attribute immediately (instant, no network wait),
 *   then persists the choice to the backend.
 * - The backend broadcasts the change over the user's private websocket
 *   channel, so any other open tab/device for this account updates live.
 */

document.addEventListener('DOMContentLoaded', () => {
    const root = document.documentElement;
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content');
    const userId = document
        .querySelector('meta[name="user-id"]')
        ?.getAttribute('content');

    function currentTheme() {
        return root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
    }

    function applyTheme(theme) {
        root.setAttribute('data-theme', theme === 'dark' ? 'dark' : 'light');

        document
            .querySelectorAll('[data-theme-toggle]')
            .forEach((btn) => btn.setAttribute('aria-pressed', theme === 'dark'));

        document
            .querySelectorAll('.theme-switch-option')
            .forEach((btn) => {
                btn.classList.toggle('active', btn.dataset.themeOption === theme);
            });
    }

    async function persistTheme(theme) {
        if (!csrfToken) return;

        try {
            await fetch('/profile/theme', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    Accept: 'application/json',
                },
                body: JSON.stringify({ theme }),
            });
        } catch (error) {
            console.error('Theme sync error:', error);
        }
    }

    function setTheme(theme) {
        if (theme === currentTheme()) return;
        applyTheme(theme);
        persistTheme(theme);
    }

    // Toggle buttons (topbar icon button — flips between light/dark).
    document.querySelectorAll('[data-theme-toggle]').forEach((btn) => {
        btn.addEventListener('click', () => {
            setTheme(currentTheme() === 'dark' ? 'light' : 'dark');
        });
    });

    // Explicit option buttons (preferences page segmented control).
    document.querySelectorAll('.theme-switch-option').forEach((btn) => {
        btn.addEventListener('click', () => setTheme(btn.dataset.themeOption));
    });

    applyTheme(currentTheme());

    // Live sync from other tabs/devices for this account.
    if (userId && window.Echo) {
        window.Echo.private(`App.Models.User.${userId}`)
            .listen('.theme.updated', (event) => {
                if (event?.theme) applyTheme(event.theme);
            });
    }
});
