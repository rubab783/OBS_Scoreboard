@extends('layouts.app')

@section('title', 'Profile')

@section('content')

<style>
.profile-grid{
    display:grid;
    grid-template-columns:380px 1fr;
    gap:24px;
}

.profile-card{
    background:var(--card);
    border:1px solid var(--border);
    border-radius:var(--radius-lg);
    overflow:hidden;
}

.profile-cover{
    height:120px;
    background:
        radial-gradient(circle at top left, rgba(59,130,246,.35), transparent 55%),
        radial-gradient(circle at top right, rgba(236,72,153,.25), transparent 55%),
        var(--surface);
}

.profile-info{
    padding:24px;
    margin-top:-45px;
    text-align:center;
}

.profile-avatar{
    width:90px;
    height:90px;
    border-radius:50%;
    background:linear-gradient(135deg,var(--blue),var(--blue-dark));
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
    border:4px solid var(--card);
    font-size:34px;
    font-weight:700;
    color:white;
}

.profile-name{
    margin-top:14px;
    font-size:20px;
    font-weight:600;
}

.profile-email{
    color:var(--muted);
    font-size:13px;
    margin-top:4px;
}

.profile-status{
    display:inline-flex;
    align-items:center;
    gap:8px;
    margin-top:14px;
    padding:6px 12px;
    border-radius:999px;
    background:var(--green-muted);
    color:var(--green);
    border:1px solid rgba(34,197,94,.15);
    font-size:12px;
}

.profile-status::before{
    content:'';
    width:6px;
    height:6px;
    border-radius:50%;
    background:var(--green);
}

.stats{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
    margin-top:22px;
}

.stat{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:10px;
    padding:14px;
}

.stat-label{
    color:var(--muted);
    font-size:11px;
    text-transform:uppercase;
    letter-spacing:.08em;
}

.stat-value{
    margin-top:6px;
    font-size:18px;
    font-weight:600;
}

.settings-card{
    background:var(--card);
    border:1px solid var(--border);
    border-radius:var(--radius-lg);
}

.settings-header{
    padding:22px 24px;
    border-bottom:1px solid var(--border);
}

.settings-title{
    font-size:18px;
    font-weight:600;
}

.settings-sub{
    color:var(--muted);
    margin-top:4px;
    font-size:13px;
}

.settings-body{
    padding:24px;
}

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px;
}

.form-group{
    display:flex;
    flex-direction:column;
    gap:8px;
}

.form-group.full{
    grid-column:1 / -1;
}

.form-label{
    font-size:13px;
    color:var(--muted);
}

.form-input{
    width:100%;
    height:44px;
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:10px;
    color:var(--text);
    padding:0 14px;
    outline:none;
}

.form-input:focus{
    border-color:var(--blue);
}

.action-bar{
    margin-top:24px;
    display:flex;
    justify-content:flex-end;
    gap:12px;
}

.btn{
    height:42px;
    padding:0 18px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
}

.btn-secondary{
    background:var(--surface);
    color:var(--text);
    border:1px solid var(--border);
}

.btn-primary{
    background:var(--blue);
    color:white;
}

.btn-primary:hover{
    background:var(--blue-dark);
}

@media(max-width:900px){
    .profile-grid{
        grid-template-columns:1fr;
    }

    .form-grid{
        grid-template-columns:1fr;
    }
}
</style>

<div class="profile-grid">

    <!-- LEFT -->

    <div class="profile-card">

        <div class="profile-cover"></div>

        <div class="profile-info">

            <div class="profile-avatar">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>

            <div class="profile-name">
                {{ auth()->user()->name }}
            </div>

            <div class="profile-email">
                {{ auth()->user()->email }}
            </div>

            <div class="profile-status">
                Active Account
            </div>

            <div class="stats">

                <div class="stat">
                    <div class="stat-label">Role</div>
                    <div class="stat-value">Admin</div>
                </div>

                <div class="stat">
                    <div class="stat-label">Status</div>
                    <div class="stat-value">Online</div>
                </div>

                <div class="stat">
                    <div class="stat-label">Teams</div>
                    <div class="stat-value">12</div>
                </div>

                <div class="stat">
                    <div class="stat-label">Broadcasts</div>
                    <div class="stat-value">48</div>
                </div>

            </div>

        </div>

    </div>

    <!-- RIGHT -->

    <div class="settings-card">

        <div class="settings-header">
            <div class="settings-title">Account Settings</div>
            <div class="settings-sub">
                Manage your ScoreCastPro account information.
            </div>
        </div>

        <div class="settings-body">

            <form>

                <div class="form-grid">

                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input
                            type="text"
                            class="form-input"
                            value="{{ auth()->user()->name }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input
                            type="email"
                            class="form-input"
                            value="{{ auth()->user()->email }}">
                    </div>

                    <div class="form-group full">
                        <label class="form-label">New Password</label>
                        <input
                            type="password"
                            class="form-input"
                            placeholder="••••••••">
                    </div>

                </div>

                <div class="action-bar">

                    <button type="button" class="btn btn-secondary">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection