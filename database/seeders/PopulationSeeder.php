<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Population;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PopulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Population::create([
           'area_id' => 1,
           'count' => 257700
        ]);
        Population::create([
           'area_id' => 2,
           'count' => 205485
        ]);
        Population::create([
           'area_id' => 3,
           'count' => 207210
        ]);
        Population::create([
           'area_id' => 4,
           'count' => 221752
        ]);
        Population::create([
           'area_id' => 5,
           'count' => 220670
        ]);
    }
}
