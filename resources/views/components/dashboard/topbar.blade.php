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

        <div class="search-box">

            <i data-lucide="search"></i>

            <input
                id="dash-search-input"
                type="search"
                placeholder="Search anything..."
                autocomplete="off">

        </div>

        <button
            type="button"
            class="icon-btn"
            aria-label="Notifications">

            <i data-lucide="bell"></i>

            <span class="notification-dot"></span>

        </button>

        <a
            href="{{ route('profile.edit') }}"
            class="user-pill">

            {{ strtoupper(substr(Auth::user()->name,0,1)) }}

        </a>

    </div>

</header>