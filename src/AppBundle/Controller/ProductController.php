<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\4\30 0030
 * Time: 14:18
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        return $this->render('default/product_show.html.twig',['product'=>$product]);
    }
}