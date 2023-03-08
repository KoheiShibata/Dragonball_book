<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * ログインフォームをHTMLにて出力
     *
     * @return HTML
     */
    public function loginForm()
    {
        // ログイン情報が存在する場合はキャラクター管理画面へ
        if (session()->has("admin")) {
            return redirect(("/characters"));
        }

        return view("login.index");
    }

    /**
     * ログイン判定
     *
     * @param Request $request
     * @return redirect
     */
    public function loginJudge(Request $request)
    {
        $params = $request->validate(config("validations.login"));

        try {
            if (!AdminUser::isMailExists($params["email"])) {
                throw new \Exception();
            }

            $adminUserData = AdminUser::fetchAdminUserByMail($params["email"]);
            if (!password_verify($params["password"], $adminUserData->password)) {
                throw new \Exception();
            }

            session()->put("admin", $adminUserData->id);
            return redirect("/characters");

        } catch (Exception $e) {
            return redirect("/login")->with(ERROR_MESSAGE, LOGIN_FAILED_MESSAGE);
        }
    }
}
