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
        $user->setEnabled(true);
        return $user;
    }

    public function createNewMemberEntity(){
        return $this->createNewUserEntity();
    }

    public function prePersistUserEntity($user){
        $this->get('fos_user.user_manager')->updateUser($user,false);
    }

    public function prePersistMemberEntity($user){
        $this->prePersistUserEntity($user);
    }

    public function preUpdateUserEntity($user){
        $this->get('fos_user.user_manager')->updateUser($user, false);
    }

    public function preUpdateMemberEntity($user){
        $this->prePersistUserEntity($user);
    }

    //个人中心
    public function profileAction(){
        $id = $this->getUser()->getId();
        $referer = $this->request->query->get('referer');
        if(!$referer && !$this->isGranted('ROLE_ADMIN')){
            $referer = $this->generateUrl('dashboard');
        }
        return $this->redirect($this->generateUrl('easyadmin',array(
            'id'=>$id,
            'action' => 'edit',
            'entity' => $this->entity['name'],
            'profile' => true,
            'referer'=>$referer,
        )));
    }

    public function listUserAction(){
        $urole = $this->request->query->get('urole');
        if('provider' == $urole){
            $this->entity['list']['dql_filter'] = " entity.roles = 'a:1:{i:0;s:13:\"ROLE_PROVIDER\";}'";
        }elseif('member' == $urole){
            $this->entity['list']['dql_filter'] = "entity.roles = 'a:0:{}'";
        }
        return parent::listAction();
    }



    public function editUserAction(){

        $this->dispatch(EasyAdminEvents::PRE_EDIT);
        $id = $this->request->query->get('id');
        $easyadmin = $this->request->attributes->get('easyadmin');
        $entity = $easyadmin['item'];
        $urole = $this->request->query->get('urole');
        $profile = $this->request->query->get('profile');

        if ($this->request->isXmlHttpRequest() && $property = $this->request->query->get('property')) {
            $newValue = 'true' === mb_strtolower($this->request->query->get('newValue'));
            $fieldsMetadata = $this->entity['list']['fields'];

            if (!isset($fieldsMetadata[$property]) || 'toggle' !== $fieldsMetadata[$property]['dataType']) {
                throw new \RuntimeException(sprintf('The type of the "%s" property is not "toggle".', $property));
            }

            $this->updateEntityProperty($entity, $property, $newValue);

            // cast to integer instead of string to avoid sending empty responses for 'false'
            return new Response((int) $newValue);
        }

        $fields = $this->entity['edit']['fields'];
        $fields['role']['type_options']['data']= 'ROLE_PROVIDER';

        $editForm = $this->createEditForm($entity, $fields);
        $deleteForm = $this->createDeleteForm($this->entity['name'], $id);
        if($profile && $this->isGranted('ROLE_ADMIN') || 'admin' == $urole){
            $editForm->remove('companyName');
            $editForm->remove('birthday');
            $editForm->remove('sex');
            $editForm->remove('address');
            $editForm->remove('role');
        }elseif ($profile && $this->isGranted('ROLE_PROVIDER') || 'provider' == $urole){
            $editForm->remove('birthday');
            $editForm->remove('sex');
            $editForm->remove('role');
            $editForm->remove('addShape');
        }
        if ('member' == $urole){
            //var_dump('用户');die();
            $editForm->remove('companyName');
            $this->entity['edit']['actions']['addShape'] = array(
                'name' => 'addShape',
                'type' => 'method',
                'label' => '添加体型数据',
                'target'=> '_self',
            );
        }

        $editForm->handleRequest($this->request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->dispatch(EasyAdminEvents::PRE_UPDATE, array('entity' => $entity));

            $this->executeDynamicMethod('preUpdate<EntityName>Entity', array($entity));
            $this->executeDynamicMethod('update<EntityName>Entity', array($entity));

            $this->dispatch(EasyAdminEvents::POST_UPDATE, array('entity' => $entity));

            return $this->redirectToReferrer();
        }


        $this->dispatch(EasyAdminEvents::POST_EDIT);

        $parameters = array(
            'form' => $editForm->createView(),
            'entity_fields' => $fields,
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );

        return $this->executeDynamicMethod('render<EntityName>Template', array('edit', $this->entity['templates']['edit'], $parameters));
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

    //修改商品
    public function editProductAction(){
        $id = $this->request->get('id');
        $product = $this->em->getRepository(Product::class)->find($id);
        if(!($product instanceof Product)){
            throw $this->createNotFoundException('没有该商品');
        }
        $authorization = $this->container->get('security.authorization_checker');
        if($product->getProvider() != $this->getUser() && !$authorization->isGranted('ROLE_ADMIN')){
            throw $this->createAccessDeniedException('你无权访问');
        }
        $this->dispatch(EasyAdminEvents::PRE_EDIT);

        $id = $this->request->query->get('id');
        $easyadmin = $this->request->attributes->get('easyadmin');
        $entity = $easyadmin['item'];

        if ($this->request->isXmlHttpRequest() && $property = $this->request->query->get('property')) {
            $newValue = 'true' === mb_strtolower($this->request->query->get('newValue'));
            $fieldsMetadata = $this->entity['list']['fields'];

            if (!isset($fieldsMetadata[$property]) || 'toggle' !== $fieldsMetadata[$property]['dataType']) {
                throw new \RuntimeException(sprintf('The type of the "%s" property is not "toggle".', $property));
            }

            $this->updateEntityProperty($entity, $property, $newValue);

            // cast to integer instead of string to avoid sending empty responses for 'false'
            return new Response((int) $newValue);
        }

        $fields = $this->entity['edit']['fields'];

        $editForm = $this->executeDynamicMethod('create<EntityName>EditForm', array($entity, $fields));
        $deleteForm = $this->createDeleteForm($this->entity['name'], $id);


        if(!($this->isGranted('ROLE_ADMIN'))){
            $editForm->remove('price');
            $editForm->remove('selling');
            $editForm->remove('provider');
            $editForm->remove('isFront');
        }
        $editForm->handleRequest($this->request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->dispatch(EasyAdminEvents::PRE_UPDATE, array('entity' => $entity));

            $this->executeDynamicMethod('preUpdate<EntityName>Entity', array($entity));
            $this->executeDynamicMethod('update<EntityName>Entity', array($entity));

            $this->dispatch(EasyAdminEvents::POST_UPDATE, array('entity' => $entity));

            return $this->redirectToReferrer();
        }

        $this->dispatch(EasyAdminEvents::POST_EDIT);

        $parameters = array(
            'form' => $editForm->createView(),
            'entity_fields' => $fields,
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );

        return $this->executeDynamicMethod('render<EntityName>Template', array('edit', $this->entity['templates']['edit'], $parameters));
    }

    //添加商品
    public function newProductAction(){
        $this->dispatch(EasyAdminEvents::PRE_NEW);

        $entity = $this->executeDynamicMethod('createNew<EntityName>Entity');

        $easyadmin = $this->request->attributes->get('easyadmin');
        $easyadmin['item'] = $entity;
        $this->request->attributes->set('easyadmin', $easyadmin);

        $fields = $this->entity['new']['fields'];

        $newForm = $this->executeDynamicMethod('create<EntityName>NewForm', array($entity, $fields));


        if(!($this->isGranted('ROLE_ADMIN'))){
            $newForm->remove('price');
            $newForm->remove('selling');
            $newForm->remove('provider');
        }

        $newForm->handleRequest($this->request);
        if ($newForm->isSubmitted() && $newForm->isValid()) {
            $this->dispatch(EasyAdminEvents::PRE_PERSIST, array('entity' => $entity));
            if(null == $entity->getProvider()){
                $entity->setProvider($this->getUser());
            }

            $this->executeDynamicMethod('prePersist<EntityName>Entity', array($entity));
            $this->executeDynamicMethod('persist<EntityName>Entity', array($entity));

            $this->dispatch(EasyAdminEvents::POST_PERSIST, array('entity' => $entity));

            return $this->redirectToReferrer();
        }

        $this->dispatch(EasyAdminEvents::POST_NEW, array(
            'entity_fields' => $fields,
            'form' => $newForm,
            'entity' => $entity,
        ));

        $parameters = array(
            'form' => $newForm->createView(),
            'entity_fields' => $fields,
            'entity' => $entity,
        );

        return $this->executeDynamicMethod('render<EntityName>Template', array('new', $this->entity['templates']['new'], $parameters));
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

    public function paidAction(){
        $this->entity['list']['dql_filter'] = 'entity.status = 1';
        if(!($this->isGranted('ROLE_ADMIN'))){
           unset($this->entity['list']['fields']['totalAmount']);
           unset($this->entity['list']['fields']['user']);
        }
        return  parent::listAction();
    }

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

    public function unpaidAction(){
        $this->entity['list']['dql_filter'] = 'entity.status = 0';
        if(!($this->isGranted('ROLE_ADMIN'))){
            unset($this->entity['list']['fields']['totalAmount']);
            unset($this->entity['list']['fields']['user']);
        }
        return  parent::listAction();
    }

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


}