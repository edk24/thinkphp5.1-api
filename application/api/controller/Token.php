<?php

namespace app\api\controller;

use app\api\utils\Jwt;
use think\Controller;
use think\Request;
use OAuth2;

class Token extends Controller
{
   public function token() {
       $payload = [
         'iss' => 'lrz', // 签发者
         'iat' => time(), // 签发时间
         'exp' => time()+7200, // 过期时间
         'sub' => 'edk24.com', // 面向用户
         'jti' => md5(uniqid('JWT').time()), // 唯一id
       ];
       $jwt = new Jwt();
       $token = $jwt->getToken($payload);
       retData($token);
   }
}
