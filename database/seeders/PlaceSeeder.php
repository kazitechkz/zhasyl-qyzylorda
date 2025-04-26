<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Place;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Place::create([
           'area_id' => Area::all()->random(),
            'title_ru' => 'test',
            'title_kz' => 'test',
            'geocode' => '[{"type":"Feature","properties":{},"geometry":{"type":"Polygon","coordinates":[[[69.398575,42.37313],[69.410934,42.408375],[69.454193,42.41674],[69.475136,42.454494],[69.480629,42.470198],[69.510498,42.467665],[69.617615,42.446135],[69.622078,42.408629],[69.608688,42.371862],[69.572983,42.370593],[69.542084,42.341163],[69.552727,42.316289],[69.529724,42.323651],[69.484406,42.350806],[69.398575,42.37313]]]}}]',
            'bg_color' => '#00ff40'
        ]);
    }
}
