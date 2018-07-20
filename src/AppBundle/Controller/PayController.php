<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\4\21 0021
 * Time: 10:33
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Goods;
use AppBundle\Event\TradeEvents;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\GenericEvent;
use Yansongda\Pay\Exceptions\Exception;
use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PayController extends Controller
{


    protected $config;


    /**
     * @Route("/alipay/pay/{id}",name="pay")
     */
    public function indexAction(Goods $trade)
    {
       /* $em = $this->getDoctrine()->getManager();
        $trade = $em->getRepository(Goods::class)->find($id);*/
       $this->getConfig();
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
        $this->getConfig();
        $data = Pay::alipay($this->config)->verify(); // 是的，验签就这么简单！

        $stradeNo = $data->out_trade_no;
        $em = $this->getDoctrine()->getManager();
        $trade = $em->getRepository(Goods::class)->findOneBy(array('tradeNo'=>$stradeNo));

        $arguments = [
            'em' => $this->getDoctrine()->getManager(),
            'entity' => $trade,
        ];
        $event = new GenericEvent($trade,$arguments);
        $this->get('event_dispatcher')->dispatch(TradeEvents::PRE_PAID,$event);
        $trade->setPayNo($data->trade_no);
        $em->persist($trade);
        $em->flush();

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
        $this->getConfig();
        $alipay = Pay::alipay($this->config);

        try{
            $data = $alipay->verify(); // 是的，验签就这么简单！

            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况

            if($data->trade_status != 'TRADE_SUCCESS' || $data->trade_status != 'TRADE_FINISHED'){
                throw new Exception('支付订单不成功');
            }
            $stradeNo = $data->out_trade_no;
            $em = $this->getDoctrine()->getManager();
            $trade = $em->getRepository(Goods::class)->findOneBy(array('tradeNo'=>$stradeNo));
            if(!$trade instanceof Goods){
                throw new Exception('没有该订单');
            }
            if($data->total_amount != $trade->getTotalAmount()){
                throw new Exception('订单金额不对');
            }
            if($data->app_id != $this->config['app_id']){
                throw new Exception('商家信息不对');
            }
            $arguments = [
                'em' => $this->getDoctrine()->getManager(),
                'entity' => $trade,
            ];
            $event = new GenericEvent($trade,$arguments);
            $this->get('event_dispatcher')->dispatch(TradeEvents::PRE_PAID,$event);
            //$trade->setStatus(Goods::PAID);
            $trade->setPayNo($data->trade_no);
            $em->persist($trade);
            $em->flush();

            Log::debug('Alipay notify', $data->all());
        } catch (Exception $e) {
             $e->getMessage();
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
        return false;
    }


    public function getConfig(){
        $this->config = $this->getParameter('alipay_config');
    }

}