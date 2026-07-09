<div class="event-card">

    <div class="card-title">

        <div class="card-icon">
            <i data-lucide="settings-2"></i>
        </div>

        <div>

            <h3>Match Settings</h3>

            <span>Configure timer and initial match state</span>

        </div>

    </div>

    <div class="event-grid">

        <div class="form-group">

            <label>Match Duration</label>

            <div class="input-with-icon">

                <i data-lucide="clock-3"></i>

                <input
                    type="number"
                    name="duration"
                    value="45"
                    min="1"
                    required>

            </div>

        </div>

        <div class="form-group">

            <label>Default Status</label>

            <select name="status">

                <option value="scheduled" selected>
                    Scheduled
                </option>

                <option value="live">
                    Live
                </option>

                <option value="paused">
                    Paused
                </option>

            </select>

        </div>

        <div class="form-group">

            <label>Period</label>

            <select name="period">

                <option selected>
                    1st Half
                </option>

                <option>
                    2nd Half
                </option>

                <option>
                    Extra Time
                </option>

                <option>
                    Penalties
                </option>

            </select>

        </div>

        <div class="form-group">

            <label>Initial Score</label>

            <div class="score-default">

                <span>0</span>

                <i data-lucide="minus"></i>

                <span>0</span>

            </div>

        </div>

    </div>

</div>