<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Breed;
use App\Models\Category;
use App\Models\Event;
use App\Models\Marker;
use App\Models\Place;
use App\Models\Sanitary;
use App\Models\Status;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Marker>
 */
class MarkerFactory extends Factory
{
    protected $model = Marker::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $lat = fake()->latitude(42, 43);
        $lng = fake()->longitude(69, 70);
        $place = Place::all()->random();
        return [
            'event_id' => Event::all()->random(),
            'sanitary_id' => Sanitary::all()->random(),
            'category_id' => Category::all()->random(),
            'status_id' => Status::all()->random(),
            'type_id' => Type::all()->random(),
//            'height' => mt_rand(1, 150),
            'height' => fake()->randomNumber(3),
            'diameter' => mt_rand(1, 30),
            'landing_date' => fake()->dateTimeThisCentury(),
            'user_id' => 2,
            'breed_id' => Breed::all()->random(),
            'age' => mt_rand(1, 100),
            'place_id' => $place->id,
//            'area_id' => fake()->unique()->numberBetween(1, Place::count()),
            'area_id' => $place->area_id,
            'geocode' => json_encode([
                'lat' => $lat,
                'lng' => $lng
            ]),
            "point"=>new Point($lat,$lng)
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
