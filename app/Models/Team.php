<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
        use HasFactory;
 public function players()
{
    return $this->hasMany(Player::class);
}
    protected $fillable = [

        'name',

        'short_name',

        'logo',

        'primary_color',

        'secondary_color',

        'description',

        'is_active',
    ];

    protected $casts = [

        'is_active' => 'boolean',
    ];
    public function getLogoUrlAttribute(): ?string
{
    return $this->logo
        ? Storage::url($this->logo)
        : null;
}
}