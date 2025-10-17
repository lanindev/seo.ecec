<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = [
        'page_id',
        'language_id',
        'content_components',
    ];

    protected $casts = [
        'content_components' => 'array',
    ];
    
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function scopeFirstPerPage(Builder $query): Builder
    {
        $ids = self::selectRaw('MIN(id) as id')
            ->groupBy('page_id')
            ->pluck('id');

        return $query->whereIn('id', $ids);
    }
}
