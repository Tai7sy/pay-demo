<?php

/**
 * Class PayApi
 * 这里可以是你系统内部封装的支付类, 这里是个简单的封装例子
 */
class PayApi
{
    //异步通知页面需要隐藏防止CC之类的验证导致返回失败
    private $url_notify = '';
    private $url_return = '';

    public function __construct()
    {
        $base = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://{$_SERVER['HTTP_HOST']}";
        $this->url_notify = $base . '/api/fakala/notify.php';
        $this->url_return = $base . '/api/fakala/return.php';
    }

    /**
     * @param array $options 商户配置
     * @param string $out_trade_no 商户系统内订单号
     * @param string $subject 商品名称
     * @param int $amount_cent
     * @throws \Exception
     */
    function goPay($options, $out_trade_no, $subject, $amount_cent)
    {
        include_once 'fakala/sdk.php';
        $config = require 'fakala/config.php';
        $api = new \fakala($config['gateway'], $config['api_id'], $config['api_key']);
        $payway = strtolower($options['payway']);
        $api->goPay($payway, $subject, $out_trade_no, 0, $amount_cent, '', $this->url_return, $this->url_notify);
    }

    function verify($options, $successCallback)
    {
        $isNotify = isset($options['isNotify']) && $options['isNotify'];
        include_once 'fakala/sdk.php';
        $config = require 'fakala/config.php';
        $api = new \fakala($config['gateway'], $config['api_id'], $config['api_key']);

        if (isset($options['out_trade_no'])) {
            $order = $api->get_order($options['out_trade_no']);
            $result = @$order['status'] === 2;
            $out_trade_no = @$order['api_out_no'];  // 本系统订单号
            $total_fee = @$order['paid'];
            $fakala_no = @$order['order_no']; // API渠道订单号

        } else {
            if ($isNotify) {
                $result = $api->notify_verify();
            } else {
                $result = $api->return_verify();
            }
            $out_trade_no = $_REQUEST['out_trade_no'];  // 本系统订单号
            $total_fee = $_REQUEST['total_fee'];
            $fakala_no = $_REQUEST['order_no']; // API渠道订单号
        }

        if ($result) {
            $successCallback($out_trade_no, $total_fee, $fakala_no);
        }
        return $result;
    }
}