<?php
/**
 * Created by PhpStorm.
 * User: Tai7sy
 * Date: 2017/6/14
 * Time: 21:21
 */


$payway = isset($_GET['payway']) ? $_GET['payway'] : '';
$amount = isset($_GET['amount']) ? (float)$_GET['amount'] : 0;
if ($payway == '' || $amount == 0) {
    die('<h1>请填写支付信息</h1>');
}
if ($amount < 0.01) {
    die('<h1>请给多一点吧</h1>');
}

$config = array(
    'payway' => $payway
);

$orderId = date("YmdHis") . mt_rand(10000, 99999);

try {
    require 'pay.class.php';
    (new PayApi())->goPay($config, $orderId, '订单' . $orderId, $amount * 100);
} catch (Exception $e) {
    echo '<h1>支付失败<br>' . $e->getMessage() . '</h1>';
}
