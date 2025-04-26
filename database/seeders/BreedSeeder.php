<?php

namespace Database\Seeders;

use App\Models\Breed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Breed::create([
           'title_ru' => 'Айлант',
           'title_kz' => 'Айлант',
           'image_url' => 'ailant.jpg',
           'coefficient' => '2',
           'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Акация белая',
           'title_kz' => 'Ақ акация',
           'image_url' => 'white_akasia.jpeg',
           'coefficient' => '2',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Береза бородавчатая',
           'title_kz' => 'Сүйелді қайың',
           'image_url' => 'bereza_roslesopitomnik.jpg',
           'coefficient' => '2',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Гледичия',
           'title_kz' => 'Бал шегіртке',
           'image_url' => 'gleditsia.jpg',
           'coefficient' => '2',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Ива белая',
           'title_kz' => 'Ақ тал',
           'image_url' => 'white_iva.jpg',
           'coefficient' => '2',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Ива вавилонская',
           'title_kz' => 'Вавилондық тал',
           'image_url' => 'vavilon_iva.jpg',
           'coefficient' => '2',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Павловния',
           'title_kz' => 'Пауловния',
           'image_url' => 'pavlovnia.jpg',
           'coefficient' => '2',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Тополь черный',
           'title_kz' => 'Қара терек',
           'image_url' => 'black_topol.jpg',
           'coefficient' => '2',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Эвкалипт',
           'title_kz' => 'Эвкалипт',
           'image_url' => 'evkalipt.jpg',
           'coefficient' => '2',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Вяз Ильм',
           'title_kz' => 'Қараағаш (Ильм)',
           'image_url' => 'vyaz_ilm.jpg',
           'coefficient' => '1',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Катальпа',
           'title_kz' => 'Катальпа ',
           'image_url' => 'katalpa.jpg',
           'coefficient' => '1',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Маклюра',
           'title_kz' => 'Маклюра ',
           'image_url' => 'maclura.jpg',
           'coefficient' => '1',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Орех грецкий',
           'title_kz' => 'Жаңғақ ',
           'image_url' => 'oreh.webp',
           'coefficient' => '1',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Платан',
           'title_kz' => 'Шынар ',
           'image_url' => 'platan.jpg',
           'coefficient' => '1',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Тюльпановое дерево',
           'title_kz' => 'Қызғалдақ ағашы',
           'image_url' => 'tyulpanovoe-derevo.jpg',
           'coefficient' => '1',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Шелковица',
           'title_kz' => 'Тұт',
           'image_url' => 'morus_nigra.jpg',
           'coefficient' => '1',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Ясень обыкновенный',
           'title_kz' => 'Кәдімгі күл',
           'image_url' => 'yasen.jpeg',
           'coefficient' => '1',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Ель обыкновенная',
           'title_kz' => 'Қарапайым шырша',
           'image_url' => 'el.JPG',
           'coefficient' => '1',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Лиственница европейская',
           'title_kz' => 'Еуропалық балқарағай',
           'image_url' => 'listvennisa_evro.jpg',
           'coefficient' => '1',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Лиственница сибирская',
           'title_kz' => 'Сібір балқарағайы',
           'image_url' => 'listvennisa_sibir.jpg',
           'coefficient' => '1',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Псевдотсуга тиссолистная',
           'title_kz' => 'Псевдотсуга',
           'image_url' => 'pseudotsuga_menziesii.jpg',
           'coefficient' => '1',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Сосна Веймутова',
           'title_kz' => 'Веймут Қарағайы',
           'image_url' => 'veimut_sosna.webp',
           'coefficient' => '1',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Сосна обыкновенная',
           'title_kz' => 'Кәдімгі қарағай',
           'image_url' => 'sosna.jpg',
           'coefficient' => '1',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Бархат амурский',
           'title_kz' => 'Амур барқыт',
           'image_url' => 'amur.jpg',
           'coefficient' => '0.5',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Вяз',
           'title_kz' => 'Қарағаш',
           'image_url' => 'vyaz.jpg',
           'coefficient' => '0.5',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Граб обыкновенный',
           'title_kz' => 'Кәдімгі мүйіз',
           'image_url' => 'grab.jpg',
           'coefficient' => '0.5',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Дуб скальный',
           'title_kz' => 'Жартас емен',
           'image_url' => 'dub_skalni.jpg',
           'coefficient' => '0.5',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Дуб черешчатый',
           'title_kz' => 'Жапырақты емен',
           'image_url' => 'dub_cher.jpg',
           'coefficient' => '0.5',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Клен остролистый',
           'title_kz' => 'Үйеңкі',
           'image_url' => 'klen.jpeg',
           'coefficient' => '0.5',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Клен полевой',
           'title_kz' => 'Дала үйеңкісі',
           'image_url' => 'klen_polevoi.jpg',
           'coefficient' => '0.5',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Липа крупнолистная',
           'title_kz' => 'Үлкен жапырақты линден',
           'image_url' => 'lipa.jpeg',
           'coefficient' => '0.5',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Ель колючая',
           'title_kz' => 'Тікенді шырша',
           'image_url' => 'elkolyuchaya.jpeg',
           'coefficient' => '0.5',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Можжевельник виргинский',
           'title_kz' => 'Виргин аршасы',
           'image_url' => 'mozhevelnik_virgin.jpg',
           'coefficient' => '0.5',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Можжевельник',
           'title_kz' => 'Арша',
           'image_url' => 'mozhevelnik.jpg',
           'coefficient' => '0.5',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Пихта кавказская',
           'title_kz' => 'Кавказ шыршасы',
           'image_url' => 'pihta.jpg',
           'coefficient' => '0.5',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Пихта сибирская',
           'title_kz' => 'Сібір шыршасы',
           'image_url' => 'pihta_sibir.jpg',
           'coefficient' => '0.5',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Туя западная',
           'title_kz' => 'Батыс Туя',
           'image_url' => 'thuja.jpg',
           'coefficient' => '0.5',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Груша лесная',
           'title_kz' => 'Орман алмұрты',
           'image_url' => 'grusha-lesnaya.jpg',
           'coefficient' => '0.25',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Груша лохолистная',
           'title_kz' => 'Лохо жапырақты алмұрт',
           'image_url' => 'grusha-loholistnaya.jpg',
           'coefficient' => '0.25',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Фисташковое дерево',
           'title_kz' => 'Пісте ағашы',
           'image_url' => 'fistashkovoe-derevo.jpg',
           'coefficient' => '0.25',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Яблоня лесная',
           'title_kz' => 'Орман алма ағашы',
           'image_url' => 'yablonya.webp',
           'coefficient' => '0.25',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Яблоня сибирская',
           'title_kz' => 'Сібір алма ағашы',
           'image_url' => 'sibirskaya-yablonya.jpg',
           'coefficient' => '0.25',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Сосна кедровая сибирская',
           'title_kz' => 'Сібір балқарағайы',
           'image_url' => 'sosna_sibir.jpg',
           'coefficient' => '0.25',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Туя восточная',
           'title_kz' => 'Шығыс Туя',
           'image_url' => 'tuya.jpg',
           'coefficient' => '0.25',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Самшит',
           'title_kz' => 'Самшит',
           'image_url' => 'samshit.jpg',
           'coefficient' => '0.15',
            'status' => 1
        ]);
        Breed::create([
           'title_ru' => 'Тис ягодный',
           'title_kz' => 'Жидек ағашы',
           'image_url' => 'tis.jpg',
           'coefficient' => '0.15',
            'status' => 1
        ]);
//        Breed::create([
//           'title_ru' => 'Хвойные',
//           'title_kz' => 'Қылқан жапырақты ағаштар'
//        ]);
//        Breed::create([
//           'title_ru' => 'Твердолиственные',
//           'title_kz' => 'Қатты жапырақты'
//        ]);
//        Breed::create([
//           'title_ru' => 'Мягколиственные',
//           'title_kz' => 'Жұмсақ жапырақты'
//        ]);
//        Breed::create([
//           'title_ru' => 'Саксаульники',
//           'title_kz' => 'Сексеуілшілер'
//        ]);
//        Breed::create([
//           'title_ru' => 'Биота восточная',
//           'title_kz' => 'Шығыс Биота'
//        ]);
//        Breed::create([
//           'title_ru' => 'Прочие древесные породы',
//           'title_kz' => 'Басқа ағаш түрлері'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ель',
//           'title_kz' => 'Шырша'
//        ]);
//        Breed::create([
//           'title_ru' => 'Кедр',
//           'title_kz' => 'Балқарағай'
//        ]);
//        Breed::create([
//           'title_ru' => 'Лиственница',
//           'title_kz' => 'Лиственница'
//        ]);
//        Breed::create([
//           'title_ru' => 'Можжевельник',
//           'title_kz' => 'Арша'
//        ]);
//        Breed::create([
//           'title_ru' => 'Пихта',
//           'title_kz' => 'Пихта'
//        ]);
//        Breed::create([
//           'title_ru' => 'Псевдотсуга',
//           'title_kz' => 'Псевдотсуга'
//        ]);
//        Breed::create([
//           'title_ru' => 'Сосна',
//           'title_kz' => 'Қарағай'
//        ]);
//        Breed::create([
//           'title_ru' => 'Туя западная',
//           'title_kz' => 'Батыс Туя'
//        ]);
//        Breed::create([
//           'title_ru' => 'Тсуга',
//           'title_kz' => 'Цуга'
//        ]);
//        Breed::create([
//           'title_ru' => 'Вяз',
//           'title_kz' => 'Қарағаш'
//        ]);
//        Breed::create([
//           'title_ru' => 'Дуб',
//           'title_kz' => 'Емен'
//        ]);
//        Breed::create([
//           'title_ru' => 'Клен',
//           'title_kz' => 'Үйеңкі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Орех',
//           'title_kz' => 'Жаңғақ'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ясень',
//           'title_kz' => 'Күл'
//        ]);
//        Breed::create([
//           'title_ru' => 'Береза',
//           'title_kz' => 'Қайың'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ива',
//           'title_kz' => 'Тал'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ольха',
//           'title_kz' => 'Алдер'
//        ]);
//        Breed::create([
//           'title_ru' => 'Осина',
//           'title_kz' => 'Көктерек'
//        ]);
//        Breed::create([
//           'title_ru' => 'Тополь',
//           'title_kz' => 'Терек'
//        ]);
//        Breed::create([
//           'title_ru' => 'Саксаул',
//           'title_kz' => 'Сексеуіл'
//        ]);
//        Breed::create([
//           'title_ru' => 'Абрикос обыкновенный',
//           'title_kz' => 'Кәдімгі өрік'
//        ]);
//        Breed::create([
//           'title_ru' => 'Айлант высочайший',
//           'title_kz' => 'Айлант ең биік'
//        ]);
//        Breed::create([
//           'title_ru' => 'Акация белая',
//           'title_kz' => 'Акация ақ'
//        ]);
//        Breed::create([
//           'title_ru' => 'Бархат амурский',
//           'title_kz' => 'Амур барқыт'
//        ]);
//        Breed::create([
//           'title_ru' => 'Боярышник',
//           'title_kz' => 'Долана'
//        ]);
//        Breed::create([
//           'title_ru' => 'Бундук',
//           'title_kz' => 'Бундук'
//        ]);
//        Breed::create([
//           'title_ru' => 'Вишня',
//           'title_kz' => 'Шие'
//        ]);
//        Breed::create([
//           'title_ru' => 'Гледичия обыкновенная',
//           'title_kz' => 'Кәдімгі бал шегіртке'
//        ]);
//        Breed::create([
//           'title_ru' => 'Глирицидия',
//           'title_kz' => 'Глицид'
//        ]);
//        Breed::create([
//           'title_ru' => 'Груша',
//           'title_kz' => 'Алмұрт'
//        ]);
//        Breed::create([
//           'title_ru' => 'Каркас кавказский',
//           'title_kz' => 'Кавказ қаңқасы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Катальпа',
//           'title_kz' => 'Каталпа'
//        ]);
//        Breed::create([
//           'title_ru' => 'Каштан конский',
//           'title_kz' => 'Жылқы каштаны'
//        ]);
//        Breed::create([
//           'title_ru' => 'Липа',
//           'title_kz' => 'Линден'
//        ]);
//        Breed::create([
//           'title_ru' => 'Пшат',
//           'title_kz' => 'Пшат'
//        ]);
//        Breed::create([
//           'title_ru' => 'Персик обыкновенный',
//           'title_kz' => 'Кәдімгі шабдалы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Рябина',
//           'title_kz' => 'Тау күлі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Скумпия',
//           'title_kz' => 'Скумпия'
//        ]);
//        Breed::create([
//           'title_ru' => 'Слива',
//           'title_kz' => 'Алхоры'
//        ]);
//        Breed::create([
//           'title_ru' => 'Сумах',
//           'title_kz' => 'Сумақ'
//        ]);
//        Breed::create([
//           'title_ru' => 'Скумпия',
//           'title_kz' => 'Скумпия'
//        ]);
//        Breed::create([
//           'title_ru' => 'Черемуха обыкновенная',
//           'title_kz' => 'Кәдімгі құс шиесі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Шелковица (тутовое дерево)',
//           'title_kz' => 'Тұт'
//        ]);
//        Breed::create([
//           'title_ru' => 'Яблоня',
//           'title_kz' => 'Алма ағашы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ель канадская,сизья',
//           'title_kz' => 'Канадалық шырша, сизя'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ель колючая',
//           'title_kz' => 'Тікенді шырша'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ель колючая (форма голубая)',
//           'title_kz' => 'Тікенді шырша (көк пішін)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ель колючая (форма стланиковая)',
//           'title_kz' => 'Тікенді шырша (ергежейлі пішін)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ель европейская',
//           'title_kz' => 'Еуропалық шырша'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ель обыкновенная',
//           'title_kz' => 'Норвегия шыршасы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ель сибирская',
//           'title_kz' => 'Сібір шыршасы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ель Шренка (Тянь-Шаньская)',
//           'title_kz' => 'Шренк шыршасы (Тянь-Шань)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ель Энгельмана',
//           'title_kz' => 'Эль Энгельман'
//        ]);
//        Breed::create([
//           'title_ru' => 'Кедр сибирский',
//           'title_kz' => 'Сібір балқарағайы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Лиственница даурская',
//           'title_kz' => 'Дахуриан балқарағайы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Лиственница сибирская',
//           'title_kz' => 'Сібір балқарағайы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Можжевельник зеравшанский',
//           'title_kz' => 'Зеравшан аршасы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Можжевельник казацкий',
//           'title_kz' => 'Арша казак'
//        ]);
//        Breed::create([
//           'title_ru' => 'Можжевельник обыкновенный',
//           'title_kz' => 'Кәдімгі арша'
//        ]);
//        Breed::create([
//           'title_ru' => 'Можжевельник полушаровидный',
//           'title_kz' => 'Арша жарты шар тәрізді'
//        ]);
//        Breed::create([
//           'title_ru' => 'Можжевельник сибирский',
//           'title_kz' => 'Сібір аршасы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Можжевельник стланиковый',
//           'title_kz' => 'арша ергежейлі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Можжевельник туркестанский',
//           'title_kz' => 'Арша Түркістан'
//        ]);
//        Breed::create([
//           'title_ru' => 'Можжевельник виргинский',
//           'title_kz' => 'Қызыл балқарағай'
//        ]);
//        Breed::create([
//           'title_ru' => 'Пихта сибирская',
//           'title_kz' => 'Сібір шыршасы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Сосна Веймутова',
//           'title_kz' => 'Веймут қарағайы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Сосна крымская',
//           'title_kz' => 'Қырым қарағайы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Сосна обыкновенная',
//           'title_kz' => 'Шотланд қарағайы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Сосна горная',
//           'title_kz' => 'тау қарағайы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Туя форма колоновидная',
//           'title_kz' => 'Туя бағаналы пішіні'
//        ]);
//        Breed::create([
//           'title_ru' => 'Туя форма шаровидная',
//           'title_kz' => 'Туя сфералық пішіні'
//        ]);
//        Breed::create([
//           'title_ru' => 'Вяз Андросова',
//           'title_kz' => 'Қарағаш Андросов'
//        ]);
//        Breed::create([
//           'title_ru' => 'Вяз гладкий',
//           'title_kz' => 'Қарағаш тегіс'
//        ]);
//        Breed::create([
//           'title_ru' => 'Вяз густой',
//           'title_kz' => 'қалың қарағаш'
//        ]);
//        Breed::create([
//           'title_ru' => 'Вяз мелколистный (приземистый, ильмовик)',
//           'title_kz' => 'Ұсақ жапырақты қарағаш (қағаш, қарағаш)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Вяз шершавый (горный)',
//           'title_kz' => 'Дөрекі қарағаш (тау)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Дуб красный',
//           'title_kz' => 'Емен қызыл'
//        ]);
//        Breed::create([
//           'title_ru' => 'Дуб черешчатый',
//           'title_kz' => 'Педункулярлы емен'
//        ]);
//        Breed::create([
//           'title_ru' => 'Клен моно',
//           'title_kz' => 'Үйеңкі моно'
//        ]);
//        Breed::create([
//           'title_ru' => 'Клен приречный (гиннала)',
//           'title_kz' => 'Үйеңкі өзенінің жағасы (гиннала)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Клен полевой',
//           'title_kz' => 'далалық үйеңкі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Клен канадский',
//           'title_kz' => 'Канадалық үйеңкі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Клен ложноплатановый (белый, явор)',
//           'title_kz' => 'Жалған шынар үйеңкі (ақ, шынар)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Клен остролистный (платановидный)',
//           'title_kz' => 'Норвегия үйеңкі (шынар)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Клен сахарный',
//           'title_kz' => 'қант үйеңкі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Клен Семенова',
//           'title_kz' => 'Үйеңкі Семенов'
//        ]);
//        Breed::create([
//           'title_ru' => 'Клен серебристый',
//           'title_kz' => 'Күміс үйеңкі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Клен татарский (черноклен)',
//           'title_kz' => 'Татар үйеңкі (қара үйеңкі)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Клен ясенелистный (американский)',
//           'title_kz' => 'Күлді жапырақты үйеңкі (американдық)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Орех грецкий',
//           'title_kz' => 'жаңғақ'
//        ]);
//        Breed::create([
//           'title_ru' => 'Орех маньчжурский',
//           'title_kz' => 'Манчжур жаңғағы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ясень мелколистный (круглолистный)',
//           'title_kz' => 'Ұсақ жапырақты күл (дөңгелек жапырақты)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ясень зеленый (ланцетный)',
//           'title_kz' => 'Күлді жасыл (ланцетті)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ясень обыкновенный (высокий)',
//           'title_kz' => 'Кәдімгі күл (жоғары)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ясень чарынский (согдианский)',
//           'title_kz' => 'Шарын (соғды)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Береза бородавчатая (повислая, плакучая)',
//           'title_kz' => 'Сүйір қайың (салу, жылау)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Береза киргизская',
//           'title_kz' => 'Қырғыз қайыңы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Береза повислая',
//           'title_kz' => 'қайың салбырап тұр'
//        ]);
//        Breed::create([
//           'title_ru' => 'Береза мелколистная',
//           'title_kz' => 'Ұсақ жапырақты қайың'
//        ]);
//        Breed::create([
//           'title_ru' => 'Береза пушистая',
//           'title_kz' => 'қайың үлпілдек'
//        ]);
//        Breed::create([
//           'title_ru' => 'Береза толстосережчатая',
//           'title_kz' => 'Күміс қайың'
//        ]);
//        Breed::create([
//           'title_ru' => 'Береза туркестанская',
//           'title_kz' => 'Түркістан қайыңы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Береза тяньшанская',
//           'title_kz' => 'Тянь-Шань қайыңы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Береза Ярмоленко',
//           'title_kz' => 'Қайың Ярмоленко'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ива древовидная',
//           'title_kz' => 'Тал ағашы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ива белая (серебристая)',
//           'title_kz' => 'Талдың ақ (күміс)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ива вавилонская (плакучая)',
//           'title_kz' => 'Вавилон талы (жылау)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ива ломкая (ракита)',
//           'title_kz' => 'Сынғыш тал (тал)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ольха серая (белая)',
//           'title_kz' => 'Алдер сұр (ақ)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ольха черная (клейкая)',
//           'title_kz' => 'Алдер қара (жабысқақ)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Осина обыкновенная',
//           'title_kz' => 'Кәдімгі көктерек'
//        ]);
//        Breed::create([
//           'title_ru' => 'Осина ложная',
//           'title_kz' => 'Аспен жалған'
//        ]);
//        Breed::create([
//           'title_ru' => 'Тополь белый (серебристый)',
//           'title_kz' => 'Ақ терек (күміс)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Тополь бальзамический',
//           'title_kz' => 'Бальзам терегі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Тополь душистый',
//           'title_kz' => 'Хош иісті терек'
//        ]);
//        Breed::create([
//           'title_ru' => 'Тополь лавролистный',
//           'title_kz' => 'Теректі лавр'
//        ]);
//        Breed::create([
//           'title_ru' => 'Тополь пирамидальный',
//           'title_kz' => 'Терек пирамидасы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Тополь черный (осокорь)',
//           'title_kz' => 'Қара терек (қара терек)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Тополь Симона (китайский)',
//           'title_kz' => 'Терек Саймон (қытайша)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Тополь разнолистный (туранга)',
//           'title_kz' => 'Түрлі терек (туранга)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Саксаул белый',
//           'title_kz' => 'Сексеуіл ақ'
//        ]);
//        Breed::create([
//           'title_ru' => 'Саксаул зайсанский',
//           'title_kz' => 'Сексеуіл Зайсан'
//        ]);
//        Breed::create([
//           'title_ru' => 'Саксаул черный',
//           'title_kz' => 'Сексеуіл қара'
//        ]);
//        Breed::create([
//           'title_ru' => 'Боярышник Максимовича',
//           'title_kz' => 'Максимовичтің доланасы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Боярышник страшный',
//           'title_kz' => 'Қорқынышты долана'
//        ]);
//        Breed::create([
//           'title_ru' => 'Боярышник восточный',
//           'title_kz' => 'Шығыс доланасы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Боярышник кроваво-красный',
//           'title_kz' => 'долана қызыл'
//        ]);
//        Breed::create([
//           'title_ru' => 'Боярышник однопестичный',
//           'title_kz' => 'долана'
//        ]);
//        Breed::create([
//           'title_ru' => 'Боярышник перистонадрезанный',
//           'title_kz' => 'долана пиннат'
//        ]);
//        Breed::create([
//           'title_ru' => 'Боярышник обыкновеный',
//           'title_kz' => 'кәдімгі долана'
//        ]);
//        Breed::create([
//           'title_ru' => 'Вишня птичья (черешная)',
//           'title_kz' => 'Шие құсы (шие)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Глирицидия заборная',
//           'title_kz' => 'Глирицидияны қабылдау'
//        ]);
//        Breed::create([
//           'title_ru' => 'Груша обыкновенная',
//           'title_kz' => 'кәдімгі алмұрт'
//        ]);
//        Breed::create([
//           'title_ru' => 'Груша лохолистная',
//           'title_kz' => 'алмұрт'
//        ]);
//        Breed::create([
//           'title_ru' => 'Катальпа обыкновенная (бигнониевидная)',
//           'title_kz' => 'Кәдімгі каталпа (бигнониформа)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Катальпа прекрасная',
//           'title_kz' => 'Каталпа әдемі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Липа мелколистная',
//           'title_kz' => 'Линден кішкентай жапырақты'
//        ]);
//        Breed::create([
//           'title_ru' => 'Липа крупнолистная',
//           'title_kz' => 'Үлкен жапырақты линден'
//        ]);
//        Breed::create([
//           'title_ru' => 'Пшот илийский',
//           'title_kz' => 'Пшот Іле'
//        ]);
//        Breed::create([
//           'title_ru' => 'Пшот остроплодный',
//           'title_kz' => 'Пшот өткір жемісті'
//        ]);
//        Breed::create([
//           'title_ru' => 'Пшот серебристый',
//           'title_kz' => 'Пшот күміс'
//        ]);
//        Breed::create([
//           'title_ru' => 'Пшот узколистный',
//           'title_kz' => 'Тар жапырақты Пшот'
//        ]);
//        Breed::create([
//           'title_ru' => 'Рябина сибирская',
//           'title_kz' => 'Сібір тау күлі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Рябина тянь-шаньская',
//           'title_kz' => 'Тянь-Шань тау күлі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Рябина обыкновенная',
//           'title_kz' => 'Кәдімгі тау күлі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Слива согдийская',
//           'title_kz' => 'Соғды қара өрік'
//        ]);
//        Breed::create([
//           'title_ru' => 'Слива домашняя',
//           'title_kz' => 'Үйдегі қара өрік'
//        ]);
//        Breed::create([
//           'title_ru' => 'Слива растопыренная (алыча)',
//           'title_kz' => 'Жайылған қара өрік (шие өрігі)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Шелковица белая',
//           'title_kz' => 'Ақ тұт'
//        ]);
//        Breed::create([
//           'title_ru' => 'Шелковица черная',
//           'title_kz' => 'Қара тұт'
//        ]);
//        Breed::create([
//           'title_ru' => 'Яблоня домашняя',
//           'title_kz' => 'Үй алма ағашы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Яблоня киргизская',
//           'title_kz' => 'Қырғыз алма ағашы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Яблоня Недзвецкого',
//           'title_kz' => 'Недзвецкий Алма Ағашы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Яблоня сливолистная, китайская, китайка',
//           'title_kz' => 'Өрік жапырақты алма ағашы, Қытай'
//        ]);
//        Breed::create([
//           'title_ru' => 'Яблоня Сиверса',
//           'title_kz' => 'Сиверс Алма Ағашы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Яблоня лесная (дикая)',
//           'title_kz' => 'Орман алма ағашы (жабайы)'
//        ]);
//        Breed::create([
//           'title_ru' => 'Саксаульник Илийский',
//           'title_kz' => 'Іле Сексеуілшісі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Жузгун печальный',
//           'title_kz' => 'Джузгун қайғылы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Дуб обыкновенный',
//           'title_kz' => 'Кәдімгі емен'
//        ]);
//        Breed::create([
//           'title_ru' => 'Береза таласская',
//           'title_kz' => 'Талас қайыңы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Береза Ярмоленковская',
//           'title_kz' => 'Қайың Ярмоленковская'
//        ]);
//        Breed::create([
//           'title_ru' => 'Тополь Беркаринский',
//           'title_kz' => 'Беркарин Терегі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Тополь Сизолистый',
//           'title_kz' => 'Сұр Жапырақты Терек'
//        ]);
//        Breed::create([
//           'title_ru' => 'Рябина персидская',
//           'title_kz' => 'Парсы тау күлі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Боярышник сомнительный',
//           'title_kz' => 'Долана күмәнді'
//        ]);
//        Breed::create([
//           'title_ru' => 'Миндаль Ледебуровский',
//           'title_kz' => 'Ледебуровский Бадамы'
//        ]);
//        Breed::create([
//           'title_ru' => 'Карагана трагакантовая',
//           'title_kz' => 'Карагана трагакантовая'
//        ]);
//        Breed::create([
//           'title_ru' => 'Ясень согдийский',
//           'title_kz' => 'Соғды күлі'
//        ]);
//        Breed::create([
//           'title_ru' => 'Платан кленолистный',
//           'title_kz' => 'Үйеңкі жапырақты Шынар'
//        ]);
//        Breed::create([
//           'title_ru' => 'Платан',
//           'title_kz' => 'Шынар'
//        ]);
//        Breed::create([
//           'title_ru' => 'Робиния',
//           'title_kz' => 'Робиния'
//        ]);
//        Breed::create([
//           'title_ru' => 'Церцис',
//           'title_kz' => 'Церцис'
//        ]);
//        Breed::create([
//           'title_ru' => 'Сакура',
//           'title_kz' => 'Сакура'
//        ]);
//        Breed::create([
//           'title_ru' => 'Миндаль обыкновенный',
//           'title_kz' => 'Кәдімгі Бадам'
//        ]);
    }
}
