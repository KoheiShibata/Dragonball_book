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
    public function tribeList() {
        $tribes = Tribe::fetchAll();
        return view("tribes", compact("tribes"));
    }
    

    /**
     * カテゴリーを新規登録
     *
     * @param Request $request
     * @return redirect
     */
    public function create(Request $request) {
        try {
            $param = $request->validate(config(TRIBE_REGISTRATION_VALIDATE));
            Tribe::create($param);
            return redirect(TRIBE_TOP)->with(SUCCESS_MESSAGE, REGISTRATION_SUCCESS_MESSAGE);
        } catch (\Exception $e) {
            return redirect(TRIBE_TOP)->with(ERROR_MESSAGE, REGISTRATION_FAILED_MESSAGE);
        }
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
