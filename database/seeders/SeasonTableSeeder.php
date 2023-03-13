<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Season::insert([
            [
                "name" => "ドラゴンボール",
            ],
            [
                "name" => "ドラゴンボールZ",
            ],
            [
                "name" => "ドラゴンボール超",
            ],
            [
                "name" => "ドラゴンボールGT",
            ],
        ]);
    }
}
