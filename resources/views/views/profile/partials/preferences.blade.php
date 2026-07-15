<div class="glass-panel profile-card">

    <div class="card-header">

        <div>

            <h3>Preferences</h3>

            <p>
                Personalize your workspace.
            </p>

        </div>

    </div>

    <div class="preference-list">

        <div class="preference-item">

            <div>

                <h4>Theme</h4>

                <span>Light or dark interface</span>

            </div>

            @php $currentTheme = auth()->user()->theme ?? 'light'; @endphp

            <div class="theme-switch" role="group" aria-label="Theme">

                <button
                    type="button"
                    class="theme-switch-option {{ $currentTheme === 'light' ? 'active' : '' }}"
                    data-theme-option="light">

                    <i data-lucide="sun"></i>
                    Light

                </button>

                <button
                    type="button"
                    class="theme-switch-option {{ $currentTheme === 'dark' ? 'active' : '' }}"
                    data-theme-option="dark">

                    <i data-lucide="moon"></i>
                    Dark

                </button>

            </div>

        </div>

        <div class="preference-item">

            <div>

                <h4>Timezone</h4>

                <span>UTC +05:00</span>

            </div>

            <span class="coming-soon">
                Coming Soon
            </span>

        </div>

        <div class="preference-item">

            <div>

                <h4>Email Notifications</h4>

                <span>Match Updates</span>

            </div>

            <span class="coming-soon">
                Coming Soon
            </span>

        </div>

        <div class="preference-item">

            <div>

                <h4>Overlay Defaults</h4>

                <span>Broadcast Settings</span>

            </div>

            <span class="coming-soon">
                Coming Soon
            </span>

        </div>

    </div>

</div>