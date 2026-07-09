@extends('layouts.app')

@section('title', 'New Event')

@section('content')

<style>
.event-page{
    position:relative;
    min-height:100%;
}

.event-page::before{
    content:'';
    position:fixed;
    top:-250px;
    left:-150px;
    width:700px;
    height:700px;
    border-radius:50%;
    background:radial-gradient(circle,
        rgba(59,130,246,.25) 0%,
        transparent 70%);
    pointer-events:none;
}

.event-page::after{
    content:'';
    position:fixed;
    right:-250px;
    bottom:-250px;
    width:700px;
    height:700px;
    border-radius:50%;
    background:radial-gradient(circle,
        rgba(217,70,239,.18) 0%,
        transparent 70%);
    pointer-events:none;
}

.event-header{
    margin-bottom:30px;
}

.event-kicker{
    color:var(--blue);
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:.15em;
    margin-bottom:8px;
}

.event-title{
    font-size:34px;
    font-weight:700;
    line-height:1;
    margin-bottom:10px;
}

.event-subtitle{
    color:var(--muted);
    max-width:650px;
}

.event-grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:24px;
}

.event-stack{
    display:flex;
    flex-direction:column;
    gap:24px;
}

.glass-card{
    background:rgba(19,19,28,.85);
    border:1px solid rgba(255,255,255,.08);
    backdrop-filter:blur(20px);
    border-radius:18px;
    padding:24px;
    position:relative;
    overflow:hidden;
}

.glass-card::before{
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(
        135deg,
        rgba(255,255,255,.03),
        transparent 40%
    );
    pointer-events:none;
}

.card-title{
    font-size:18px;
    font-weight:600;
    margin-bottom:20px;
}

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px;
}

.field{
    display:flex;
    flex-direction:column;
    gap:8px;
}

.field.full{
    grid-column:1/-1;
}

.field label{
    font-size:12px;
    color:var(--muted);
    text-transform:uppercase;
    letter-spacing:.08em;
}

.field input,
.field select,
.field textarea{
    background:#0f0f17;
    border:1px solid rgba(255,255,255,.08);
    color:var(--text);
    border-radius:12px;
    padding:12px 14px;
    outline:none;
    transition:.2s;
}

.field input:focus,
.field select:focus,
.field textarea:focus{
    border-color:var(--blue);
    box-shadow:0 0 0 4px rgba(59,130,246,.15);
}

.field textarea{
    resize:none;
    min-height:100px;
}

.summary-card{
    position:sticky;
    top:20px;
}

.summary-row{
    display:flex;
    justify-content:space-between;
    padding:12px 0;
    border-bottom:1px solid rgba(255,255,255,.06);
}

.summary-row:last-child{
    border-bottom:none;
}

.summary-label{
    color:var(--muted);
    font-size:13px;
}

.summary-value{
    font-weight:600;
}

.status-pill{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:8px 14px;
    border-radius:999px;
    background:rgba(245,158,11,.12);
    border:1px solid rgba(245,158,11,.2);
    color:#fbbf24;
    font-size:12px;
    font-weight:600;
}

.action-row{
    margin-top:20px;
    display:flex;
    gap:12px;
}

.btn{
    border:none;
    cursor:pointer;
    padding:12px 18px;
    border-radius:12px;
    font-weight:600;
}

.btn-secondary{
    background:#1a1a25;
    color:var(--text);
}

.btn-primary{
    background:linear-gradient(
        135deg,
        #3b82f6,
        #2563eb
    );
    color:white;
}

@media(max-width:1100px){

    .event-grid{
        grid-template-columns:1fr;
    }

    .summary-card{
        position:relative;
        top:auto;
    }

    .form-grid{
        grid-template-columns:1fr;
    }
}
</style>

<div class="event-page">

    <div class="event-header">
        <div class="event-kicker">
            Broadcast Production
        </div>

        <h1 class="event-title">
            Create Match Event
        </h1>

        <p class="event-subtitle">
            Configure teams, schedule, stream settings and overlay information
            for a live broadcast production.
        </p>
    </div>

    <div class="event-grid">

        <div class="event-stack">

            <!-- Match Information -->
            <div class="glass-card">
                <h2 class="card-title">Match Information</h2>

                <div class="form-grid">

                    <div class="field">
                        <label>Match Title</label>
                        <input type="text" placeholder="Pakistan vs India">
                    </div>

                    <div class="field">
                        <label>Tournament</label>
                        <input type="text" placeholder="Asia Cup 2026">
                    </div>

                    <div class="field">
                        <label>Date</label>
                        <input type="date">
                    </div>

                    <div class="field">
                        <label>Time</label>
                        <input type="time">
                    </div>

                    <div class="field">
                        <label>Format</label>
                        <select>
                            <option>BO1</option>
                            <option>BO3</option>
                            <option>BO5</option>
                            <option>BO7</option>
                        </select>
                    </div>

                    <div class="field">
                        <label>Status</label>
                        <select>
                            <option>Draft</option>
                            <option>Scheduled</option>
                            <option>Live</option>
                        </select>
                    </div>

                </div>
            </div>

            <!-- Teams -->
            <div class="glass-card">
                <h2 class="card-title">Teams</h2>

                <div class="form-grid">

                    <div class="field">
                        <label>Team A</label>
                        <select>
                            <option>Select Team</option>
                        </select>
                    </div>

                    <div class="field">
                        <label>Team B</label>
                        <select>
                            <option>Select Team</option>
                        </select>
                    </div>

                </div>
            </div>

            <!-- Broadcast -->
            <div class="glass-card">
                <h2 class="card-title">Broadcast Settings</h2>

                <div class="form-grid">

                    <div class="field">
                        <label>Stream Platform</label>
                        <select>
                            <option>YouTube</option>
                            <option>Twitch</option>
                            <option>Facebook Live</option>
                        </select>
                    </div>

                    <div class="field">
                        <label>Overlay Theme</label>
                        <select>
                            <option>Default Blue</option>
                            <option>Championship</option>
                            <option>Minimal</option>
                        </select>
                    </div>

                    <div class="field full">
                        <label>Production Notes</label>
                        <textarea placeholder="Observer notes, caster notes, stream instructions..."></textarea>
                    </div>

                </div>
            </div>

        </div>

        <!-- Sidebar Summary -->
        <div>

            <div class="glass-card summary-card">

                <h2 class="card-title">
                    Match Summary
                </h2>

                <div class="status-pill">
                    ● Draft Event
                </div>

                <div style="margin-top:20px">

                    <div class="summary-row">
                        <span class="summary-label">Production</span>
                        <span class="summary-value">Ready</span>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">Teams</span>
                        <span class="summary-value">2 Required</span>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">Overlay</span>
                        <span class="summary-value">Default</span>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">Stream</span>
                        <span class="summary-value">YouTube</span>
                    </div>

                </div>

                <div class="action-row">
                    <button class="btn btn-secondary">
                        Save Draft
                    </button>

                    <button class="btn btn-primary">
                        Create Event
                    </button>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection