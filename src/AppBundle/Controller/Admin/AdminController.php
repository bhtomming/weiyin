<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\4\23 0023
 * Time: 8:51
 */

namespace AppBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

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



}