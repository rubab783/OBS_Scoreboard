<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class OverlayTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category',
        'sport',
        'thumbnail',
        'accent_color',
        'secondary_color',
        'layout_style',
        'blade_view',
        'css_file',
        'js_file',
        'config',
        'is_active',
    ];

    protected $casts = [
        'config'    => 'array',
        'is_active' => 'boolean',
    ];

    public function overlaySettings()
    {
        return $this->hasMany(OverlaySetting::class, 'template_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

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

    /**
     * Fully-qualified Blade view path used by @includeIf on the render page.
     * e.g. "overlay.templates.dark-blue"
     */
    public function getBladeViewPathAttribute(): string
    {
        return 'overlay.templates.' . $this->blade_view;
    }

    /**
     * Public URL for the thumbnail image, or null if not set
     * (falls back to a CSS-only preview in the gallery).
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? Storage::url($this->thumbnail) : null;
    }
}