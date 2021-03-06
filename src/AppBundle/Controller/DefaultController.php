<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Entity\Company;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Menu;
use AppBundle\Entity\Product;
use AppBundle\Entity\Region;
use AppBundle\Entity\Settings;
use AppBundle\Entity\Swipper;
use AppBundle\Entity\User;
use AppBundle\Form\Type\AddressType;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $region = $this->getRegion($em);
        $swipers = $this->getSwiper($em);
        $products = $this->getProduct($em);

        return $this->render('default/index.html.twig', [
            'region' => $region,
            'swipers' => $swipers,
            'products' => $products,
        ]);
    }

    /**
     * @Route("/brand", name="brand")
     */
    public function brandAction(){
        $em = $this->getDoctrine()->getManager();
        $brand = $em->getRepository(Company::class)->findOneBy(['id'=>1]);
        return $this->render('default/brand.html.twig',['brand' => $brand]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(){
        $em = $this->getDoctrine()->getManager();
        $contact = $em->getRepository(Contact::class)->findOneBy(['id'=>1]);
        return $this->render('default/contact.html.twig',['contact' => $contact]);
    }

    /**
     * @Route("/user/query", name="userQuery")
     */
    public function queryUser(Request $request){
        $data = array('used' => false);
        if(!$request->isXmlHttpRequest()){
            return new JsonResponse(['msg'=>0,'member'=>0]);
        }
        $phone = $request->request->has('phone') ? $request->request->get('phone') : '';
        $userName = $request->request->has('name') ? $request->request->get('name') : '';
        if($phone){
            if(!preg_match("/^1[34578]{1}\d{9}$/",$phone)){
                $data['msg'] = '无效手机号码';
                return new JsonResponse($data);
            }
        }
        $em = $this->getDoctrine()->getManager();
        $field = $userName ? 'username' : 'phone';
        $value = $userName ? $userName : $phone;
        $member = $em->getRepository(User::class)->findOneBy(array(
            $field => $value,
        ));
        if($member instanceof User){
            $data['used'] = true;
            return new JsonResponse($data);
        }
        return new JsonResponse($data);
    }


    /**
     * 显示网站菜单
     */
    public function menuAction(){
        $em = $this->getDoctrine()->getManager();
        $menu =  $this->getMenu($em);
        return $this->render('default/menu.html.twig',['menus' => $menu]);
    }

    /**
     * 显示网站页脚信息
     *
     */
    public function footerAction(){
        $em = $this->getDoctrine()->getManager();
        $settings = $em->getRepository(Settings::class)->find(1);
        return $this->render('default/footer.html.twig',['settings' => $settings]);
    }

    public function getMenu(ObjectManager $em){
        /*$menus = $em->getRepository(Menu::class)->findBy(array(
            'parentMenu' => 2,
        ));*/
        $menus = $em->getRepository(Menu::class)->findAll();
        $parentMenus = [];
        if($menus == null){
            return null;
        }
        foreach ($menus as $menu){
            if(null == $menu->getParentMenu()){
                $id = $menu->getId();
                $parentMenus[$id][] = $menu;
                $parentMenus[$id]['submenu'] = [];
            }else{
                $pid = $menu->getParentMenu()->getId();
                $parentMenus[$pid]['submenu'][] = $menu;
            }
        }
        return $parentMenus;
    }

    public function getRegion(ObjectManager $em){
        return $em->getRepository(Region::class)->findOneBy(['id'=>1]);
    }

    public function getSwiper(ObjectManager $em){
        return $em->getRepository(Swipper::class)->findAll();
    }

    public function getProduct(ObjectManager $em){

        $products = $em->getRepository(Product::class)->findMax(4,['updatedAt','desc']);

        return $products;
    }






}
