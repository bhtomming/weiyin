<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\4\23 0023
 * Time: 8:51
 */

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Shape;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends BaseAdminController
{
    public function createNewUserEntity(){
        return $this->container->get('fos_user.user_manager')->createUser();
    }

    public function persistUserEntity($user){
        $this->container->get('fos_user.user_manager')->updateUser($user,false);
        parent::persistEntity($user);
    }

    public function updateUserEntity($user){

        $this->container->get('fos_user.user_manager')->updateUser($user,false);
        parent::updateEntity($user);
    }

    public function persistCouponEntity($coupon){
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN',NULL, '你无权访问');
        if($coupon->getCreator() == null){
            $coupon->setCreator($this->getUser());
        }
        parent::persistEntity($coupon);
    }

    public function persistGoodsEntity($goods){
        if($goods->getUser() == null){
            $goods->setUser($this->getUser());
        }
        parent::persistEntity($goods);
    }

    public function createNewEntity()
    {
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN',NULL, '你无权访问');
        return parent::createNewEntity();
    }
    public function addShapeAction(){
        $userId = $this->request->query->get('id');
        return $this->redirectToRoute('easyadmin',array(
            'entity'=>'Shape',
            'userId' => $userId,
            'action'=>'new',
        ));
    }

    public function showssShapeAction(){
        $userId = $this->request->query->get('id');
        $user =  $this->getDoctrine()->getRepository(User::class)->find($userId);
        $shapes = $user->getShape();
        $shape = $shapes->last();
        if( !($shape instanceof Shape) ){
            return $this->addShapeAction();
        }
        return $this->redirectToRoute('easyadmin',array(
            'entity' => 'Shape',
            'action' => 'show',
            'userId' => $userId,
            'id' => $shape->getId(),
        ));
    }

    public function createNewShapeEntity(){
        $user = $this->shapeGetUser();
        $shape = new Shape();
        $shape->setUser($user);
        return $shape;
    }

    public function persistShapeEntity($shape){
        $user = $this->shapeGetUser();
        parent::persistEntity($shape);
        $user->setShape($shape);
    }


    public function editShapeAction(){
        //parent::editAction();
        $id = $this->request->query->get('id');
        $easyadmin = $this->request->attributes->get('easyadmin');
        $entity = $easyadmin['item'];
        $fields = $this->entity['edit']['fields'];
        $form = $this->createEditForm($entity,$fields);
        $deleteForm = $this->createDeleteForm($this->entity['name'], $id);
        $form->handleRequest($this->request);
        if($form->isValid() && $form->isSubmitted()){
            $this->UpdateEntity($entity);
            return $this->backtoUserAction();
        }
        return $this->render($this->entity['templates']['edit'],array(
            'form' => $form->createView(),
            'entity_fields' => $fields,
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function shapeGetUser(){
        $userId = $this->request->query->get('userId');
        return $this->getDoctrine()->getRepository(User::class)->find($userId);
    }


    public function backtoUserAction(){
        $id =  $this->request->query->get('id');
        if( null == $id){
            //$referer = $this->request->query->get('referer');
            //return $this->redirect(urldecode($referer));
            return $this->redirectToRoute('easyadmin',array(
                'entity' => 'Member',
                'action' => 'list',
            ));
        }
        $shape = $this->getDoctrine()->getRepository(Shape::class)->find($id);
        return $this->redirectToRoute('easyadmin',array(
            'entity' => 'Member',
            'action' => 'edit',
            'id' => $shape->getUser()->getId(),
        ));
    }

    public function addAddressAction(){
        $userId = $this->request->query->get('id');
        return $this->redirectToRoute('easyadmin',array(
            'entity'=>'Address',
            'userId' => $userId,
            'action'=>'new',
        ));
    }


}