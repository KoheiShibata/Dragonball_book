<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

use App\Models\Tribe;
use GrahamCampbell\ResultType\Success;

class TribeController extends Controller
{

    /**
     * 種族の新規登録/種族一覧をHTMLで出力
     *
     * @return view
     */
    public function index() {
        $tribes = Tribe::fetchAll();
        foreach ($tribes as $tribe) {
            $tribe->name = htmlspecialchars($tribe->name);
        }
        return view("tribe.index", compact("tribes"));
    }
    

    /**
     * カテゴリーを新規登録
     *
     * @param Request $request
     * @return redirect
     */
    public function store(Request $request) 
    {
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
    public function update(Request $request)
    {
        try {
            $param = $this->validate($request, config(TRIBE_UPDATE_VALIDATE));
            Tribe::updateRow($param);
            return redirect(TRIBE_TOP)->with(SUCCESS_MESSAGE, UPDATE_SUCCESS_MESSAGE);
        } catch(\Exception $e) {
            return redirect(TRIBE_TOP)->with(ERROR_MESSAGE, UPDATE_FAILED_MESSAGE);
        }
    }


    /**
     * カテゴリーを削除する
     *
     * @param Request $request
     * @return 
     */
    public function destory($id) {
        try {
            if(empty($id) ||
            !is_numeric($id)
            ) {
                throw new \Exception();
            }
            Tribe::deleteRow($id);
            return redirect(TRIBE_TOP)->with(SUCCESS_MESSAGE, DELETE_SUCCESS_MESSAGE);
        } catch (\Exception $e) {
            return redirect(TRIBE_TOP)->with(ERROR_MESSAGE, DELETE_FAILED_MESSAGE);
        }
    }

    /**
     * getパラメーター制御
     *
     * @return abort
     */
    public function getControl() 
    {
        return abort(404);
    }

}
