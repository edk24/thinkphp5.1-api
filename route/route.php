<?php
/**
 * 路由
 */

use app\http\middleware\Login;
use think\facade\Route;

// v1版本
Route::group('v1', function(){
    Route::get('x', 'index/index/index');
    // token
    Route::POST('token','api/token/token'); // POST v1/token
    Route::post('token/refresh','api/token/refresh');  // POST v1/token/refresh

    // RESTful 资源路由  https://www.kancloud.cn/manual/thinkphp6_0/1037501 了解一下
    Route::post('user/login', 'api/v1.user/login');
    Route::post('user/loginByWechat', 'api/v1.user/loginByWechat');
    Route::post('user/loginByAlipay', 'api/v1.user/loginByAlipay');

    Route::group('user', function(){
        Route::get('get', 'api/v1.user/get');
    })->middleware(Login::class);
    
});


