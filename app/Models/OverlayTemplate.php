<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OverlayTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'sport',
        'accent_color',
        'secondary_color',
        'layout_style',
        'config',
        'is_active',
    ];

    protected $casts = [
        'config'    => 'array',
        'is_active' => 'boolean',
    ];

    public function overlaySettings()
    {
        return $this->hasMany(OverlaySetting::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Templates compatible with a given sport: either sport-specific
     * matches, or sport-agnostic templates (sport = null).
     */
    public function scopeForSport($query, ?string $sport)
    {
        return $query->where(function ($q) use ($sport) {
            $q->whereNull('sport');
            if ($sport) {
                $q->orWhere('sport', $sport);
            }
        });
    }

    public function scopeCategory($query, ?string $category)
    {
        return $category ? $query->where('category', $category) : $query;
    }
}