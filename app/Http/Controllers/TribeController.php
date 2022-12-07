<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tribe;

class TribeController extends Controller
{

    /**
     * 種族の新規登録/種族一覧をHTMLで出力
     *
     * @return view
     */
    public function tribes() {
        $tribes = Tribe::whereNull("deleted_at")->get();
        return view("/tribes", compact("tribes"));
    }

    /**
     * カテゴリーを新規登録
     *
     * @param Request $request
     * @return redirect
     */
    public function create(Request $request) {
        Tribe::create(["name" => $request->name]);
        return redirect("/tribes")->with("successMessage", "登録が完了しました");
    }


   /**
    * カテゴリー名を編集する
    *
    * @param Request $request
    * @return redirect
    */
    public function edit(Request $request) {
        $tribe = Tribe::where("id", "=", $request->id)->first();

        // バリデーション
        $this->validate($request, config("validator.tribe.edit"));
        $tribe->name = $request->name;
        $tribe->save();

        return redirect("/tribes")->with("successMessage", "変更が完了しました");
    }


    /**
     * カテゴリーを削除する
     *
     * @param Request $request
     * @return 
     */
    public function delete(Request $request) {
        Tribe::find($request->id)->delete();
        return redirect("/tribes")->with("successMessage", "削除に成功しました");
    }



}
