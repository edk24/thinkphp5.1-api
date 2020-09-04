<?php

namespace app\api\model;

use think\Model;
use think\model\concern\SoftDelete;

class UserToken extends Model
{
    /**
     * 类型: 微信unionid / openid
     */
    const TYPE_WECHAT = 'wechat';
    /**
     * 类型: 微信jsapi公众号 openid
     */
    const TYPE_WECHAT_JSAPI = 'wechat_jsapi';
    /**
     * 类型: 微信小程序openid
     */
    const TYPE_WECHAT_MINI = 'wechat_mini';
    /**
     * 类型: 支付宝
     */
    const TYPE_ALIPAY = 'alipay';

    use SoftDelete;

    /**
     * token是否存在
     *
     * @param [type] $type 类型常量 UserToken::TYPE_
     * @param [type] $token token值
     * @return boolean
     */
    static function isToken($type, $token) {
        return (self::get(['type'=>$type,'token'=>$token])?true:false);
    }
}
