<div class="duration-card">

    <div class="duration-icon">
        <i data-lucide="clock-3"></i>
    </div>

    <div class="duration-content">

        <h4>Match Duration</h4>

        <p>
            Default timer length before kickoff.
        </p>

    </div>

    <div class="duration-input">

        <input
            type="number"
            name="duration"
            value="{{ old('duration',45) }}"
            min="1">

        <span>MIN</span>

    </div>

</div>