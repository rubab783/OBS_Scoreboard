<div class="glass-panel profile-card">

    <div class="card-header">

        <div>
            <h3>Personal Information</h3>
            <p>Update your account information.</p>
        </div>

    </div>

    <form method="POST" action="{{ route('profile.update') }}">

        @csrf
        @method('PATCH')

        <div class="form-group">

            <label for="name">
                Full Name
            </label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                required>

            @error('name')
                <span class="form-error">
                    {{ $message }}
                </span>
            @enderror

        </div>

        <div class="form-group">

            <label for="email">
                Email Address
            </label>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required>

            @error('email')
                <span class="form-error">
                    {{ $message }}
                </span>
            @enderror

        </div>

        <div class="form-group">

            <label>
                Role
            </label>

            <input
                type="text"
                value="Administrator"
                disabled>

        </div>

        <div class="form-group">

            <label>
                Member Since
            </label>

            <input
                type="text"
                value="{{ $user->created_at->format('d M Y') }}"
                disabled>

        </div>

        <div class="profile-actions">

            <button
                type="submit"
                class="btn-primary">

                Save Changes

            </button>

        </div>

    </form>

</div>