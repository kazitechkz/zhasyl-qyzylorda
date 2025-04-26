<?php

namespace Database\Seeders;

use App\Models\CategoryPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryPlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryPlace::create([
            'title_ru' => 'Улицы',
            'title_kz' => 'Көшелер'
        ]);
        CategoryPlace::create([
            'title_ru' => 'Парки',
            'title_kz' => 'Саябақ'
        ]);
        CategoryPlace::create([
            'title_ru' => 'Сектор',
            'title_kz' => 'Сектор'
        ]);
    }
}
