<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseShowcase extends Model
{
    protected $fillable = ['title', 'content_components'];

    protected $casts = [
        'content_components' => 'array',
    ];
}
