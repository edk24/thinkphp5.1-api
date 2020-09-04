<?php
/**
 * 响应JSON
 *
 * @param [type] $code
 * @param string $msg
 * @return void
 */
function retMsg($code, $msg = 'success')
{
    header("Access-Control-Allow-Origin:*");
    header('Access-Control-Allow-Methods:POST,GET,PUT,DELETE');
    header('Content-Type:application/json; charset=utf-8');
    echo json_encode(['code' => $code, 'msg' => $msg]);
    exit;
}

/**
 * 响应JSON操作成功
 *
 * @param [type] $msg
 * @return void
 */
function success($msg = null)
{
    retMsg(0, ($msg ?? 'success'));
}

/**
 * 响应JSON操作失败
 *
 * @param [type] $msg
 * @return void
 */
function error($msg = null)
{
    retMsg(400, ($msg ?? 'error'));
}

/**
 * 响应数据
 *
 * @param [type] $data 数据
 * @param integer $count 记录总数
 * @param string $msg 提示文本
 * @return void
 */
function retData($data = null, $count = 0, $msg = 'success')
{
    header("Access-Control-Allow-Origin:*");
    header('Access-Control-Allow-Methods:POST,GET,PUT,DELETE');
    header('Content-Type:application/json; charset=utf-8');
    echo json_encode(['code' => 0, 'data' => $data, 'count' => $count, 'msg' => $msg]);
    exit;
}

/**
 * 是否为支付宝内置浏览器
 *
 * @return boolean
 */
function is_alipay_broswer()
{
    $ua = $_SERVER['HTTP_USER_AGENT'];
    return (stripos($ua, 'AlipayClient') ? true : false);
}

/**
 * 是否为微信内置浏览器
 *
 * @return boolean
 */
function is_wechat_broswer()
{
    $ua = $_SERVER['HTTP_USER_AGENT'];
    return (stripos($ua, 'MicroMessenger') ? true : false);
}

/**
 * 创建多级目录
 *
 * @param [type] $dir 目录
 * @param integer $mode 权限
 * @return void
 */
function mkdirs($dir, $mode = 0777)
{
    if (is_dir($dir) || mkdir($dir, $mode, true)) {
        return true;
    }

    if (!mkdirs(dirname($dir), $mode)) {
        return false;
    }

    return mkdir($dir, $mode, true);
}

/**
 * 生成订单编号
 *
 * @return string
 */
function get_order_sn()
{
    // 20200514110001
    return date('YmdHi') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
}
