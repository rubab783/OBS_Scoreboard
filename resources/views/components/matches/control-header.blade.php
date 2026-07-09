<div class="control-panel-header">

    <div>

        <h1 class="page-title">
            Match Control Panel
        </h1>

        <p class="page-subtitle">
            Drive live score, clock and broadcast overlay in real time.
        </p>

    </div>

    <div
        id="matchStatusBadge"
        class="match-status-badge status-{{ $match->status }}">

        <span class="status-dot"></span>

        <span id="matchStatusText">
            {{ ucfirst($match->status) }}
        </span>

    </div>

</div> 