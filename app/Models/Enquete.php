<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

            // $enqueteId = $enqueteId->id;
            $param[] = [
                "enquete_id" => $enqueteId,
                "answer" => $answer,
                "created_at" => now(),
            ];
        }
        return $param;
    }
}
