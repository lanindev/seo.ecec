<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaseModel extends Model
{
    protected $table = 'cases';

    protected $fillable = [
        'title',
        'case_type_id',
        'cover',
        'content_components',
    ];

    protected $casts = [
        'content_components' => 'array',
    ];

    public function caseType(): BelongsTo
    {
        return $this->belongsTo(CaseType::class, 'case_type_id');
    }
}
