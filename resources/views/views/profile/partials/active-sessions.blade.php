<div class="glass-panel profile-card">

    <div class="card-header">

        <div>

            <h3>Active Session</h3>

            <p>
                You're currently signed in on this device.
            </p>

        </div>

    </div>

    <div class="session-card">

        <div class="session-icon">

            💻

        </div>

        <div class="session-details">

            <h4>Current Device</h4>

            <p>
                Windows • Chrome
            </p>

            <span class="session-status">

                ● Active Now

            </span>

        </div>

    </div>

    <form method="POST"
          action="{{ route('profile.logout-devices') }}">

        @csrf

        <div class="form-group">

            <label>
                Confirm Password
            </label>

            <input
                type="password"
                name="password"
                required
                placeholder="Enter your password">

        </div>

        <button
            class="btn-secondary"
            type="submit">

            Logout Other Devices

        </button>

    </form>

</div>