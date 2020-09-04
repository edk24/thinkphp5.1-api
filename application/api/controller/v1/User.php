<?php

namespace app\api\controller\v1;

use app\api\model\Users;
use app\api\model\UserToken;
use app\api\utils\Jwt;
use think\Controller;
use think\Request;

class User extends Controller
{
    protected function signToken(Users $user) {
        $payload = [
            'iss' => 'lrz', // 签发者
            'iat' => time(), // 签发时间
            'exp' => time()+7200, // 过期时间
            'sub' => $user->id, // 面向用户
            'jti' => md5(uniqid('JWT').time()), // 唯一id
          ];
          $jwt = new Jwt();
          $token = $jwt->getToken($payload);
        return $token;
    }

    /**
     * 用户登录
     *
     * @param string $phone
     * @param string $password 密码示例: md5(密码 + 'woc')
     * @return void
     */
    public function login($phone, $password) {
        $user = Users::get(['phone' => $phone]);
        if (!$user) 
            error('用户不存在!');

        if ($user->password != $password)
            error('密码错误, 请检查后再登录');
        
        
       retData($this->signToken($user));
    }

    /**
     * 登录-微信
     *
     * @param string $token openId 或 unionId (推荐后者, 可跨小程序/公众号/APP通用)
     * @return void
     */
    public function loginByWechat($token) {
        $token = UserToken::with('user')->get(['token' => $token, 'type'=>'wechat']);
        if (!$token)
            error('登录失败, 用户不存在');
        
        if (!$token->user)
            error('登录失败, 用户不存在');

        retData($this->signToken($token->user));
    }

    /**
     * 登录-支付宝
     *
     * @param string $token
     * @return void
     */
    public function loginByAlipay($token) {
        $token = UserToken::with('user')->get(['token' => $token, 'type'=>'alipay']);
        if (!$token)
            error('登录失败, 用户不存在');
        
        if (!$token->user)
            error('登录失败, 用户不存在');

        retData($this->signToken($token->user));
    }


    /**
     * 查询用户信息
     *
     * @param Request $req
     * @return void
     */
    public function get(Request $req) {
        $user = Users::get($req->user_id);
        retData($user);
    }
}
