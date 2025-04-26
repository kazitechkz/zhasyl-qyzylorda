<?php

namespace Database\Seeders;

use App\Models\Sanitary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SanitarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sanitary::create([
           'title_ru' => 'Здоровые',
           'title_kz' => 'Дені сау'
        ]);
//        Sanitary::create([
//           'title_ru' => 'Ослабленные (КСО-2)',
//           'title_kz' => 'Әлсіреген (ОКК-2)'
//        ]);
//        Sanitary::create([
//           'title_ru' => 'Угнетенные (КСО-3)',
//           'title_kz' => 'Езілгендер (ОКК-3)'
//        ]);
        Sanitary::create([
           'title_ru' => 'Усыхающие',
           'title_kz' => 'Кептіру'
        ]);
//        Sanitary::create([
//           'title_ru' => 'Сухостой (КСО-5)',
//           'title_kz' => 'Құрғақ (ОКК-5)'
//        ]);
        Sanitary::create([
           'title_ru' => 'Аварийное',
           'title_kz' => 'Авариялық'
        ]);
//        Sanitary::create([
//           'title_ru' => 'Хорошее (КСО-2, гибель насаждений до 20%)',
//           'title_kz' => 'Жақсы (ОКК-2, екпелердің өлімі 20% дейін)'
//        ]);
//        Sanitary::create([
//           'title_ru' => 'Удовлетворительное (КСО-3, гибель насаждений до 50%)',
//           'title_kz' => 'Қанағаттанарлық (ОКК-3, екпелердің 50% дейін жойылуы)'
//        ]);
//        Sanitary::create([
//           'title_ru' => 'Неудовлетворительное (КСО-4, гибель насаждений более 50%)',
//           'title_kz' => 'Қанағаттанарлықсыз (ОКК-4, екпелердің өлімі 50% - дан астам)'
//        ]);
    }
}
