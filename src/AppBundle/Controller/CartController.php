<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\6\26 0026
 * Time: 17:27
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Cart;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\SecurityBundle\Tests\Functional\Bundle\AclBundle\Entity\Car;

/**
 * Class AddressController
 * @package AppBundle\Controller
 * @Route("/cart")
 */
class CartController extends Controller
{
    /**
     * @Route("/show/{id}",name="cart_show")
     */
    public function showAction(Cart $cart){
        return $this->renderView('default/car_view.html.twig',array(
            'cart' => $cart
        ));
    }

    /**
     * @Route("/add/{id}/{num}",name="cart_add",defaults={"num" : 1},requirements={"id": "[1-9]\d*","num": "[1-9]\d*"})
     */
    public function addAction(){
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $cart = current($em->getRepository(Cart::class)->findBy(['user'=>$user]));
        if(!$cart instanceof Cart){
            $cart = new Car();
        }
        
    }

    /**
     * @Route("/new",name="cart_new")
     */
    public function newAction(){
        $cart = new Cart();
    }

    /**
     * @Route("/edit/{id}",name="cart_edit")
     */
    public function editAction(){

    }

    /**
     * @Route("/delete/{id}",name="cart_delete")
     */
    public function deleteAction(){

    }

}