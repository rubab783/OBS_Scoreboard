<div class="glass-panel profile-card">

    <div class="card-header">

        <div>

            <h3>Security</h3>

            <p>
                Change your account password.
            </p>

        </div>

    </div>

    <form method="POST"
          action="{{ route('profile.password') }}">

        @csrf
        @method('PUT')

        <div class="form-group">

            <label for="current_password">
                Current Password
            </label>

            <input
                id="current_password"
                type="password"
                name="current_password"
                autocomplete="current-password"
                required>

            @error('current_password')
                <span class="form-error">
                    {{ $message }}
                </span>
            @enderror

        </div>

        <div class="form-group">

            <label for="password">
                New Password
            </label>

            <input
                id="password"
                type="password"
                name="password"
                autocomplete="new-password"
                required>

            @error('password')
                <span class="form-error">
                    {{ $message }}
                </span>
            @enderror

        </div>

        <div class="form-group">

            <label for="password_confirmation">
                Confirm Password
            </label>

            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                autocomplete="new-password"
                required>

        </div>

        <div class="profile-actions">

            <button
                type="submit"
                class="btn-primary">

                Update Password

            </button>

        </div>

    </form>

</div>