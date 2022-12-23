<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CharacterImage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use SoftDeletes;
    use HasFactory;


    protected $table = "characters";

    protected $guarded = [
        'id'
    ];

    /**
     * デフォルト取得カラム
     *
     * @var array
     */
    private $defaultFetchColumns = [
        "characters.*",
        "seasons.name as season_name",
        "tribes.name as tribe_name",
        "character_images.image_path",
    ];

    public function character_images()
    {
        return $this->hasMany(CharacterImage::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleted(function ($character) {
            $character->character_images()->delete();
        });
    }

    /**
     * 画像パスをフォーマット
     *
     * @return string
     */
    public function getFormatedImagePathAttribute():string
    {
        if (empty($this->image_path)) {
            return asset("/storage/img/noimage.png");
        }
        return asset($this->image_path);
    }

    /**
     * アクティブなキャラクターを全取得
     *
     * @param object $query
     * @return object
     */
    public function scopeFetchAll(object $query):object
    {
        return $query
            ->whereNull("characters.deleted_at")
            ->whereNull("character_images.deleted_at")
            ->leftJoin("seasons", "characters.season_id", "=", "seasons.id")
            ->leftJoin("tribes", "characters.tribe_id", "=", "tribes.id")
            ->leftJoin("character_images", "character_images.character_id", "characters.id")
            ->select($this->defaultFetchColumns)
            ->get();
    }
}
