<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
           'title_ru' => 'Вырублено',
           'title_kz' => 'Кесілген'
        ]);
        Status::create([
           'title_ru' => 'Санитарная вырубка - выполнена',
           'title_kz' => 'Санитарлық кесу - орындалды'
        ]);
        Status::create([
           'title_ru' => 'Санитарная обрезка - выполнена',
           'title_kz' => 'Санитарлық қырқу - орындалды'
        ]);
        Status::create([
           'title_ru' => 'Формирование кроны - выполнено',
           'title_kz' => 'Кронның қалыптасуы - орындалды'
        ]);
        Status::create([
           'title_ru' => 'Пересадка - выполнено',
           'title_kz' => 'Трансплантация - орындалды'
        ]);
        Status::create([
           'title_ru' => 'Омолаживание – выполнено',
           'title_kz' => 'Жасарту - орындалды'
        ]);
        Status::create([
           'title_ru' => 'Лечение ран и дупел – выполнено',
           'title_kz' => 'Жаралар мен қуыстарды емдеу - орындалды'
        ]);
        Status::create([
           'title_ru' => 'Прочистка и прореживание – Выполнено',
           'title_kz' => 'Тазарту және жұқару - орындалды'
        ]);
        Status::create([
           'title_ru' => 'Хим. Меры борьбы – выполнены',
           'title_kz' => 'Хим. Күрес шаралары - орындалды'
        ]);
        Status::create([
           'title_ru' => 'Био. Меры борьбы – выполнены',
           'title_kz' => 'Био. Күрес шаралары - орындалды'
        ]);
        Status::create([
           'title_ru' => 'Раскорчевка – выполнено',
           'title_kz' => 'Тамырын жұлу - орындалды'
        ]);
        Status::create([
           'title_ru' => 'Поднятие штамба – выполнено',
           'title_kz' => 'Сабақты көтеру - орындалды'
        ]);
        Status::create([
           'title_ru' => 'Дополнение – выполнено',
           'title_kz' => 'Қосымша - орындалды'
        ]);
        Status::create([
           'title_ru' => 'Реконструкция - выполнена',
           'title_kz' => 'Реконструкция - орындалды'
        ]);
        Status::create([
           'title_ru' => 'Стрижка живой изгороди - выполнена',
           'title_kz' => 'Хеджирлеуді кесу - орындалды'
        ]);
        Status::create([
           'title_ru' => 'Техническое повреждение',
           'title_kz' => 'Техникалық зақым'
        ]);
        Status::create([
           'title_ru' => 'Природное явление (чрезвычайная ситуация)',
           'title_kz' => 'Табиғи құбылыс (төтенше жағдай)'
        ]);
        Status::create([
           'title_ru' => 'Несанкционированная вырубка',
           'title_kz' => 'Рұқсатсыз кесу'
        ]);
        Status::create([
           'title_ru' => 'Компенсационная посадка',
           'title_kz' => 'Өтемдік отырғызу'
        ]);
        Status::create([
           'title_ru' => 'Бюджетная посадка',
           'title_kz' => 'Бюджеттік отырғызу'
        ]);
        Status::create([
           'title_ru' => 'Инициативная посадка',
           'title_kz' => 'Бастамашыл отырғызу'
        ]);
        Status::create([
           'title_ru' => 'Договор ГЧП',
           'title_kz' => 'МЖС Шарты'
        ]);
        Status::create([
           'title_ru' => 'Отказ вырубке',
           'title_kz' => 'Кесуден бас тарту'
        ]);
    }
}
