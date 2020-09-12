<?php
/**
 * 路由
 */

use app\http\middleware\Login;
use think\facade\Route;

Route::get('/', function(){
    return 'hello!';
});

// v1版本
Route::group('v1', function(){
    // token
    Route::POST('token','api/token/token'); // POST v1/token
    Route::post('token/refresh','api/token/refresh');  // POST v1/token/refresh

    // RESTful 资源路由  https://www.kancloud.cn/manual/thinkphp6_0/1037501 了解一下
});


