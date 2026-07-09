<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GameMatch extends Model
{
    use HasFactory;

    protected $table = 'matches';

    protected $fillable = [
        'user_id',
        'name',
        'sport',
        'best_of',
        'status',
        'team_a',
        'team_b',
        'team_a_id',
        'team_b_id',
        'team_a_color',
        'team_b_color',
        'score_a',
        'score_b',
        'clock_seconds',
        'timer_status',
        'clock_updated_at',
        'period',
    ];

    protected $casts = [
        'score_a'          => 'integer',
        'score_b'          => 'integer',
        'best_of'          => 'integer',
        'clock_seconds'    => 'integer',
        'clock_updated_at' => 'datetime',
    ];

    /* ── Relationships ── */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teamA()
    {
        return $this->belongsTo(Team::class, 'team_a_id');
    }

    public function teamB()
    {
        return $this->belongsTo(Team::class, 'team_b_id');
    }

    /* ── Scopes ── */

    public function scopeLive($query)
    {
        return $query->where('status', 'live');
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public function scopeEnded($query)
    {
        return $query->where('status', 'ended');
    }

    /* ── Helpers ── */

    public function getLeaderAttribute(): ?string
    {
        if ($this->score_a > $this->score_b) return 'a';
        if ($this->score_b > $this->score_a) return 'b';
        return null;
    }

    public function getTeamADisplayNameAttribute(): string
    {
        return $this->teamA?->name ?? $this->team_a ?? 'Team A';
    }

    public function getTeamBDisplayNameAttribute(): string
    {
        return $this->teamB?->name ?? $this->team_b ?? 'Team B';
    }

    public function getTeamALogoUrlAttribute(): ?string
    {
        return $this->teamA?->logo
            ? \Storage::url($this->teamA->logo)
            : null;
    }

    public function getTeamBLogoUrlAttribute(): ?string
    {
        return $this->teamB?->logo
            ? \Storage::url($this->teamB->logo)
            : null;
    }
    public function overlaySetting()
{
    return $this->hasOne(OverlaySetting::class, 'match_id');
}
}