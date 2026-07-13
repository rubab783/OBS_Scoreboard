@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

@if($teams->count())

<div class="table-responsive">

    <table class="data-table">

        <thead>

            <tr>

                <th>Logo</th>
                <th>Team</th>
                <th>Short</th>
                <th>Players</th>
                <th>Primary</th>
                <th>Status</th>
                <th>Created</th>
                <th class="text-end">Actions</th>

            </tr>

        </thead>

        <tbody>

            @foreach($teams as $team)

            <tr>

                <td width="70">

                    @if($team->logo)

                        <img
                            src="{{ asset('storage/'.$team->logo) }}"
                            class="team-logo"
                            alt="{{ $team->name }}"
                        >

                    @else

                        <div class="team-logo-placeholder">
                            {{ strtoupper(substr($team->short_name,0,2)) }}
                        </div>

                    @endif

                </td>

                <td>

                    <strong>{{ $team->name }}</strong>

                    @if($team->description)
                        <div class="table-subtitle">
                            {{ Str::limit($team->description,50) }}
                        </div>
                    @endif

                </td>

                <td>

                    <span class="badge badge-light">

                        {{ $team->short_name }}

                    </span>

                </td>

                <td>

                    {{ $team->players_count }}

                </td>

                <td>

                    <div class="color-chip">

                        <span
                            class="color-dot"
                            style="background:{{ $team->primary_color }}"
                        ></span>

                        {{ $team->primary_color }}

                    </div>

                </td>

                <td>

                    @if($team->is_active)

                        <span class="badge badge-success">
                            Active
                        </span>

                    @else

                        <span class="badge badge-danger">
                            Inactive
                        </span>

                    @endif

                </td>

                <td>

                    {{ $team->created_at->format('d M Y') }}

                </td>

                <td class="text-end">

                    <a
                        href="{{ route('teams.edit',$team) }}"
                        class="btn-sm btn-outline"
                    >
                        Edit
                    </a>

                    <form
                        action="{{ route('teams.destroy',$team) }}"
                        method="POST"
                        style="display:inline-block"
                        onsubmit="return confirm('Delete this team?')"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn-sm btn-danger"
                            type="submit"
                        >
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

<div class="pagination-wrap">

    {{ $teams->links() }}

</div>

@else

<div class="empty-state">

    <h3>No teams found</h3>

    <p>Create your first team to begin managing players.</p>

    <a
        href="{{ route('teams.create') }}"
        class="btn-primary"
    >
        + Create Team
    </a>

</div>

@endif