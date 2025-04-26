<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
           'title_ru' => 'Уход (подкормка, полив, рыхление и т.п.)',
           'title_kz' => 'Күтім (азықтандыру, суару, қопсыту және т. б.)'
        ]);
        Event::create([
           'title_ru' => 'Санитарная обрезка',
           'title_kz' => 'Санитарлық қысқарту'
        ]);
        Event::create([
           'title_ru' => 'Санитарная вырубка',
           'title_kz' => 'Санитарлық кесу'
        ]);
        Event::create([
           'title_ru' => 'Формирование кроны',
           'title_kz' => 'Кронның қалыптасуы'
        ]);
        Event::create([
           'title_ru' => 'Лечение ран и дупел',
           'title_kz' => 'Жаралар мен қуыстарды емдеу'
        ]);
        Event::create([
           'title_ru' => 'Омолаживание',
           'title_kz' => 'Жасарту'
        ]);
        Event::create([
           'title_ru' => 'Осветление, прочистка и прорежование',
           'title_kz' => 'Жарықтандыру, тазарту және жұқару'
        ]);
        Event::create([
           'title_ru' => 'Химические меры борьбы',
           'title_kz' => 'Химиялық бақылау шаралары'
        ]);
        Event::create([
           'title_ru' => 'Биологические меры борьбы',
           'title_kz' => 'Биологиялық бақылау шаралары'
        ]);
        Event::create([
           'title_ru' => 'Вырубка',
           'title_kz' => 'Кесу'
        ]);
        Event::create([
           'title_ru' => 'Раскорчевка',
           'title_kz' => 'Тамырсабақ'
        ]);
        Event::create([
           'title_ru' => 'Пересадка',
           'title_kz' => 'Трансплантация'
        ]);
        Event::create([
           'title_ru' => 'Поднятие штамба',
           'title_kz' => 'Сабақты көтеру'
        ]);
        Event::create([
           'title_ru' => 'Дополнение',
           'title_kz' => 'Қосымша'
        ]);
        Event::create([
           'title_ru' => 'Реконструкция',
           'title_kz' => 'Қайта құру'
        ]);
        Event::create([
           'title_ru' => 'Стрижка живой изгороди',
           'title_kz' => 'Хеджирлеуді кесу'
        ]);
    }
}
