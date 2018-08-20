<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\4\23 0023
 * Time: 8:51
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Address;
use AppBundle\Entity\Coupon;
use AppBundle\Entity\Goods;
use AppBundle\Entity\Menu;
use AppBundle\Entity\Product;
use AppBundle\Entity\Shape;
use AppBundle\Entity\SingleStrade;
use AppBundle\Entity\User;

use AppBundle\Form\Type\AddressType;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Pagerfanta\Pagerfanta;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends BaseAdminController
{
    /**
     * @Route("/dashboard", name="dashboard")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function dashboardAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $goods = $em->getRepository(Goods::class)->findBy(['adminRead'=>false]);
        if(!$this->isGranted('ROLE_ADMIN')){
            $goods = $em->getRepository(Goods::class)->findProvider($user->getId());
        }

        return $this->render('/default/dashboard.html.twig',array(
            'goods'=>$goods,
        ));
    }


    public function createNewUserEntity(){
        $user = $this->get('fos_user.user_manager')->createUser();
        if(!$user instanceof User){
            return null;
        }
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setEnabled(true);
        return $user;
    }

    public function createNewMemberEntity(){
        $user = $this->get('fos_user.user_manager')->createUser();
        if(!$user instanceof User){
            return null;
        }
        $user->setRoles(array('ROLE_USER'));
        $user->setEnabled(true);
        return $user;
    }

    public function prePersistUserEntity($user){
        $this->get('fos_user.user_manager')->updateUser($user,false);
    }

    public function prePersistMemberEntity($user){
        $this->prePersistUserEntity($user);
    }

    public function prePersistProviderEntity($user){
        $this->prePersistUserEntity($user);
    }

    public function createNewProviderEntity(){
        $user = $this->get('fos_user.user_manager')->createUser();
        if(!$user instanceof User){
            return null;
        }
        $user->setRoles(array('ROLE_Provider'));
        $user->setEnabled(true);
        return $user;
    }

    public function preUpdateProviderEntity($user){
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    public function preUpdateUserEntity($user){
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    public function preUpdateMemberEntity($user){
        $this->prePersistUserEntity($user);
    }

    //个人中心
    public function profileAction(){
        $user = $this->getUser();
        $id = $this->getUser()->getId();
        $referer = $this->request->query->get('referer');
        if(!$referer && !$this->isGranted('ROLE_ADMIN')){
            $referer = $this->generateUrl('dashboard');
        }
        if(!$user instanceof User){
            return null;
        }
        $param = array(
            'id'=>$id,
            'action' => 'edit',
            'entity' => 'Member',
            'referer'=>$referer,
        );
        if ($this->isGranted('ROLE_PROVIDER')){
            $param = array(
                'id'=>$id,
                'action' => 'edit',
                'entity' => 'Provider',
                'referer'=>$referer,
            );
        }
        if($this->isGranted('ROLE_ADMIN')){
            $param = array(
                'id'=>$id,
                'action' => 'edit',
                'entity' => 'User',
                'referer'=>$referer,
            );
        }
        return $this->redirect($this->generateUrl('easyadmin',$param));
    }


    public function persistCouponEntity($coupon){
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN',NULL, '你无权访问');
        if (!($coupon instanceof Coupon)){
            return;
        }
        if($coupon->getCreator() == null){
            $coupon->setCreator($this->getUser());
        }
        parent::persistEntity($coupon);
    }

    public function persistGoodsEntity($goods){
        if(!($goods instanceof Goods)){
            return;
        }
        if($goods->getUser() == null){
            $goods->setUser($this->getUser());
        }
        parent::persistEntity($goods);
    }

    public function persistMenuEntity($menu){
        if(!($menu instanceof Menu)){
            return;
        }
        $parentMenu = $this->getDoctrine()->getManager()->getRepository(Menu::class)->find(2);
        $menu->setParentMenu($parentMenu);
        parent::persistEntity($menu);
    }

    public function createNewEntity()
    {
        $allowEntities = ['Product','Provider_Product'];
        $entity = $this->request->get('entity');
        if(!in_array($entity,$allowEntities)){
            $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN',NULL, '你无权访问');
        }

        return parent::createNewEntity();
    }
    public function addShapeAction(){
        $userId = $this->request->query->get('id');
        $referer = $this->request->query->get('referer');
        return $this->redirect($this->generateUrl('easyadmin',array(
            'action'=>'new',
            'entity'=>'Shape',
            'userId' => $userId,
            'referer' => $referer,
        )));
    }

    public function showssShapeAction(){
        $userId = $this->request->query->get('id');
        //$referer = $this->request->getRequestUri();
        $referer = $this->generateUrl('easyadmin',array('entity'=>'Member','action'=>'edit','id'=>$userId));
        $user =  $this->getDoctrine()->getRepository(User::class)->find($userId);
        $shapes = $user->getShape();
        $shape = $shapes->last();
        if( !($shape instanceof Shape) ){
            return $this->addShapeAction();
        }
        return $this->redirect($this->generateUrl('easyadmin',array(
            'entity' => 'Shape',
            'action' => 'show',
            'id' => $shape->getId(),
            'referer' => $referer,
        )));
    }

    public function createNewShapeEntity(){
        $user = $this->shapeGetUser();
        $shape = new Shape();
        $shape->setUser($user);
        return $shape;
    }

    public function persistShapeEntity($shape){
        $user = $this->shapeGetUser();
        $user->setShape($shape);
        parent::persistEntity($shape);
    }


    public function shapeGetUser(){
        $userId = $this->request->query->get('userId');
        return $this->getDoctrine()->getRepository(User::class)->find($userId);
    }


    public function backtoUserAction(){
        $referer = $this->request->query->get('referer');
        if(!$referer){
            return $this->redirect($this->generateUrl('easyadmin',array('action'=>'list','entity' => 'Member')));
        }
        return $this->redirectToReferrer();

    }


    public function addAddressAction(){
        $userId = $this->request->query->get('id');
        return $this->redirectToRoute('easyadmin',array(
            'entity'=>'Address',
            'userId' => $userId,
            'action'=>'new',
        ));
    }

    public function createNewAddressEntity(){
        $user = $this->shapeGetUser();
        $address = new Address();
        $address->setUser($user);
        return $address;
    }

    public function persistAddressEntity($address){
        $user = $this->shapeGetUser();
        $user->setAddress($address);
        parent::persistEntity($address);
    }

    public function sendAction(){
        $id = $this->request->query->get('id');
        $em = $this->getDoctrine()->getManager();
        $goods = $em->getRepository(Goods::class)->find($id);
        if($goods==null || !($goods instanceof Goods)){
            return $this->redirectToReferrer();
        }
        $goods->setStatus(Goods::SEND_OUT);
        $em->persist($goods);
        $em->flush();
        return $this->redirectToReferrer();
    }

    //商品列表
    public function listProductAction(){
        if(!($this->isGranted('ROLE_ADMIN'))){
            $this->entity['list']['dql_filter'] = 'entity.provider = '.$this->getUser()->getId();
            unset($this->entity['list']['fields']['price']);
        }
        return parent::listAction();
    }



    //订单列表
    public function listGoodsAction(){
        if(!($this->isGranted('ROLE_ADMIN'))){
            unset($this->entity['list']['fields']['totalAmount']);
            unset($this->entity['list']['fields']['user']);
            //$this->entity['list']['dql_filter'] = 'entity.'
        }
        return parent::listAction();
    }

    //已付款订单
    public function paidAction(){
        $this->entity['list']['dql_filter'] = 'entity.status = 1';
        if(!($this->isGranted('ROLE_ADMIN'))){
           unset($this->entity['list']['fields']['totalAmount']);
           unset($this->entity['list']['fields']['user']);
        }
        return  parent::listAction();
    }

    //显示所有订单
    public function showGoodsAction(){
        if(!($this->isGranted('ROLE_ADMIN'))){
            unset($this->entity['show']['fields']['totalAmount']);
            unset($this->entity['show']['fields']['user']);
            unset($this->entity['show']['fields']['subject']);
            unset($this->entity['show']['fields']['address']);
            unset($this->entity['show']['fields']['status']);
        }
        return parent::showAction();
    }

    //未付款订单
    public function unpaidAction(){
        $this->entity['list']['dql_filter'] = 'entity.status = 0';
        if(!($this->isGranted('ROLE_ADMIN'))){
            unset($this->entity['list']['fields']['totalAmount']);
            unset($this->entity['list']['fields']['user']);
        }
        return  parent::listAction();
    }

    //未查阅订单
    public function unreadAction(){
        if($this->isGranted('ROLE_ADMIN')){
            $this->entity['list']['dql_filter'] = 'entity.adminRead = 0';
        }
        return parent::listAction();
    }

    public function createGoodsListQueryBuilder($entityClass, $sortDirection, $sortField = null, $dqlFilter = null){
        if($this->isGranted('ROLE_ADMIN')){
            return parent::createListQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter);
        }
        $query = $this->em->getRepository(Goods::class)->createQueryBuilder('g')
            ->join('g.goodsDetail','d')
            ->join('d.product','p')
            ->where('p.provider = :id')
            ->andWhere('g.status = 1')
            ->setParameter('id',$this->getUser()->getId());
        $action = $this->request->query->get('action');
        if($action == 'unread' && !$this->isGranted('ROLE_ADMIN')){
            $query->andWhere('g.providerRead = false');
        }
        return $query;
    }

    public function whichEntityAction(){
        $entity = $this->isGranted('ROLE_ADMIN') ? 'Product' : 'Provider_Product';
        return $this->redirectToRoute('easyadmin',array(
            'entity'=>$entity,
            'action'=>'list',
        ));
    }

    //商品列表
    public function listProvider_ProductAction(){
        if(!($this->isGranted('ROLE_ADMIN'))){
            $this->entity['list']['dql_filter'] = 'entity.provider = '.$this->getUser()->getId();
        }
        return parent::listAction();
    }

    public function editProvider_ProductAction(){
        $id = $this->request->get('id');
        $product = $this->em->getRepository(Product::class)->find($id);
        if(!($product instanceof Product)){
            throw $this->createNotFoundException('没有该商品');
        }
        if($product->getProvider() != $this->getUser() && !$this->isGranted('ROLE_ADMIN')){
            throw $this->createAccessDeniedException('你无权访问');
        }
        return parent::editAction();
    }

    public function prePersistProvider_ProductEntity($entity)
    {
        if(!$entity instanceof Product){
            return;
        }
        $entity->setProvider($this->getUser());
        parent::prePersistEntity($entity);
    }


}