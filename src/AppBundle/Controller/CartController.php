<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\6\26 0026
 * Time: 17:27
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Cart;
use AppBundle\Entity\Coupon;
use AppBundle\Entity\Product;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\SecurityBundle\Tests\Functional\Bundle\AclBundle\Entity\Car;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

/**
 * Class AddressController
 * @package AppBundle\Controller
 * @Route("/cart")
 */
class CartController extends Controller
{
    private $tokenManager;

    public function __construct(CsrfTokenManagerInterface $tokenManager)
    {
        $this->tokenManager = $tokenManager;
    }

    /**
     * @Route("/show",name="view_car")
     */
    public function showAction(){
        $user = $this->getUser();
        if(!$user instanceof User){
            throw $this->createAccessDeniedException('你未登录,请先登录!');
        }
        $em = $this->getDoctrine()->getManager();
        $carts = $em->getRepository(Cart::class)->findBy(['user'=>$user]);
        if(empty($carts)){
            return $this->render('default/car_view.html.twig',array());
        }
        $coupons = $em->getRepository(Coupon::class)->findCanUse($user->getId());

        $csrfToken = $this->tokenManager
            ? $this->tokenManager->getToken('authenticate')->getValue()
            : null;
        return $this->render('default/car_view.html.twig',array(
            'carts' => $carts,
            'coupons' => $coupons,
            'csrf_token' => $csrfToken,
        ));
    }

    /**
     * @Route("/add",name="cart_add")
     */
    public function addAction(Request $request){
        $reData = array(
            'status' => 401,
        );
        if(!$request->isXmlHttpRequest()){
            return new JsonResponse($reData);
        }
        $user = $this->getUser();
        if(!$user instanceof User){
            return new JsonResponse($reData);
        }
        $data = $request->request->all();
        if(!preg_match('/[0-9]/',$data['id']) || !preg_match('/[0-9]/',$data['num'])){
            return new JsonResponse($reData['status'] = 'unmatch');
        }
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class)->find($data['id']);
        if(!$product instanceof Product){
            return new JsonResponse($reData['status'] = 'unfind');
        }
        $cart = current($em->getRepository(Cart::class)->findBy(['user'=>$user,'product'=>$data['id']]));
        if(!($cart instanceof Cart)){
            $cart = new Cart();
            $cart->setUser($user);
        }
        $reData['msg'] = '添加商品成功';
        $reData['status'] = 200;
        $p_num = $product->getStock();
        if($p_num < 10){
            $reData['msg'] .= ',该商品库存紧张!';
            $reData['status'] = 'nervous';
        }
        if($data['num'] >= $p_num){
            $reData['msg'] .= ',但该商品数量不足，最多只能提供'.$p_num.'件。';
            $data['num'] = $p_num;
            $reData['status'] = 'insufficient';
        }
        $cart->setProduct($product);
        $cart->setAmount($data['num']);
        $em->persist($cart);
        $em->flush();
        return new JsonResponse($reData);
    }

    /**
     * @Route("/new",name="cart_new")
     */
    public function newAction(){
        $cart = new Cart();
    }



    /**
     * @Route("/delete",name="cart_delete")
     */
    public function deleteAction(Request $request){
        if(!$request->isXmlHttpRequest()){
            return new JsonResponse(['msg'=>'发生错误']);
        }
        $data = $request->request->all();
        $em = $this->getDoctrine()->getManager();
        $cart = $em->getRepository(Cart::class)->find($data['id']);
        if(!$cart instanceof Cart){
            return new JsonResponse(['msg'=>'没有你选择的商品']);
        }
        $em->remove($cart);
        $em->flush();
        return new JsonResponse([
            'msg'=>'删除成功',
        ]);
    }

    /**
     * @Route("/friend/quire",name="friend_quire")
     */
    public function quireFriendAction(Request $request){
        if(!$request->isXmlHttpRequest()){
            return new JsonResponse(['msg'=>0,'member'=>0]);
        }
        $phoneData = $request->request->all();
        $phone = $phoneData['phone'];
        $data = array(
            'msg' => '有效会员用户',
            'member' => false,
        );
        if(!preg_match("/^1[34578]{1}\d{9}$/",$phone)){
            $data['msg'] = '无效手机号码';
            return new JsonResponse($data);
        }
        $em = $this->getDoctrine()->getManager();
        $member = $em->getRepository(User::class)->findOneBy(array(
            'phone' => $phone,
        ));
        if(empty($member)){
            $data['msg'] = '不是会员用户';
            return new JsonResponse($data);
        }
        $data['member'] = true;
        return new JsonResponse($data);
    }

}