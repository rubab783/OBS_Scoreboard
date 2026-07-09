{{-- resources/views/components/dashboard/sidebar.blade.php --}}

@php
    $operatorName = auth()->user()->name ?? 'Operator';

    $operatorInitials = collect(explode(' ', $operatorName))
        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
        ->take(2)
        ->implode('');
@endphp

<aside class="sidebar">

    <div>

        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" class="sidebar-logo">

            <span class="sidebar-logo-mark">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2L20 6.5V17.5L12 22L4 17.5V6.5L12 2Z"
                          stroke="currentColor"
                          stroke-width="1.6"/>
                    <circle cx="12"
                            cy="12"
                            r="3"
                            fill="currentColor"/>
                </svg>
            </span>

            <span class="sidebar-logo-text">
                Live<span>Score</span>
            </span>

        </a>

        <div class="sidebar-menu-label">
            Navigation
        </div>

        <ul class="sidebar-nav">

            {{-- Dashboard --}}
            <li>

                <a href="{{ route('dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="3" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.6"/>
                        <rect x="14" y="3" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.6"/>
                        <rect x="3" y="14" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.6"/>
                        <rect x="14" y="14" width="7" height="7" rx="1.5" stroke="currentColor" stroke-width="1.6"/>
                    </svg>

                    Dashboard

                    @if(request()->routeIs('dashboard'))
                        <span class="sidebar-link-dot"></span>
                    @endif

                </a>

            </li>

        

            {{-- New Event --}}
            <li>

                <a href="{{ route('matches.create') }}"
                   class="sidebar-link {{ request()->routeIs('matches.create') ? 'active' : '' }}">

                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"/>
                        <path d="M12 8V16M8 12H16"
                              stroke="currentColor"
                              stroke-width="1.6"
                              stroke-linecap="round"/>
                    </svg>

                    New Event

                    @if(request()->routeIs('matches.create'))
                        <span class="sidebar-link-dot"></span>
                    @endif

                </a>

            </li>

        
            {{-- Overlay (Coming Soon) --}}
            <li>

                <a href="{{ route('overlay.index') }}"
                   class="sidebar-link">

                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.6"/>
                        <path d="M19.4 15a1.65 1.65 0 00.33 1.82"
                              stroke="currentColor"
                              stroke-width="1.3"/>
                    </svg>

                    Overlay Config

                </a>

            </li>

            {{-- Profile --}}
            <li>

                <a href="{{ route('profile.edit') }}"
                   class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">

                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.6"/>
                        <path d="M4.5 20c1.4-3.6 4.5-5.5 7.5-5.5s6.1 1.9 7.5 5.5"
                              stroke="currentColor"
                              stroke-width="1.6"
                              stroke-linecap="round"/>
                    </svg>

                    Profile

                    @if(request()->routeIs('profile.*'))
                        <span class="sidebar-link-dot"></span>
                    @endif

                </a>

            </li>

        </ul>

    </div>

    <div class="sidebar-bottom">

        <div class="sidebar-quick">

            <div class="sidebar-quick-title">

                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                    <path d="M6 12h12M12 6v12"
                          stroke="currentColor"
                          stroke-width="1.6"
                          stroke-linecap="round"/>
                </svg>

                Quick Actions

            </div>

            <p>
           Manage matches, configure overlays, and control live productions from one place.
            </p>

        </div>

        <div class="sidebar-operator">

            <div class="sidebar-operator-avatar">
                {{ $operatorInitials ?: 'OP' }}
            </div>

            <div>

                <div class="sidebar-operator-name">
                    {{ $operatorName }}
                </div>

                <div class="sidebar-operator-status">
                    Online
                </div>

            </div>

            <div class="sidebar-operator-actions">

                <form method="POST"
                      action="{{ route('logout') }}">

                    @csrf

                    <button type="submit"
                            class="logout-btn"
                            title="Logout">

                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                            <path d="M15 17l5-5-5-5M20 12H9M12 19H6a2 2 0 01-2-2V7a2 2 0 012-2h6"
                                  stroke="currentColor"
                                  stroke-width="1.6"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>

                    </button>

                </form>

            </div>

        </div>

    </div>

</aside>