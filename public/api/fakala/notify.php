<?php
require_once('api.php');

$api = new fakala();

$no = $_POST['out_trade_no']; 			// 订单号 (提交支付时传递的当前系统订单号)
$pay_order_no = $_POST['order_no']; 	// 支付系统内订单号
$total_fee = (int)$_POST['total_fee'];	// 支付金额 (单位: 分)
$attach = $_POST['attach'];				// 附加信息


if ($api->notify_verify()) //签名正确
{
    // 此处作逻辑处理
}
exit; // 请不要进行任何输出, 直接退出即可
