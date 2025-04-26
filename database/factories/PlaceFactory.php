<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    protected $model = Place::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'area_id' => Area::all()->random(),
            'title_ru' => fake()->city,
            'title_kz' => 'TEST',
            'geocode' => '[{"type":"Feature","properties":{},"geometry":{"type":"Polygon","coordinates":[[[69.398575,42.37313],[69.410934,42.408375],[69.454193,42.41674],[69.475136,42.454494],[69.480629,42.470198],[69.510498,42.467665],[69.617615,42.446135],[69.622078,42.408629],[69.608688,42.371862],[69.572983,42.370593],[69.542084,42.341163],[69.552727,42.316289],[69.529724,42.323651],[69.484406,42.350806],[69.398575,42.37313]]]}}]',
            'bg_color' => '#'.$this->random_color()
        ];
    }

    public function random_color_part()
    {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    public function random_color()
    {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }

}
