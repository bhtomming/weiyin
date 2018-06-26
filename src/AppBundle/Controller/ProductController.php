<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\4\30 0030
 * Time: 14:18
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Coupon;
use AppBundle\Entity\Goods;
use AppBundle\Entity\Product;
use AppBundle\Entity\SingleStrade;
use AppBundle\Entity\User;
use AppBundle\Form\Type\NumberType;
use Doctrine\ORM\EntityNotFoundException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @Route("/product_list/{category}", name="product_list")
     */
    public function listAction($category){
        $em = $this->getDoctrine()->getManager();
        $category_id = $em->getRepository(Category::class)->findBy(['name'=>$category]);
        $products = $em->getRepository(Product::class)->findBy(['category'=>$category_id,'selling'=>true]);

        return $this->render('default/product_list.html.twig',['products'=>$products]);
    }

    /**
     * @Route("/product/{id}", name="product_show", requirements={"id": "[1-9]\d*"})
     */
    public function showAction(Product $product){
        $form = $this->createForm(NumberType::class,null,array(
            'attr'=>array(
                'value' => 1,
                'data-id' => $product->getId(),
            ),
            'class' => 'num-'.$product->getId(),
        ));
        return $this->render('default/product_show.html.twig',[
            'product'=>$product,
            'form'=> $form->createView(),
        ]);
    }

    /**
     * @Route("/shopping_car/add/{id}/{num}",name="car",defaults={"num" : 1})
     */
    public function shoppingCarAction($id,$num,Request $request){
        $session = $request->getSession();
        if(!preg_match('/[0-9]/',$id) || !preg_match('/[0-9]/',$num)){
            return new JsonResponse(array('error'=>'数据不正确'));
        }
        $good = array(
            'id'=> $id,
            'num' => $num,
        );
        $goods = [];
        $noGoods = true;
        if($session->has('gwc')){
            $goods = $session->get('gwc');
            for ($i = 0; $i < count($goods); $i++){
                $tmpGood = $goods[$i];
                if ($tmpGood['id'] == $id){
                    $tmpGood['num'] =  $num;
                    $goods[$i] = $tmpGood;
                    $noGoods = false;
                }
            }
        }
        if($noGoods){
            array_push($goods,$good);
        }
        $session->set('gwc',$goods);

        $data=$session->get('gwc');
        return new JsonResponse($data);
    }

    /**
     * @Route("/shopping_car/view/",name="view_car")
     */
    public function viewCarAction(Request $request){

        $session = $request->getSession();
        //$session->remove('gwc');
        $goods = $session->get('gwc');
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(Product::class);
        $amount = 0;
        $msg = '';
        if(!$goods){
            $msg = '你还没有添加任何物品，请返回';
        }else{
            foreach ($goods as $good){
                $index = array_search($good,$goods);
                $good['product'] = $product->find($good['id']);
                $good['amount'] = $good['product']->getPrice() * $good['num'];
                $amount += $good['amount'];
                $form = $this->createForm(NumberType::class,null,array(
                    'attr'=>array(
                        'value' => $good['num'],
                        'data-id' => $good['id'],
                    ),
                    'class' => 'num-'.$good['id'],
                ))
                ;
                $good['form'] = $form->createView();
                $goods[$index] = $good;
            }

        }
        $coupons = '';

        $form = $this->createFormBuilder()
            ->add('friend',null,array(
                'label' => '朋友手机号',
                'required' => false,
            ))
            ->add('check_phone',ButtonType::class,array(
                'label' => '确定',
                'attr' => array(
                    'class' => 'btn btn-primary'
                ),
            ))
            ->add('submit',SubmitType::class,array(
                'label'=>'生成订单',
                'attr' => array(
                    'class' => 'btn btn-warning'
                ),
            ))->getForm();
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $chioces = $em->getRepository(Coupon::class)->findChoices($this->getUser()->getId());
            if(!empty($chioces)){
                $form->add('use_coupons',CheckboxType::class,array(
                    'label'=>'使用优惠券',
                    'required' => false,
                ))
                    ->add('coupons',ChoiceType::class,array(
                        'label' => '优惠券',
                        'choices' =>$chioces,
                    ));
            }

        }

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                return $this->redirectToRoute('fos_user_security_login');
            }
            $tradeId = $this->createTrade($data,$request);
            return $this->redirectToRoute('view_trade',array('id'=>$tradeId));
        }

        return $this->render('default/car_view.html.twig',[
            'clothes' => $goods,
            'total_amount' => $amount,
            'msg' => $msg,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/shopping_car/del/{id}",name="del_car")
     */
    public function delCarAction($id, Request $request){
        $session = $request->getSession();
        $goods = $session->get('gwc');
        for($i=0;$i<count($goods);$i++){
            if($goods[$i]['id'] == $id){
                array_splice($goods,$i,1);
            }
        }
        $session->set('gwc',$goods);
        $data = $session->get('gwc');
        return new JsonResponse($data);
    }



    /**
     * @Route("/friend/quire/{phone}",name="friend_quire",defaults={"phone":null})
     */
    public function quireFriendAction($phone){
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

    //创建订单
    public function createTrade(array $data, Request $request){
        $session = $request->getSession();
        $goods = $session->get('gwc');
        $em = $this->getDoctrine()->getManager();
        $amount = 0;
        $trade = new Goods();
        $subject = [];

        $productEm = $em->getRepository(Product::class);
        $couponEm = $em->getRepository(Coupon::class);

        foreach ($goods as $good){
            $index = array_search($good,$goods);
            $singleStrade = new SingleStrade();
            $good['product'] = $product = $productEm->find($good['id']);
            $good['amount'] = $product->getPrice() * $good['num'];
            $amount += $good['amount'];
            $tradeNo = $product->generateTradeNo($good['num']);
            $product->setSales($product->getSales() + $good['num']);
            $product->setStock($product->getStock() - $good['num']);
            $subject[] = $product->getTitle();
            $singleStrade->setProduct($product);
            $singleStrade->setNumber($good['num']);
            $singleStrade->setAmount($good['amount']);
            $singleStrade->setTradeNo($tradeNo);
            $goods[$index] = $good;
            $trade->setGoodsDetail($singleStrade);
        }
        $trade->setSubject('在未因购买'.implode(',',$subject));
        if(array_key_exists('use_coupons', $data) && null != $data['coupons']){
            $coupon = $couponEm->find($data['coupons']);
            $amount -= $coupon->getAmount();
            if($amount <= 0){
                $amount = 0;
            }
            $coupon->setStatus(Coupon::USED);
            $em->persist($coupon);
            $em->flush();
        }
        $user = $this->getUser();
        $trade->setStatus(Goods::UNPAID);
        $trade->setUser($user);
        $trade->setAddress($user->getDefaultAddress());
        $trade->setTotalAmount($amount);
        if(null != $data['friend'] && preg_match("/^1[34578]{1}\d{9}$/",$data['friend'])){
            $friendEm = $em->getRepository(User::class);
            $friend = $friendEm->findOneBy(array('phone'=>$data['friend']));
            if (!empty($friend)){
                $trade->setGiveTo($friend);
                $trade->setAddress($friend->getDefaultAddress());
                $user->setFriend($friend);
            }
        }
        $em->persist($trade);
        $em->flush();

        $session->remove('gwc');
        return $trade->getId();
    }

}