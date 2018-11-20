<?php
$payStatus=isset($_GET['status'])?$_GET['status']:'';
if($payStatus=='') { die('Insufficient Permissions'); }

$msg=isset($_GET['msg'])?htmlspecialchars($_GET['msg']):'';
if($payStatus == 0){//支付成功
    $btnUrl = 'index.html';
    $btnTitle ='返回';
    $payRet='success';
    $info='恭喜您，支付成功';
}else{
    $btnUrl = 'index.html';
    $btnTitle ='返回';
    $payRet='fail';

    if($payStatus==1)
        $info='订单信息错误:'.$msg;
    else if($payStatus==2)
        $info='充值类型错误:'.$msg;
    else if($payStatus==3)
        $info='订单金额错误:'.$msg;
    else if($payStatus==10)
        $info='订单状态:'.$msg;
    else if($payStatus==11)
        $info='签名验证失败';
    else
        $info='未知充值错误:'.$msg;
}
?>
<!DOCTYPE html><html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" name="viewport">
    <title>支付结果</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="renderer" content="webkit">

    <!-- Font Awesome -->
    <link type="text/css" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">body { font-family:"微软雅黑","Microsoft YaHei";background: #eee; }</style>

</head>
<body class="infobar-offcanvas nano">
<div class ="nano-content">
    <style>
        .container{
            margin-top:2%;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <img src="assets/images/<?php echo $payRet?>.png" style="float:right">
                            </div>

                            <div class="col-sm-10">
                                <h3 class="product-title mt0 mb10"><?php echo $payRet=='fail'?'错误':'成功';?></h3>

                                <p class="mb20"><?php echo $info;?></p>
                                <a href="<?php echo $btnUrl;?>" class="btn btn-primary-alt"><?php echo $btnTitle;?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
</body>
</html>
