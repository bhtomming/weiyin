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
use AppBundle\Form\Type\NumberType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/product_list/{category}", name="product_list")
     */
    public function listAction($category){
        $em = $this->getDoctrine()->getManager();
        $category_id = $em->getRepository(Category::class)->findBy(['name'=>$category]);
        $products = $em->getRepository(Product::class)->findBy(['category'=>$category_id]);

        return $this->render('default/product_list.html.twig',['products'=>$products]);
    }

    /**
     * @Route("/product/{id}", name="product_show")
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
        /*$session->remove('gwc');
        $session->clear();*/
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
            ->add('submit',SubmitType::class,array(
                'label'=>'结算',
                'attr' => array(
                    'class' => 'btn btn-warning'
                ),
            ))->getForm();
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $coupons = $em->getRepository(Coupon::class)->findBy([
                'owner'=>$this->getUser()->getId(),
                'status' => Coupon::UNUSE,
            ]);
            $chioces = [];
            if(!empty($coupons)){
                foreach ($coupons as $coupon ){
                    $chioces[$coupon->getCouponNo()] = $coupon->getId();
                }
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
            $couponId = '';
            if(!empty($data) && $data['use_coupons']){
                $couponId = $data['coupons'];
            }
            return $this->redirectToRoute('create_trade',array('couponId'=>$couponId));
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
     * @Route("/trade/create/{couponId}",name="create_trade",defaults={"couponId":null})
     */
    public function createTradeAction($couponId,Request $request){

        $session = $request->getSession();
        $goods = $session->get('gwc');
        $em = $this->getDoctrine()->getManager();
        $amount = 0;
        $trade = new Goods();
        $trade->setSubject('在未因购买衣服');
        $productEm = $em->getRepository(Product::class);
        $couponEm = $em->getRepository(Coupon::class);

        foreach ($goods as $good){
            $index = array_search($good,$goods);
            $singleStrade = new SingleStrade();
            $good['product'] = $product = $productEm->find($good['id']);
            $good['amount'] = $product->getPrice() * $good['num'];
            $amount += $good['amount'];
            $product->setSales($product->getSales() + 1);
            $singleStrade->setProduct($product);
            $singleStrade->setNumber($good['num']);
            $singleStrade->setAmount($good['amount']);
            $goods[$index] = $good;
            $trade->setGoodsDetail($singleStrade);
        }
        if(null != $couponId){
            $coupon = $couponEm->find($couponId);
            $amount -= $coupon->getAmount();
            if($amount <= 0){
                $amount = 0;
            }
            $coupon->setStatus(Coupon::USED);
            $em->persist($coupon);
            $em->flush();
        }
        $trade->setStatus(Goods::UNPAID);
        $trade->setUser($this->getUser());
        $trade->setTotalAmount($amount);
        $em->persist($trade);
        $em->flush();

        $session->remove('gwc');

        return $this->render('default/trade_create.html.twig',[
            'clothes' => $goods,
            'total_amount' => $amount,
            'trade' => $trade,
        ]);
    }

}