<div class="team-grid">

    {{-- ================= TEAM A ================= --}}
    <div class="team-card team-a">

        <div class="team-card-header">

            <div class="team-title">

                <div class="team-icon">
                    <i data-lucide="shield"></i>
                </div>

                <div>

                    <h3>Home Team</h3>

                    <span>Left side overlay</span>

                </div>

            </div>

            <span class="team-badge">
                HOME
            </span>

        </div>

        <label class="logo-upload">

            <input
                type="file"
                name="team_a_logo"
                accept="image/*"
                hidden>

            <div class="upload-box">

                <i data-lucide="image-plus"></i>

                <strong>Upload Logo</strong>

                <span>PNG, JPG, SVG</span>

            </div>

        </label>

        <div class="form-group">

            <label>Team Name</label>

            <input
                type="text"
                name="team_a"
                placeholder="Red Dragons"
                required>

        </div>

        <div class="form-group">

            <label>Primary Color</label>

            <div class="color-input">

                <input
                    class="color-picker"
                    type="color"
                    name="color_a"
                    value="#4F6FFF">

                <span>#4F6FFF</span>

            </div>

        </div>

    </div>

    {{-- ================= TEAM B ================= --}}
    <div class="team-card team-b">

        <div class="team-card-header">

            <div class="team-title">

                <div class="team-icon">

                    <i data-lucide="shield"></i>

                </div>

                <div>

                    <h3>Away Team</h3>

                    <span>Right side overlay</span>

                </div>

            </div>

            <span class="team-badge away">

                AWAY

            </span>

        </div>

        <label class="logo-upload">

            <input
                type="file"
                name="team_b_logo"
                accept="image/*"
                hidden>

            <div class="upload-box">

                <i data-lucide="image-plus"></i>

                <strong>Upload Logo</strong>

                <span>PNG, JPG, SVG</span>

            </div>

        </label>

        <div class="form-group">

            <label>Team Name</label>

            <input
                type="text"
                name="team_b"
                placeholder="Blue Knights"
                required>

        </div>

        <div class="form-group">

            <label>Primary Color</label>

            <div class="color-input">

                <input
                    class="color-picker"
                    type="color"
                    name="color_b"
                    value="#FF4D7A">

                <span>#FF4D7A</span>

            </div>

        </div>

    </div>

</div>