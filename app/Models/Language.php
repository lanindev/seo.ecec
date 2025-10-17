<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['code', 'name', 'is_active'];

    public static function active(): \Illuminate\Support\Collection
    {
        return self::where('is_active', true)->get();
    }
}
