@extends('layouts.app')
@section('title', 'Teams')

@push('styles')
<style>
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .anim   { animation: slideUp 0.4s ease both; }
    .anim-d1 { animation-delay: 0.04s; }
    .anim-d2 { animation-delay: 0.08s; }
    .anim-d3 { animation-delay: 0.12s; }
    .anim-d4 { animation-delay: 0.16s; }

    /* ── Page Header ── */
    .page-header {
        display: flex; align-items: flex-start;
        justify-content: space-between;
        gap: 16px; margin-bottom: 24px; flex-wrap: wrap;
    }
    .page-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 38px; font-weight: 700;
        line-height: 0.95; letter-spacing: 0.01em;
        color: var(--text); margin-bottom: 7px;
    }
    .page-sub {
        font-size: 13px; font-weight: 300;
        color: var(--muted); line-height: 1.5;
    }

    /* ── Search Bar ── */
    .search-panel {
        background: var(--card);
        border: 1px solid var(--border-hi);
        border-radius: var(--radius-lg);
        padding: 16px 18px;
        margin-bottom: 14px;
        display: flex; align-items: center; gap: 10px;
    }
    .search-wrap { position: relative; flex: 1; }
    .search-wrap svg {
        position: absolute; left: 11px; top: 50%;
        transform: translateY(-50%);
        color: var(--dimmed); pointer-events: none;
    }
    .search-input {
        width: 100%;
        background: var(--surface, #0f0f17);
        border: 1px solid var(--border-hi);
        border-radius: var(--radius);
        padding: 9px 13px 9px 34px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px; color: var(--text);
        outline: none;
        transition: border-color 0.15s, background 0.15s, box-shadow 0.15s;
    }
    .search-input::placeholder { color: var(--dimmed); }
    .search-input:focus {
        border-color: rgba(59,130,246,0.45);
        background: rgba(59,130,246,0.04);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.08);
    }

    /* ── Teams Table ── */
    .teams-panel {
        background: var(--card);
        border: 1px solid var(--border-hi);
        border-radius: var(--radius-lg);
        overflow: hidden;
    }
    .panel-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 14px 20px;
        border-bottom: 1px solid var(--border);
    }
    .panel-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 16px; font-weight: 700;
        letter-spacing: 0.04em; color: var(--text);
        display: flex; align-items: center; gap: 8px;
    }
    .section-count {
        font-size: 11px; font-weight: 600;
        padding: 2px 8px; border-radius: 999px;
        background: var(--blue-muted); color: var(--blue);
        border: 1px solid rgba(59,130,246,0.2);
        font-family: 'DM Sans', sans-serif;
    }

    .teams-table { width: 100%; border-collapse: collapse; }
    .teams-table thead {
        background: rgba(0,0,0,0.2);
    }
    .teams-table th {
        padding: 10px 20px;
        text-align: left;
        font-size: 10px; font-weight: 600;
        letter-spacing: 0.1em; text-transform: uppercase;
        color: var(--dimmed);
        border-bottom: 1px solid var(--border);
    }
    .teams-table th:last-child { text-align: right; }
    .teams-table td {
        padding: 14px 20px;
        border-bottom: 1px solid var(--border);
        font-size: 13.5px; color: var(--muted);
        vertical-align: middle;
    }
    .teams-table tbody tr:last-child td { border-bottom: none; }
    .teams-table tbody tr {
        transition: background 0.15s;
    }
    .teams-table tbody tr:hover { background: rgba(255,255,255,0.025); }

    /* Team identity cell */
    .team-identity { display: flex; align-items: center; gap: 13px; }
    .team-avatar {
        width: 44px; height: 44px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 18px; font-weight: 700;
        color: #fff; flex-shrink: 0;
        overflow: hidden;
    }
    .team-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .team-name {
        font-size: 14px; font-weight: 500;
        color: var(--text); margin-bottom: 2px;
    }
    .team-desc {
        font-size: 12px; color: var(--dimmed);
        max-width: 280px;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }

    /* Short name pill */
    .short-name-pill {
        display: inline-block;
        font-size: 11px; font-weight: 600;
        letter-spacing: 0.08em;
        padding: 3px 10px; border-radius: 6px;
        background: rgba(255,255,255,0.06);
        border: 1px solid var(--border-hi);
        color: var(--muted);
        font-family: 'Barlow Condensed', sans-serif;
    }

    /* Color dot */
    .color-dot {
        display: inline-flex; align-items: center; gap: 7px;
        font-size: 12px; color: var(--dimmed);
    }
    .color-dot-swatch {
        width: 10px; height: 10px; border-radius: 3px;
        flex-shrink: 0;
        border: 1px solid rgba(255,255,255,0.12);
    }

    /* Status badge */
    .badge {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 10px; font-weight: 600;
        letter-spacing: 0.1em; text-transform: uppercase;
        padding: 3px 10px; border-radius: 999px;
    }
    .badge.active {
        background: rgba(34,197,94,0.10);
        border: 1px solid rgba(34,197,94,0.2);
        color: var(--green);
    }
    .badge.inactive {
        background: rgba(255,255,255,0.04);
        border: 1px solid var(--border-hi);
        color: var(--dimmed);
    }
    .badge-dot {
        width: 5px; height: 5px;
        border-radius: 50%; background: currentColor;
    }

    /* Actions */
    .actions-cell { display: flex; justify-content: flex-end; gap: 7px; }
    .action-btn {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 7px 13px;
        font-family: 'DM Sans', sans-serif;
        font-size: 12px; font-weight: 500;
        border-radius: var(--radius);
        border: none; cursor: pointer;
        text-decoration: none;
        transition: background 0.15s, transform 0.1s;
        white-space: nowrap;
    }
    .action-btn:active { transform: scale(0.97); }
    .action-btn.edit {
        background: var(--blue-muted);
        border: 1px solid rgba(59,130,246,0.2);
        color: var(--blue);
    }
    .action-btn.edit:hover { background: rgba(59,130,246,0.2); }
    .action-btn.delete {
        background: transparent;
        border: 1px solid var(--border-hi);
        color: var(--dimmed);
    }
    .action-btn.delete:hover {
        background: var(--red-muted);
        border-color: rgba(239,68,68,0.3);
        color: var(--red);
    }

    /* Empty state */
    .empty-state {
        padding: 60px 24px; text-align: center;
    }
    .empty-icon {
        width: 52px; height: 52px;
        background: var(--card-hi);
        border: 1px solid var(--border-hi);
        border-radius: var(--radius-lg);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 16px; color: var(--dimmed);
    }
    .empty-title {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 20px; font-weight: 700;
        color: var(--text); margin-bottom: 6px;
    }
    .empty-sub { font-size: 13px; color: var(--muted); margin-bottom: 20px; }

    /* Pagination */
    .pagination-wrap {
        padding: 14px 20px;
        border-top: 1px solid var(--border);
        display: flex; align-items: center; justify-content: flex-end;
    }
    .pagination-wrap .pagination { display: flex; gap: 4px; }
    .pagination-wrap span, .pagination-wrap a {
        display: inline-flex; align-items: center; justify-content: center;
        min-width: 30px; height: 30px; padding: 0 8px;
        border-radius: var(--radius);
        font-size: 12.5px; font-weight: 500;
        text-decoration: none;
        border: 1px solid var(--border-hi);
        color: var(--muted);
        background: transparent;
        transition: background 0.15s, color 0.15s;
    }
    .pagination-wrap a:hover { background: var(--card-hi); color: var(--text); border-color: var(--border-hover); }
    .pagination-wrap span[aria-current] {
        background: var(--blue-muted); color: var(--blue);
        border-color: rgba(59,130,246,0.25);
    }
    .pagination-wrap span.disabled { opacity: 0.3; pointer-events: none; }

    @media (max-width: 820px) {
        .teams-table .col-color,
        .teams-table .col-color-h { display: none; }
    }
    @media (max-width: 640px) {
        .page-title { font-size: 30px; }
        .teams-table .col-short,
        .teams-table .col-short-h { display: none; }
    }
</style>
@endpush

@section('content')

{{-- ── Page Header ── --}}
<div class="page-header anim anim-d1">
    <div>
        <h1 class="page-title">Teams</h1>
        <p class="page-sub">Manage esports teams, rosters &amp; branding assets</p>
    </div>
    <div style="display:flex;align-items:center;gap:10px;margin-top:4px;">
        <a href="#" class="topbar-btn primary">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Create Team
        </a>
    </div>
</div>

{{-- ── Search ── --}}
<div class="search-panel anim anim-d2">
    <div class="search-wrap">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <form method="GET" style="margin:0">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search teams by name or short name…"
                class="search-input"
                autocomplete="off"
            >
        </form>
    </div>
    @if(request('search'))
        <a href="{{ route('teams.index') }}" class="topbar-btn" style="white-space:nowrap;flex-shrink:0">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
            Clear
        </a>
    @endif
</div>

{{-- ── Teams Panel ── --}}
<div class="teams-panel anim anim-d3">

    <div class="panel-header">
        <div class="panel-title">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
            </svg>
            All Teams
            <span class="section-count"></span>
        </div>
        @if(request('search'))
            <span style="font-size:12px;color:var(--dimmed)">
                Results for "<strong style="color:var(--muted)">{{ request('search') }}</strong>"
            </span>
        @endif
    </div>

    <div style="overflow-x:auto">
        <table class="teams-table">
            <thead>
                <tr>
                    <th>Team</th>
                    <th class="col-short-h">Short</th>
                    <th class="col-color-h">Color</th>
                    <th>Status</th>
                    <th style="text-align:right">Actions</th>
                </tr>
            </thead>
            <tbody>
      
                <tr>
                    {{-- Identity --}}
                    <td>
                        <div class="team-identity">
                            <div class="team-avatar" style="background:{{ $team->primary_color ?? '#3b82f6' }}">
      
                                    <img src="" alt="">
                            </div>
                            <div>
                                <div class="team-name">Team Name</div>
      
                                    <div class="team-desc">team->description</div>
                            
                            </div>
                        </div>
                    </td>

                    {{-- Short Name --}}
                    <td class="col-short">
                        <span class="short-name-pill">team short_name</span>
                    </td>

                    {{-- Color --}}
                    <td class="col-color">
                        <div class="color-dot">
                            <span class="color-dot-swatch" style="background:{{ $team->primary_color ?? '#3b82f6' }}"></span>
                             team->primary_color ?? '#3b82f6' 
                        </div>
                    </td>

                    {{-- Status --}}
                    <td>
                       
                            <span class="badge active">
                                <span class="badge-dot"></span>
                                Active
                            </span>
                      
                            <span class="badge inactive">
                                <span class="badge-dot"></span>
                                Inactive
                            </span>
                                          </td>

                    {{-- Actions --}}
                    <td>
                        <div class="actions-cell">
                            <a href="" class="action-btn edit">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Edit
                            </a>
                            <form method="POST" action=""
            >
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn delete">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6l-1 14H6L5 6"/>
                                        <path d="M10 11v6"/><path d="M14 11v6"/>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
        
                <tr>
                    <td colspan="5" style="padding:0;border:none">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/>
                                </svg>
                            </div>
                            <div class="empty-title">
                                @if(request('search'))
                                    No teams match "{{ request('search') }}"
                                @else
                                    No teams yet
                                @endif
                            </div>
                            <p class="empty-sub">
                                @if(request('search'))
                                    Try a different search term or clear the filter.
                                @else
                                    Create your first team to get started.
                                @endif
                            </p>
                            @if(request('search'))
                                <a href="{{ route('teams.index') }}" class="topbar-btn">Clear search</a>
                            @else
                                <a href="" class="topbar-btn primary">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                                    </svg>
                                    Create First Team
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
          
            </tbody>
        </table>
    </div>

   
        <div class="pagination-wrap anim anim-d4">
                   </div>
    

</div>

@endsection
