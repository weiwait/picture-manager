<?php

namespace App\Http\Controllers\Api;


use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PassportController extends Controller
{
    public function login(Request $request)
    {
        $app = app('wechat.mini_program');
        $res = $app->auth->session($request->code);

        if (!$user = User::whereOpenid([$res['openid']])->first()) {
            $user = new User();
            $user->openid = $res['openid'];
        }

        $accessToken = $user->createToken('api')->accessToken;
        $user->access_token = $accessToken;
        $user->session_key = $res['session_key'];
        $user->updated_at = now();
        $user->save();

        return response()->json(['access_token' => 'Bearer' .  $res]);
    }
}
