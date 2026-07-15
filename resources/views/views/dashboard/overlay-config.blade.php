@extends('layouts.app')

@section('title', 'Overlay Config')

@section('content')

<div class="overlay-page">

    <div class="overlay-header">
        <span class="overlay-kicker">Broadcast Graphics</span>

        <h1 class="overlay-title">
            Overlay Configuration
        </h1>

        <p class="overlay-subtitle">
            Customize colors, branding, scoreboards and production graphics.
        </p>
    </div>

    <div class="overlay-grid">

        <!-- Settings -->
        <div class="overlay-settings">

            <div class="overlay-card">
                <h3>Theme Colors</h3>

                <div class="setting-row">
                    <div>
                        <strong>Primary Background</strong>
                        <small>Used for neutral panels</small>
                    </div>

                    <input type="color" value="#ff3838">
                </div>

                <div class="setting-row">
                    <div>
                        <strong>Accent Highlight</strong>
                        <small>Used for timer & badges</small>
                    </div>

                    <input type="color" value="#000000">
                </div>

                <div class="setting-row">
                    <div>
                        <strong>Team A Color</strong>
                    </div>

                    <input type="color" value="#2563eb">
                </div>

                <div class="setting-row">
                    <div>
                        <strong>Team B Color</strong>
                    </div>

                    <input type="color" value="#d946ef">
                </div>

                <button class="save-theme-btn">
                    Save Theme
                </button>
            </div>

        </div>

        <!-- Preview -->
        <div class="overlay-preview-card">

            <div class="preview-canvas">

                <div class="glow-blue"></div>
                <div class="glow-pink"></div>

                <div class="preview-panel">

                    <div class="preview-item">
                        <div>
                            <strong>Primary Background</strong>
                            <span>Used for neutral panels</span>
                        </div>

                        <div class="color-box red"></div>
                    </div>

                    <div class="preview-item">
                        <div>
                            <strong>Accent Highlight</strong>
                            <span>Used for timer & badges</span>
                        </div>

                        <div class="color-box black"></div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@push('styles')
<style>

.overlay-page{
    position:relative;
}

.overlay-header{
    margin-bottom:30px;
}

.overlay-kicker{
    color:var(--blue);
    font-size:12px;
    letter-spacing:.15em;
    text-transform:uppercase;
}

.overlay-title{
    font-size:34px;
    font-weight:700;
    margin-top:8px;
}

.overlay-subtitle{
    color:var(--muted);
    margin-top:10px;
}

.overlay-grid{
    display:grid;
    grid-template-columns:400px 1fr;
    gap:24px;
}

.overlay-card{
    background:var(--card);
    border:1px solid var(--border-hi);
    border-radius:20px;
    padding:24px;
}

.overlay-card h3{
    margin-bottom:24px;
}

.setting-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 0;
    border-bottom:1px solid rgba(255,255,255,.06);
}

.setting-row strong{
    display:block;
    font-size:14px;
}

.setting-row small{
    color:var(--muted);
}

.setting-row input[type=color]{
    width:50px;
    height:50px;
    border:none;
    background:none;
    cursor:pointer;
}

.save-theme-btn{
    width:100%;
    margin-top:24px;
    height:48px;
    border:none;
    border-radius:12px;
    background:linear-gradient(135deg,var(--blue),var(--blue-dark));
    color:white;
    cursor:pointer;
    font-weight:600;
}

.overlay-preview-card{
    background:var(--card);
    border:1px solid var(--border-hi);
    border-radius:20px;
    padding:20px;
}

.preview-canvas{
    position:relative;
    height:700px;
    background:#000;
    border-radius:18px;
    overflow:hidden;
}

.glow-blue{
    position:absolute;
    top:-250px;
    left:-250px;
    width:700px;
    height:700px;
    border-radius:80px;
    background:radial-gradient(circle,
        rgba(59,130,246,.95),
        transparent 70%);
    filter:blur(30px);
}

.glow-pink{
    position:absolute;
    right:-250px;
    bottom:-250px;
    width:700px;
    height:700px;
    border-radius:80px;
    background:radial-gradient(circle,
        rgba(217,70,239,.95),
        transparent 70%);
    filter:blur(30px);
}

.preview-panel{
    position:absolute;
    bottom:60px;
    right:60px;
    width:320px;
    background:#ececec;
    color:#111827;
    border-radius:14px;
    overflow:hidden;
}

.preview-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:16px;
}

.preview-item:first-child{
    border-bottom:1px solid #d9d9d9;
}

.preview-item span{
    display:block;
    color:#6b7280;
    font-size:12px;
    margin-top:4px;
}

.color-box{
    width:24px;
    height:24px;
}

.color-box.red{
    background:#ff3838;
}

.color-box.black{
    background:#000;
}

@media(max-width:1100px){

    .overlay-grid{
        grid-template-columns:1fr;
    }

    .preview-canvas{
        height:500px;
    }
}

</style>
@endpush