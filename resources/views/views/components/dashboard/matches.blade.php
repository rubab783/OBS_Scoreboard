<div
    class="event-card"
    data-status="{{ strtolower($match->status) }}"
    data-sport="{{ strtolower($match->sport ?? '') }}"
    data-name="{{ strtolower($match->team_a_display_name . ' ' . $match->team_b_display_name) }}"
    data-created="{{ optional($match->created_at)->timestamp ?? 0 }}"
    data-search="{{ strtolower($match->team_a_display_name.' '.$match->team_b_display_name.' '.($match->sport ?? '').' '.($match->league ?? '').' '.($match->venue ?? '')) }}"
>

    {{-- Header --}}
    <div class="event-header">

        <div class="event-status status-{{ strtolower($match->status) }}">

            @if($match->status === 'live')
                <span class="live-dot"></span>
            @endif

            {{ ucfirst($match->status) }}

        </div>

        <div class="event-sport">

            <i data-lucide="trophy"></i>

            {{ $match->sport ?? 'Sport' }}

        </div>

    </div>


    {{-- Teams --}}
    <div class="event-body">

        {{-- Team A --}}
        <div class="team">

            <div class="team-logo"
                 style="border-color: {{ $match->team_a_color ?? '#4F46E5' }}">

                @if($match->team_a_logo_url)

                    <img
                        src="{{ $match->team_a_logo_url }}"
                        alt="{{ $match->team_a_display_name }}">

                @else

                    <span>
                        {{ strtoupper(substr($match->team_a_display_name ?? 'A',0,1)) }}
                    </span>

                @endif

            </div>

            <div>

                <h3>

                    {{ $match->team_a_display_name }}

                </h3>

                <small>

                    Home Team

                </small>

            </div>

        </div>


        {{-- Score --}}
        <div class="versus">

            @if($match->status=='scheduled')

                <div class="vs-text">

                    VS

                </div>

            @else

                <div class="score">

                    {{ $match->score_a }}

                    <span>:</span>

                    {{ $match->score_b }}

                </div>

            @endif

            <small>

                {{ strtoupper($match->status) }}

            </small>

        </div>


        {{-- Team B --}}
        <div class="team team-right">

            <div>

                <h3>

                    {{ $match->team_b_display_name }}

                </h3>

                <small>

                    Away Team

                </small>

            </div>

            <div class="team-logo"
                 style="border-color: {{ $match->team_b_color ?? '#EC4899' }}">

                @if($match->team_b_logo_url)

                    <img
                        src="{{ $match->team_b_logo_url }}"
                        alt="{{ $match->team_b_display_name }}">

                @else

                    <span>

                        {{ strtoupper(substr($match->team_b_display_name ?? 'B',0,1)) }}

                    </span>

                @endif

            </div>

        </div>

    </div>


    {{-- Match Information --}}
    @if($match->league || $match->stage || $match->venue)
        <div class="event-meta">

            @if($match->league)

                <span>

                    <i data-lucide="flag"></i>

                    {{ $match->league }}

                </span>

            @endif

            @if($match->stage)

                <span>

                    <i data-lucide="layers"></i>

                    {{ $match->stage }}

                </span>

            @endif

            @if($match->venue)

                <span>

                    <i data-lucide="map-pin"></i>

                    {{ $match->venue }}

                </span>

            @endif

        </div>
    @endif


    {{-- Footer --}}
    <div class="event-footer">

        <div class="event-date">

            @if($match->match_date)

                <span>

                    <i data-lucide="calendar"></i>

                    {{ \Carbon\Carbon::parse($match->match_date)->format('d M Y') }}

                </span>

            @endif

            @if($match->match_time)

                <span>

                    <i data-lucide="clock-3"></i>

                    {{ \Carbon\Carbon::parse($match->match_time)->format('g:i A') }}

                </span>

            @endif

        </div>

        <div class="event-actions">

            <a
                href="{{ route('matches.control',$match) }}"
                class="btn-control">

                <i data-lucide="sliders-horizontal"></i>

                Control

            </a>

            <a
                href="{{ route('overlay.edit',$match) }}"
                class="btn-overlay">

                Overlay

            </a>

            <a
                href="{{ route('matches.edit',$match) }}"
                class="icon-action"
                aria-label="Edit match">

                <i data-lucide="square-pen"></i>

            </a>

            <form
                action="{{ route('matches.destroy',$match) }}"
                method="POST"
                onsubmit="return confirm('Delete this event? This cannot be undone.');">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="icon-action danger"
                    aria-label="Delete match">

                    <i data-lucide="trash-2"></i>

                </button>

            </form>

        </div>

    </div>

</div>
