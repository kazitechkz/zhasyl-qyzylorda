<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
           'title_ru' => 'Насаждения общего пользования',
           'title_kz' => 'Жалпы пайдаланымдағы екпелер'
        ]);
        Category::create([
           'title_ru' => 'Насаждения ограниченного пользования',
           'title_kz' => 'Шектеулі пайдаланудағы екпелер'
        ]);
        Category::create([
           'title_ru' => 'Насаждения ограниченного пользования',
           'title_kz' => 'Шектеулі пайдаланудағы екпелер'
        ]);
        Category::create([
           'title_ru' => 'Насаждения на территории частных домостроений (частный сектор, кладбища)',
           'title_kz' => 'Жеке үй құрылыстарының аумағындағы екпелер (жеке сектор, зираттар) '
        ]);
    }
}
