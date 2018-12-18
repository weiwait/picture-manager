<?php

namespace App\Http\Controllers\Api;

use EasyWeChatComposer\EasyWeChat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $app = app('wechat.mini_program');
        $res = $app->auth->session($request->code);
        return response()->json(['data' => $res]);
    }
}
