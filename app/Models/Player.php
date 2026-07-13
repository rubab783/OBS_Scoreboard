<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'name',
        'jersey_number',
        'position',
        'is_captain',
        'is_starter',
        'photo',
    ];

    protected $casts = [
        'is_captain' => 'boolean',
        'is_starter' => 'boolean',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? Storage::url($this->photo)
            : null;
    }
}