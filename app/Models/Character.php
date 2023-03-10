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
     * キャラクターの管理画面の身長をフォーマット
     *
     * @return 
     */
    public function getFormatedHeightAttribute()
    {
        if (empty($this->height)) {
            return "未登録";
        }
        return $this->height;
    }

    /**
     * キャラクター図鑑の身長をフォーマット
     *
     * @return 
     */
    public function getFormatedPbookHeightAttribute()
    {
        if (empty($this->height)) {
            return "不明";
        }
        return $this->height;
    }

    /**
     * キャラクターの管理画面の体重をフォーマット
     *
     * @return 
     */
    public function getFormatedWeightAttribute()
    {
        if (empty($this->weight)) {
            return "未登録";
        }
        return $this->weight;
    }

    /**
     * キャラクター図鑑の身長をフォーマット
     *
     * @return 
     */
    public function getFormatedPbookweightAttribute()
    {
        if (empty($this->height)) {
            return "不明";
        }
        return $this->height;
    }

    /**
     * 画像パスをフォーマット
     *
     * @return string
     */
    public function getFormatedImagePathAttribute(): string
    {
        if (empty($this->image_path)) {
            return asset("/storage/img/noimage.png");
        }
        return asset($this->image_path);
    }


    /**
     * アクティブなキャラクターを全取得する
     *
     * @param object $query
     * @return object
     */
    public function scopeFetchAll(object $query): object
    {
        return $query
            ->whereNull("characters.deleted_at")
            ->whereNull("character_images.deleted_at")
            ->leftJoin("seasons", "characters.season_id", "=", "seasons.id")
            ->leftJoin("tribes", "characters.tribe_id", "=", "tribes.id")
            ->leftJoin("character_images", "character_images.character_id", "characters.id")
            ->select($this->defaultFetchColumns)
            ->orderBy("season_id", "asc")
            ->orderBy("id", "asc")
            ->get();
    }

    /**
     * 対象のIDのキャラクターが存在するか
     *
     * @param object $query
     * @param string $characterId
     * @return boolean
     */
    public function scopeIsCharacterExists(object $query, string $characterId): bool
    {
        return $query
            ->where([
                "deleted_at" => null,
                "id" => $characterId,
            ])
            ->exists();
    }


    /**
     * 編集対象のIDのキャラクターを取得
     *
     * @param object $query
     * @param integer $characterId
     * @return object
     */
    public function scopeFetchCharacterDataByCharacterId(object $query, int $characterId): object
    {
        return $query
            ->where([
                "characters.deleted_at" => null,
                "characters.id" => $characterId,
                "seasons.deleted_at" => null,
                "tribes.deleted_at" => null,
            ])
            ->leftJoin("seasons", "characters.season_id", "=", "seasons.id")
            ->leftJoin("tribes", "characters.tribe_id", "=", "tribes.id")
            ->leftJoin("character_images", "character_images.character_id", "characters.id")
            ->select("characters.*", "seasons.name as season_name", "tribes.name as tribe_name")
            ->first();
    }


    /**
     * レコードの更新処理
     *
     * @param object $query
     * @param array $param
     * @return boolean
     */
    public function scopeUpdateExecution(object $query, array $param): bool
    {
        return $query
            ->findOrFail($param["id"])
            ->fill($param)
            ->save();
    }


    /**
     * 対象のIDのレコードに対して削除フラグを立てる
     *
     * @param object $query
     * @param integer $id
     * @return boolean
     */
    public function scopeDeleteRow(object $query, int $id): bool
    {
        return $query
            ->findOrFail($id)
            ->delete();
    }


    /**
     * 検索対象のキャラクターを全取得
     *
     * @param object $query
     * @param array $filter
     * @return object
     */
    public function scopeSearchAll(object $query, array $filter): object
    {
        return $query
            ->whereNull("characters.deleted_at")
            ->whereNull("character_images.deleted_at")
            ->when(!empty($filter["season"]) && is_array($filter["season"]), function ($query) use ($filter) {
                return $query->whereIn("season_id", $filter["season"]);
            })
            ->when(!empty($filter["tribe"]) && is_array($filter["tribe"]), function ($query) use ($filter) {
                return $query->whereIn("tribe_id", $filter["tribe"]);
            })
            ->when(!empty($filter["keyword"]), function ($query) use ($filter) {
                return $query->where("name", "LIKE", "%" . $filter["keyword"] . "%");
            })
            ->leftJoin("character_images", "character_images.character_id", "characters.id")
            ->select("characters.*", "character_images.image_path")
            ->orderBy("season_id", "asc")
            ->orderBy("characters.id", "asc")
            ->get();
    }
}
