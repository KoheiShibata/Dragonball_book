<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Season extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "seasons";

    protected $guarded = [
        'id'
    ];


    private $defaultFetchColumns = [
        "id",
        "name",
    ];

    /**
     * アクティブなシーズンを全取得
     *
     * @param object $query
     * @return object
     */
    public function scopeFetchAll(object $query):object {
        return $query
        ->whereNull("deleted_at")
        ->select($this->defaultFetchColumns)
        ->get();
    }


    /**
     * レコードの更新処理
     *
     * @param object $query
     * @param array $param
     * @return boolean
     */
    public function scopeUpdateRow(object $query, array $param):bool 
    {
        return $query
            ->findOrFail($param["id"])
            ->fill($param)
            ->save();
    }


    /**
     * 対象IDのレコードに対して削除フラグを立てる
     *
     * @param object $query
     * @param integer $id
     * @return boolean
     */
    public function scopeDeleteRow(object $query, int $id):bool 
    {
        return $query
            ->findOrFail($id)
            ->delete();
    }
    

    /**
     * 対象のシーズン名が存在するか
     *
     * @param object $query
     * @param string $seasonName
     * @return boolean
     */
    public function scopeIsSeasonExists(object $query, string $seasonName): bool
    {
        return $query
            ->where([
                "deleted_at" => null,
                "name" => $seasonName,
            ])
            ->exists();
    }

}
