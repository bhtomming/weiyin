<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\4\30 0030
 * Time: 14:18
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Goods;
use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
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
        $products = $em->getRepository(Product::class)->findBy(['category'=>$category_id]);

        return $this->render('default/product_list.html.twig',['products'=>$products]);
    }

    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function showAction(Product $product){
        $form = $this->createFormBuilder()
            ->add('num',IntegerType::class,array(
                'label'=>'数量:',
                'data'=>1,
            ))
            ->getForm();
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
        $goods = $session->get('gwc');
        $em = $this->getDoctrine()->getManager()->getRepository(Product::class);
        $amount = 0;
        $msg = '';
        if(!$goods){
            $msg = '你还没有添加任何物品，请返回';
        }else{
            foreach ($goods as $good){
                $index = array_search($good,$goods);
                $good['product'] = $em->find($good['id']);
                $good['amount'] = $good['product']->getPrice() * $good['num'];
                $amount += $good['amount'];
                $goods[$index] = $good;
            }
        }

        //$data = $session->get('gwc');
        return $this->render('default/car_view.html.twig',[
            'clothes' => $goods,
            'total_amount' => $amount,
            'msg' => $msg,
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
     * @Route("/trade/create/",name="create_trade")
     */
    public function createTradeAction(Request $request){

        $session = $request->getSession();
        $goods = $session->get('gwc');
        $em = $this->getDoctrine()->getManager();
        $amount = 0;
        $trade = new Goods();
        $trade->setSubject('在未因购买衣服');
        $product = $em->getRepository(Product::class);
        foreach ($goods as $good){
            $index = array_search($good,$goods);
            $good['product'] = $product->find($good['id']);
            $good['amount'] = $good['product']->getPrice() * $good['num'];
            $amount += $good['amount'];
            $goods[$index] = $good;
            $trade->setGoodsDetail($good['product']);
        }
        $trade->setStatus(1);
        $trade->setNumber(1);
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