<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tribe;

class TribeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tribe::insert([
            [
                "name" => "サイヤ人",
            ],
            [
                "name" => "混血サイヤ人",
            ],
            [
                "name" => "地球人",
            ],
            [
                "name" => "ナメック星人",
            ],
            [
                "name" => "人造人間",
            ],
            [
                "name" => "不明",
            ],
        ]);
    }
}
