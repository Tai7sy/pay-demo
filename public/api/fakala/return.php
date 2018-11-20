<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>支付结果</title>
    <?php
    require_once('api.php');
    $api = new fakala();

    $no = $_GET['out_trade_no']; 			// 订单号 (提交支付时传递的当前系统订单号)
    $pay_order_no = $_GET['order_no']; 	// 支付系统内订单号
    $total_fee = (int)$_GET['total_fee'];	// 支付金额 (单位: 分)
    $attach = $_GET['attach'];				// 附加信息

    if ($api->return_verify())//签名正确
    {
        echo '<h1>支付成功，订单号：' . $no . '，金额：￥' . sprintf('%.2f', $total_fee/100) . '</h1>';

    } else {
        echo '<h1>验证失败</h1>';
    }

    ?>
</head>
<body>
</body>
</html>