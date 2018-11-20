<?php
/**
 * Created by PhpStorm.
 * User: Tai7sy
 * Date: 2017/6/14
 * Time: 21:21
 */

require_once './api/fakala.php';

$payway = isset($_GET['payway']) ? $_GET['payway'] : '';
$amount = isset($_GET['amount']) ? (int)$_GET['amount'] : 0;
if ($payway == '' || $amount == 0) {
    die('<h1>请填写支付信息</h1>');
}
if ($amount < 1) {
    die('<h1>请给多一点吧</h1>');
}

$config = array(
	'payway'=>$payway
);

$orderId = date("YmdHis") . mt_rand(10000, 99999);
(new PayApi())->goPay($config, $orderId, '订单'.$orderId, $amount*100);