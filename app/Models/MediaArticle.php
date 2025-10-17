<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaArticle extends Model
{
    protected $fillable = [
        'title',
        'thumbnail',
        'content_components',
    ];

    protected $casts = [
        'content_components' => 'array',
    ];
}
