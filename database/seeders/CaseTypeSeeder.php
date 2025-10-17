<?php

namespace Database\Seeders;

use App\Models\CaseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            '搜尋引擎優化',
            '社交媒體推廣',
            '網頁建立及設計',
        ];

        foreach ($types as $type) {
            CaseType::firstOrCreate(['name' => $type]);
        }
    }
}
