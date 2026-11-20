<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Rangkuman', 'Soal Ujian', 'Modul'] as $nama) {
            Category::firstOrCreate(['name' => $nama]);
        }
    }
}
