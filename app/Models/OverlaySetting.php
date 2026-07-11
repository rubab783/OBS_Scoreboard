<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class OverlaySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'template_id',
        'theme',
        'animation_style',
        'accent_color',
        'show_logos',
        'show_timer',
        'show_score',
        'show_period',
        'show_sponsor',
        'show_ticker',
        'sponsor_logo',
        'ticker_text',
        'is_live',
    ];

    protected $casts = [
        'show_logos'   => 'boolean',
        'show_timer'   => 'boolean',
        'show_score'   => 'boolean',
        'show_period'  => 'boolean',
        'show_sponsor' => 'boolean',
        'show_ticker'  => 'boolean',
        'is_live'      => 'boolean',
    ];

    public function match()
    {
        return $this->belongsTo(GameMatch::class, 'match_id');
    }

    public function template()
    {
        return $this->belongsTo(OverlayTemplate::class, 'template_id');
    }

    public function getSponsorLogoUrlAttribute(): ?string
    {
        return $this->sponsor_logo ? Storage::url($this->sponsor_logo) : null;
    }
}