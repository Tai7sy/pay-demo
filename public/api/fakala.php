<?php

class PayApi
{
    //异步通知页面需要隐藏防止CC之类的验证导致返回失败
    private $url_notify = '';
    private $url_return = '';

    public function __construct()
    {
		$base = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') ."://{$_SERVER['HTTP_HOST']}";
        $this->url_notify = $base. '/api/fakala/notify.php';
        $this->url_return = $base. '/api/fakala/return.php';
    }

    /**
     * @param array $config 商户配置, 例 array('api_id'=>'','api_key'=>'','payway'=>'alipay')
     * @param string $out_trade_no 商户系统内订单号
     * @param string $subject 商品名称
     * @param int $amount_cent
     * @throws \Exception
     */
    function goPay($config, $out_trade_no, $subject, $amount_cent)
    {
        include_once 'fakala/api.php';
        $api = new \fakala();

        $payway = strtolower($config['payway']);

        $api->goPay($payway, $out_trade_no, 0, $amount_cent, '', $this->url_return, $this->url_notify);
    }

    function verify($config, $successCallback)
    {
        $isNotify = isset($config['isNotify']) && $config['isNotify'];
        include_once 'fakala/api.php';
        $api = new \fakala();

        if ($isNotify) {
            $result = $api->notify_verify();
        } else {
            $result = $api->return_verify();
        }

        if ($result) {
            $out_trade_no = $_REQUEST['out_trade_no'];  // 本系统订单号
            $total_fee = $_REQUEST['total_fee'];
            $fakala_no = $_REQUEST['order_no']; // API渠道订单号
            $successCallback($out_trade_no, $total_fee, $fakala_no);
        }
        return false;
    }
}