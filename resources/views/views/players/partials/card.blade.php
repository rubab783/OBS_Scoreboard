<table class="players-table">

    <thead>

        <tr>
            <th>Player</th>
            <th>Team</th>
            <th>Number</th>
            <th>Position</th>
            <th>Status</th>
            <th width="140">Actions</th>
        </tr>

    </thead>

    <tbody>

    @forelse($players as $player)

        <tr>

            {{-- Player --}}
            <td>

                <div class="player-cell">

                    @if($player->photo)
                        <img
                            src="{{ $player->photo_url }}"
                            class="player-avatar"
                            alt="{{ $player->name }}"
                        >
                    @else
                        <div class="player-avatar placeholder">
                            {{ strtoupper(substr($player->name,0,1)) }}
                        </div>
                    @endif

                    <div>

                        <div class="player-name">
                            {{ $player->name }}
                        </div>

                        <div class="player-meta">

                            @if($player->is_captain)
                                <span class="badge captain">
                                    Captain
                                </span>
                            @endif

                            @if($player->is_starter)
                                <span class="badge starter">
                                    Starter
                                </span>
                            @endif

                        </div>

                    </div>

                </div>

            </td>

            {{-- Team --}}
            <td>

                <div class="team-cell">

                    @if($player->team && $player->team->logo)
                        <img
                            src="{{ Storage::url($player->team->logo) }}"
                            class="team-logo"
                            alt="{{ $player->team->name }}"
                        >
                    @endif

                    <span>
                        {{ $player->team?->name ?? 'No Team' }}
                    </span>

                </div>

            </td>

            {{-- Jersey --}}
            <td>

                <span class="jersey-number">

                    {{ $player->jersey_number ?: '-' }}

                </span>

            </td>

            {{-- Position --}}
            <td>

                <span class="badge position {{ \Illuminate\Support\Str::slug($player->position) }}">

                    {{ $player->position ?: 'N/A' }}

                </span>

            </td>

            {{-- Status --}}
            <td>

                @if($player->is_starter)

                    <span class="status active">

                        Active

                    </span>

                @else

                    <span class="status inactive">

                        Bench

                    </span>

                @endif

            </td>

            {{-- Actions --}}
            <td>

                <div class="table-actions">

                    <a
                        href="{{ route('players.edit',$player) }}"
                        class="btn-icon edit"
                        title="Edit"
                    >
                        ✏️
                    </a>

                    <form
                        action="{{ route('players.destroy',$player) }}"
                        method="POST"
                        onsubmit="return confirm('Delete this player?')"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn-icon delete"
                            title="Delete"
                        >
                            🗑️
                        </button>

                    </form>

                </div>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="6" class="empty-state">

                <h3>No Players Found</h3>

                <p>

                    Create your first player to start building your team roster.

                </p>

                <a
                    href="{{ route('players.create') }}"
                    class="btn btn-primary"
                >
                    + Add Player
                </a>

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

<div class="pagination-wrapper">

    {{ $players->links() }}

</div>