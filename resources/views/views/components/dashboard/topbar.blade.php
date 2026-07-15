<header class="topbar">

    <div class="topbar-left">

        <div class="title-group">

            <h1 class="topbar-title">
                {{ $title ?? 'Dashboard' }}
            </h1>

            <div class="status-pill">
                <span class="dot"></span>
                <span>System Online</span>
            </div>

        </div>

        <p class="topbar-subtitle">
            {{ $subtitle ?? 'Monitor live matches and manage your broadcasts.' }}
        </p>

    </div>

    <div class="topbar-right">

        <button
            type="button"
            class="icon-btn theme-toggle-btn"
            data-theme-toggle
            aria-label="Toggle dark mode"
            aria-pressed="{{ (auth()->user()->theme ?? 'light') === 'dark' ? 'true' : 'false' }}">

            <i data-lucide="sun" class="theme-icon theme-icon-sun"></i>
            <i data-lucide="moon" class="theme-icon theme-icon-moon"></i>

        </button>

        <button
            type="button"
            class="icon-btn"
            aria-label="Notifications">

            <i data-lucide="bell"></i>

            <span class="notification-dot"></span>

        </button>

        <a
            href="{{ route('profile.edit') }}"
            class="user-pill"
            aria-label="Profile">

            {{ strtoupper(substr(Auth::user()->name,0,1)) }}

        </a>

    </div>

</header>
