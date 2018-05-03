<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\4\21 0021
 * Time: 10:33
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Goods;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PayController extends Controller
{
    protected $config = [
        'app_id' => '2016091600521407',
        'notify_url' => 'http://www.weiyin.com/app_dev.php/notify.php',
        'return_url' => 'http://www.weiyin.com/app_dev.php/return.php',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAkrBKkAaXSMcAMIe/C/AmpCdcDBQ9U9pcEST3DqZxngtTYbTBC7SY/hlnnRQj9VNK07yiXN+cv/kzAcEy2ouBBFlL9VrO0LJ8hsz24TUVEVgn027uP0E0eNqSq+8Myo3/ALRvdKZ6MYWHuBcRFst8NN2OhVYMV9Q8HoXb0mYMLpUJQEIphM0R8dPhPAQH6eBqxz13F2iKE30jMy9n3DGfoRxYBTeh06Dffm7Cchn05XNgrLj/dCA0mtVphlVz9WvFPQXt7gXXiEECBFMHYC3RSnEouFtswfmu82BdUKc6P/NgwtCLFmqv/ohffpjJClySliOVauvdeFuw/NxFByNBqQIDAQAB',
        // 加密方式： **RSA2**
        'private_key' => 'MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC2482fQtgwl5lF8vqvXPZq5fkhmnnLfrQybniyn9zk5EiOhMiCm9V73twRP3PhVT/ZWowyVkRhYuHU25rbidgdM3awdmS6BE5G3Dysx3H2Zn7xXJH11kJGrolM93B/VueuoEnnwlxILX4OLNSkP6mwtRfDcYh1BLR/Qna2wY2tFyRMun4OeMxw3sEogAsR+Jhbum476DejEUvPiGQyzLUlnMUQUP05ZHT1tE2mgdjPa0zqEW9S/aMEC9T+Hdwr8MUFBMxLzVFdRfEtaEscoMuNIxrENpXVPUIJiYul11JpF+IId8vbK0OHy686VrMm0MAlHBQoy1lye+CWZTAm0LQXAgMBAAECggEAf7aij1V5bK1gjjU4E5+CQHHpwCqEZLNNGG6GgI4cDgbQGB3nezVhJgghezXpMPB8DscpYblWNP99HkxgXnBq5zFZ764tdqytENSY1jrMfTlj6h4vmxGM5JjbLlEYUQQZ85rhISNbl9eU0EdEEpKWZ9x+BLBSjwzDEp8SEVsmGTkCnqKJGRdmhREo0loC1GIqJPoElSLvQAmkNo8R8/ElgDXCVSNv+MgBFKMe3tZTPSUi9eQ3S4AfI8U7c3IYYpaCQc+ijZPW330I9WMlSTUIbeYs1Zry2G2+M9qUSkusB83VigDJWhm+CPZ0c8xIPLD24+1KTk5FXJ06igxlFoqaOQKBgQDZVYlIQutK5u4Eb65k5kuSd/du7mCzCW7eMjBAWgW5sai07SJM7qTlASdXzNRpAhHDQ34x7JjHJndLzRi+ResqZJBKqc6JPq2burlz9WXoYs1zCkUcXAB6xDES1m5Ee26NG4cvipNqnd7+/3A2PQ4BjV36uLjsXxeC472OuDZbcwKBgQDXbYF10AZmuaP1F+XJJuj1Iq916xv4MjBltDGANiGtc3n4R8z25UhXseTTKGdI1reef6QwIKMUpKZscl/0ksaQFKfVP2WWaUXRNVRj/1bB93HIQtX3oNlwtYwRegsu4PVthEuB/bWZlovbhN/JUDW+e0IJ9NfSXmsWwX1rR2RjzQKBgAikXBchghWyZRiMEFU2yx6B4rboh7PW1i/DsyN78OpXZCv9mfWRL8FjcFsPbArY6DfpgSUfEVwp7Wh4OVmnkhhXc11kry/J7EFbBXDU+z5oX18Js4HTLrmy/3iOSkgy2EyIIbIEQqRkrq9ZHO8rMllhc7E6ky/jAB5WS/1W2eJ9AoGBAKUGwhGaFg1DUJJEiEabhAGlXHwcawSqjeCbNQBed1YEC/9iIWVRJyXmpMANR3HI6kiExyYHGmaJ6uNQiqk0dt+QszDsq8mZQ16MV+VyiOd1wrgCWx6jHW715CLPNxnmQpxup9kgnajWZrT3COeShlkw2tn9sgb5RVfdSVKREhpRAoGBAJvGKNXGdgfeP14g7Vz/A5umQPDNjhdY3LSLcMVxtuBApnLhCgMvEKJYVybF7Q/M23QQimTfEdx+u6ugyODMevuVBhD6eE4HKNIvpkzf6Xrpvu7GqfRq1L9Vatfgq7TeNSdSd5ayJUur3gbY9XT+Vf9poH0jpWQamX6WcQfkshnf',
        'log' => [ // optional
            'file' => './logs/alipay.log',
            'level' => 'debug'
        ],
        'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
    ];

    /**
     * @Route("/alipay/pay/{id}",name="pay")
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $trade = $em->getRepository(Goods::class)->find($id);

        $order = [
            'out_trade_no' => $trade->getTradeNo(),
            'total_amount' => $trade->getTotalAmount(),
            'subject' => $trade->getSubject(),
        ];
        if($this->is_mobile()){
            $alipay = Pay::alipay($this->config)->wap($order);
        }else{
            $alipay = Pay::alipay($this->config)->web($order);
        }
        //$alipay = Pay::alipay($this->config)->web($order);
        return $alipay->send();
    }

    /**
     * @Route("/return.php")
     */
    public function return()
    {
        $data = Pay::alipay($this->config)->verify(); // 是的，验签就这么简单！

        // 订单号：$data->out_trade_no
        // 支付宝交易号：$data->trade_no
        // 订单总金额：$data->total_amount
        return $this->render('alipay/return.html.twig',['data'=>$data]);
    }

    /**
     * @Route("/notify.php")
     */
    public function notify()
    {
        $alipay = Pay::alipay($this->config);

        try{
            $data = $alipay->verify(); // 是的，验签就这么简单！

            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况

            Log::debug('Alipay notify', $data->all());
        } catch (Exception $e) {
            // $e->getMessage();
        }

        return $alipay->success()->send();
    }

    function is_mobile(){
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $is_pc = (strpos($agent, 'windows nt')) ? true : false;
        $is_mac = (strpos($agent, 'mac os')) ? true : false;
        $is_iphone = (strpos($agent, 'iphone')) ? true : false;
        $is_android = (strpos($agent, 'android')) ? true : false;
        $is_ipad = (strpos($agent, 'ipad')) ? true : false;


        if($is_pc){
            return  false;
        }

        if($is_mac){
            return  true;
        }

        if($is_iphone){
            return  true;
        }

        if($is_android){
            return  true;
        }

        if($is_ipad){
            return  true;
        }
    }

}