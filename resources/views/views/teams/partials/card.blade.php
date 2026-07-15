@if($teams->count())

<div class="team-grid">

@foreach($teams as $team)

<div class="team-card">

    <div class="team-card-header">

        <div class="team-logo">

            @if($team->logo)

                <img
                    src="{{ asset('storage/'.$team->logo) }}"
                    alt="{{ $team->name }}"
                >

            @else

                <div class="team-logo-placeholder">

                    {{ strtoupper(substr($team->short_name,0,2)) }}

                </div>

            @endif

        </div>

        <div>

            <h3>{{ $team->name }}</h3>

            <p>{{ $team->short_name }}</p>

        </div>

    </div>

    <div class="team-info">

        <div>

            <span>Players</span>

            <strong>{{ $team->players_count }}</strong>

        </div>

        <div>

            <span>Status</span>

            @if($team->is_active)

                <span class="badge success">
                    Active
                </span>

            @else

                <span class="badge secondary">
                    Inactive
                </span>

            @endif

        </div>

    </div>

    <div class="team-colors">

        <div>

            <small>Primary</small>

            <span
                class="color-box"
                style="background:{{ $team->primary_color }}"
            ></span>

        </div>

        <div>

            <small>Secondary</small>

            <span
                class="color-box"
                style="background:{{ $team->secondary_color ?? '#64748b' }}"
            ></span>

        </div>

    </div>

    @if($team->description)

    <p class="team-description">

        {{ Str::limit($team->description,80) }}

    </p>

    @endif

    <div class="team-actions">

        <a
            href="{{ route('teams.edit',$team) }}"
            class="btn btn-outline"
        >
            Edit
        </a>

        <form
            action="{{ route('teams.destroy',$team) }}"
            method="POST"
            onsubmit="return confirm('Delete this team?')"
        >

            @csrf
            @method('DELETE')

            <button class="btn btn-danger">

                Delete

            </button>

        </form>

    </div>

</div>

@endforeach

</div>

<div class="pagination-wrapper">

{{ $teams->links() }}

</div>

@else

<div class="empty-state">

    <div class="empty-icon">

        🏆

    </div>

    <h3>No Teams Found</h3>

    <p>

        Start by creating your first team.

    </p>

    <a
        href="{{ route('teams.create') }}"
        class="btn btn-primary"
    >

        Create Team

    </a>

</div>

@endif