<?php

namespace app\http\middleware;

use app\api\utils\Jwt;
use Exception;

class Login
{
    public function handle($request, \Closure $next)
    {
        $AUTHORIZATION = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
        if ($AUTHORIZATION==null)
            error('没有权限操作');

        $token = str_replace('Bearer ', '', $AUTHORIZATION);
        $jwt = new Jwt();
        try {
            $payload = $jwt->verifyToken($token);
            $request->user_id = $payload['sub'];

        } catch (Exception $e) {
            retMsg(5008, $e->getMessage());            
        }
        
        return $next($request);
    }
}
