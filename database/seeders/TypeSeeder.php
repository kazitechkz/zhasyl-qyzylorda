<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create([
           'title_ru' => 'Дерево',
            'title_kz' => 'Ағаш'
        ]);
        Type::create([
           'title_ru' => 'Кустарник',
            'title_kz' => 'Бұта'
        ]);
//        Type::create([
//           'title_ru' => 'Куртина (Деревья)',
//            'title_kz' => 'Куртина (ағаштар)'
//        ]);
//        Type::create([
//           'title_ru' => 'Куртина (Кустарники)',
//            'title_kz' => 'Куртина (бұталар)'
//        ]);
//        Type::create([
//           'title_ru' => 'Живая изгородь',
//            'title_kz' => 'Хеджирлеу'
//        ]);
//        Type::create([
//           'title_ru' => 'Цветник',
//            'title_kz' => 'Гүл бақшасы'
//        ]);
//        Type::create([
//           'title_ru' => 'Газон',
//            'title_kz' => 'Газон'
//        ]);
//        Type::create([
//           'title_ru' => 'Лиана',
//            'title_kz' => 'Лиана'
//        ]);
    }
}
