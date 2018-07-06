<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\26 0026
 * Time: 16:12
 */

namespace AppBundle\Controller;



use AppBundle\Entity\Cart;
use AppBundle\Entity\Coupon;
use AppBundle\Entity\Goods;
use AppBundle\Entity\Product;
use AppBundle\Entity\SingleStrade;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class AddressController
 * @package AppBundle\Controller
 * @Route("/trade")
 */
class TradeController extends Controller
{
    /**
     * @Route("/show/{id}",name="view_trade",defaults={"id":0})
     */
    public function viewAction(Goods $trade){
        if(!$trade){
            throw $this->createNotFoundException('没有此订单');
        }
        $this->denyAccessUnlessGranted('show',$trade,'你无权查看此订单');

        return $this->render('trade/show.html.twig',[
            'trade' => $trade,
        ]);
    }

    /**
     * @Route("/create", name="new_trade")
     */
    public function createAction(Request $request){
        $user = $this->getUser();
        if(!$request->isXmlHttpRequest() || !($user instanceof User)){
            return new JsonResponse(['msg'=>'请求发生错误!']);
        }
        $data = $request->request->all();
        $em = $this->getDoctrine()->getManager();
        $carts = $data['cart_id'];
        $trade = new Goods();
        $subject = [];
        $amount = 0;
        if(is_array($carts)){
            $index=0;
            foreach ($carts as $cart_id){
                $cart = $em->getRepository(Cart::class)->find($cart_id);
                if(!$cart instanceof Cart){
                    throw $this->createNotFoundException("没有你购买的商品");
                }
                $cart->setAmount($data['number'][$index]);
                $tradeData = $this->createSingleTrade($cart);
                $trade->setGoodsDetail($tradeData['singleStrade']);
                $trade->setDescription($data['remarks']);
                //设置总金额
                $amount += $tradeData['amount'];
                $index++;
            }
        }else{
            $cart = $em->getRepository(Cart::class)->find($carts);
            if(!$cart instanceof Cart){
                throw $this->createNotFoundException("没有你购买的商品");
            }
            $cart->setAmount($data['number']);
            $tradeData = $this->createSingleTrade($cart);
            $trade->setGoodsDetail($tradeData['singleStrade']);
            $trade->setDescription($data['remarks']);
            //设置总金额
            $amount += $tradeData['amount'];
        }

        $trade->setSubject('在未因购买'.implode(',',$subject));
        $couponEm = $em->getRepository(Coupon::class);
        //判断是否使用优惠券
        if(array_key_exists('use_coupons', $data) && "on" == $data['coupons']){
            $coupon = $couponEm->find($data['coupons']);
            $amount -= $coupon->getAmount();
            if($amount <= 0){
                $amount = 0;
            }
            $coupon->setStatus(Coupon::USED);
            $em->persist($coupon);
            $em->flush();
        }

        $trade->setStatus(Goods::UNPAID);
        $trade->setUser($user);
        $trade->setAddress($user->getDefaultAddress());
        $trade->setTotalAmount($amount);
        if(null != $data['friend_phone'] && preg_match("/^1[34578]{1}\d{9}$/",$data['friend_phone'])){
            $friendEm = $em->getRepository(User::class);
            $friend = $friendEm->findOneBy(array('phone'=>$data['friend_phone']));
            if (!empty($friend)){
                $trade->setGiveTo($friend);
                $trade->setAddress($friend->getDefaultAddress());
                $user->setFriend($friend);
            }
        }
        $em->persist($trade);
        $em->flush();

        return new JsonResponse([
            'url'=>$this->generateUrl('view_trade',['id'=>$trade->getId()], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);
    }

    /**
     * @Route("/list", name="trade_list")
     */
    public function tradeListAction(){
        $em = $this->getDoctrine()->getManager();
        $trades = $em->getRepository(Goods::class)->findBy(array('user'=>$this->getUser()->getId()));
        return $this->render('member/trade_list.html.twig',[
            'trades' => $trades
        ]);
    }

    public function createSingleTrade(Cart $cart){
        $product = $cart->getProduct();
        $amount = 0;
        $msg='';
        $num = $cart->getAmount();
        $em = $this->getDoctrine()->getManager();
        //创建单个订单
        $singleStrade = new SingleStrade();
        $singleStrade->setTradeNo($product->generateTradeNo($num));
        $singleStrade->setProduct($product);
        $singleStrade->setNumber($num);
        $singleStrade->setAmount($product->getPrice() * $num);
        //设置商品销量库存
        //$product->setSales($product->getSales() + $num);
        //$product->setStock($product->getStock() - $num);
        if($product->getStock() - $num <= 0){
            $msg = '库存不足';
        }
        //设置订单标题
        $subject[] = $product->getTitle();
        //设置总金额
        $amount += $product->getPrice() * $num;
        //清空购物车
        $em->remove($cart);
        $em->flush();
        return array(
            'singleStrade' => $singleStrade,
            'amount' => $amount,
            'msg' => $msg,
        );
    }


}