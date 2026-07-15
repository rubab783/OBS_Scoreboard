<div class="control-panel-header">

    <div>

        <a href="{{ route('dashboard') }}" class="control-panel-back">
            <i data-lucide="arrow-left"></i>
            Back to Dashboard
        </a>

        <h1 class="page-title">
            {{ $match->name ?? 'Match Control Panel' }}
        </h1>

        <p class="page-subtitle">
            {{ $match->sport ?? 'Match' }} &middot; Drive live score, clock and broadcast overlay in real time.
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