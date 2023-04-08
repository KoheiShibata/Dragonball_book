<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\SoftDeletes;

class Enquete extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "enquetes";

    protected $guarded = [
        "id"
    ];


    /**
     * アンケートの質問を登録 & アンケート結果を配列で返す
     *
     * @param object $query
     * @param array $enquetes
     * @return array
     */
    public function scopeInsertDatabyEnquete(object $query, array $enquetes): array
    {
        $enqueteId = null;
        $param = [];
        foreach ($enquetes as $key => $answer) {
            $enqueteId = Enquete::where([
                "deleted_at" => null,
                "title" => $key,
            ])
                ->first("id");

            // 新しいアンケートの質問を登録する
            if (!$enqueteId) {
                $enqueteId = Enquete::create(["title" => $key])->id;
            }

            $enqueteId = $enqueteId->id;
            $param[] = [
                "enquete_id" => $enqueteId,
                "answer" => $answer,
                "created_at" => now(),
            ];
        }
        return $param;
    }


    /**
     * アンケート結果を全取得する
     *
     * @param object $query
     * @return object
     */
    public function scopeFetchRanking(object $query): object
    {
        return $query
            ->where([
                "enquetes.deleted_at" => null,
                "enquete_answers.deleted_at" => null,
                "characters.deleted_at" => null,
                "character_images.deleted_at" => null,
                "seasons.deleted_at" => null,
                "tribes.deleted_at" => null,
            ])
            ->leftJoin("enquete_answers", "enquete_answers.enquete_id", "enquetes.id")
            ->leftJoin("characters", "characters.name", "enquete_answers.answer")
            ->leftJoin("character_images", "character_images.character_id", "characters.id")
            ->leftJoin("seasons", "seasons.id", "characters.season_id")
            ->leftJoin("tribes", "tribes.id", "characters.tribe_id")
            ->selectRaw('enquetes.id, enquetes.title, characters.*, enquete_answers.enquete_id, enquete_answers.answer')
            ->selectRaw('GROUP_CONCAT(DISTINCT character_images.image_path) AS image_paths')
            ->selectRaw('COUNT(DISTINCT enquete_answers.id) AS vote_count')
            ->selectRaw('seasons.name AS season_name')
            ->selectRaw('tribes.name AS tribe_name')
            ->groupBy('enquetes.id', 'characters.id')
            ->orderBy('enquetes.id', 'asc')
            ->orderBy("vote_count", "desc")
            ->get();
    }
}
