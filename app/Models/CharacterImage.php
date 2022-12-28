<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Character;
use Illuminate\Database\Eloquent\SoftDeletes;

class CharacterImage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "character_images";

    protected $guarded = [
        'id'
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }


    /**
     * 対象のIDのキャラクター画像を取得
     *
     * @param object $query
     * @param integer $characterId
     * @return object
     */
    public function scopeFetchImage(object $query, int $characterId):object
    {
        return $query
            ->whereNull("deleted_at")
            ->where("character_id", $characterId)
            ->select("image_path")
            ->get();
    }

    /**
     * 対象のIDのレコードを削除
     *
     * @param object $query
     * @param integer $characterId
     * @return boolean
     */
    public function scopeDeleteImageRow(object $query, int $characterId):bool
    {
        return $query
            ->whereNull("deleted_at")
            ->where("character_id", $characterId)
            ->delete();
    }
}
