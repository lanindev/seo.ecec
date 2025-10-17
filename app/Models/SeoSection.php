<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSection extends Model
{
    protected $fillable = [
        'key',
        'name',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
