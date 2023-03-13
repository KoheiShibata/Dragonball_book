<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Character;

class CharacterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Character::insert([
            [
                "name" => "孫悟空(少年期)",
                "height" => null,
                "weight" => null,
                "image_path" => null,
                "tribe_id" => 1,
                "season_id" => 1,
                "content" => "西の都から1000kmも離れた辺境のパオズ山。
                              ここに一人の少年が、武術の修業に明け暮れながら呑気に暮らしていた。
                            少年の名は「孫悟空」。",
                "attack" => "3",
                "defense" => "3",
                "ability" => "3",
                "popularity" => "3"
            ],
            [
                "name" => "ブルマ(少年期)",
                "height" => null,
                "weight" => null,
                "image_path" => null,
                "tribe_id" => 3,
                "season_id" => 1,
                "content" => "西の都にあるカプセルコーポレーションの社長「ブリーフ博士」の娘であり、お金持ちで頭脳明晰なお嬢様。
                              16歳の時、自宅の倉で偶然ドラゴンボール（二星球）を見つけて興味を持ち、世界各地に散らばっているドラゴンボールの位置を探知する「ドラゴンレーダー」を発明。
                              神龍に「素敵な恋人」を頼むべく、ドラゴンボール探しの旅に出る。
                              その旅の途中で孫悟空と出会い、ここからすべての物語が始まることになる。",
                "attack" => "3",
                "defense" => "3",
                "ability" => "3",
                "popularity" => "3"
            ],
            [
                "name" => "亀仙人",
                "height" => null,
                "weight" => null,
                "image_path" => null,
                "tribe_id" => 3,
                "season_id" => 1,
                "content" => "年齢は319歳（初登場時）
                              亀仙流武術の創始者。世間では世界最強とうたわれる武天老師と呼ばれる伝説の武道家。
                              悟空やクリリンの師匠であると同時に、悟空の祖父・孫悟飯やチチの父・牛魔王の師匠でもあるが、
                              とにかくスケベ。",
                "attack" => "3",
                "defense" => "3",
                "ability" => "3",
                "popularity" => "3"
            ],
        ]);
    }
}
