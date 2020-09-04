<?php

namespace app\api\model;

use think\Model;
use think\model\concern\SoftDelete;

class Users extends Model
{
    use SoftDelete;
    //

    // 头像获取器
    public function getAvatarAttr($avatar) {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        return preg_replace('/^\//', $protocol.$_SERVER['HTTP_HOST'].'/', $avatar);
    }
}
