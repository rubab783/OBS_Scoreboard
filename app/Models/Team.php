<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

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
}