<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\25 0025
 * Time: 10:06
 */

namespace AppBundle\EventListener;


use AppBundle\DependencyInjection\Compiler\ConfigPass;
use AppBundle\Entity\Goods;
use AppBundle\Entity\Product;
use AppBundle\Entity\User;
use AppBundle\Event\TradeEvents;
use AppBundle\Form\Type\AddressType;
use EasyCorp\Bundle\EasyAdminBundle\Configuration\ActionConfigPass;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;

use Pagerfanta\Pagerfanta;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AppSubscriber implements EventSubscriberInterface
{

    private $container;

    public static function getSubscribedEvents()
    {
        return array(
            EasyAdminEvents::PRE_LIST =>  'checkUserRights',
            EasyAdminEvents::PRE_EDIT =>  'checkUserRights',
            EasyAdminEvents::PRE_SHOW =>  'checkUserRights',
            EasyAdminEvents::PRE_NEW =>  'checkUserRights',
            EasyAdminEvents::PRE_DELETE =>  'checkUserRights',
            TradeEvents::PRE_PAID=>'checkTrade',
            EasyAdminEvents::POST_SHOW => 'checkShowRights',
        );
    }

    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }

    //根据用户权限显示管理菜单
    public function checkUserRights(GenericEvent $event){
        $authorization = $this->container->get('security.authorization_checker');
        //$request = $this->container->get('request_stack')->getCurrentRequest()->query;
        if($authorization->isGranted('ROLE_ADMIN')){
            return;
        }
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $entity = $request->query->get('entity');;
        $action = $request->query->get('action');
        $userId = $request->query->get('id');
        if($entity == 'User'){
            if($action == 'show' || $action == 'edit'){
                if($userId == $this->container->get('security.token_storage')->getToken()->getUser()->getId()){
                    return;
                }
            }
            $config = $this->container->get('easyadmin.config.manager')->getBackendConfig();
            foreach ($config['entities'] as $k => $v){
                if($entity == $k && !$authorization->isGranted($v[$action]['role'])){
                    throw new AccessDeniedException();
                }
            }
        }
        $allowEntity = array('Goods','Product','Provider');
        if(in_array($entity,$allowEntity)){
            return;
        }
        throw new AccessDeniedException();

    }

    //监听订单支付成功后的事件
    public function checkTrade(GenericEvent $event){
        $trade = $event->getSubject();
        $em = $event->getArgument('em');

        if(!$trade instanceof Goods){
            return;
        }
        $tradeItems = $trade->getGoodsDetail();
        foreach ($tradeItems as $tradeItem){
            $product = $tradeItem->getProduct();
            //设置商品销量库存
            $product->setSales($product->getSales() + $tradeItem->getNumber());
            $product->setStock($product->getStock() - $tradeItem->getNumber());
            //商品没有库存自动下架
            if($product->getStock() == 0){
                $product->setSelling(false);
            }
            $product->setUpdatedAt(new \DateTime('now'));
            $em->persist($product);
            $em->flush();
        }
        $trade->setStatus(Goods::PAID);
    }



    public function checkShowRights(GenericEvent $event){
        $entity = $event->getArgument('entity');
        if(!$entity instanceof Goods){
            return;
        }
        $authorization = $this->container->get('security.authorization_checker');
        $em = $event->getArgument('em');
        if($authorization->isGranted('ROLE_ADMIN')){
            $entity->setAdminRead(true);
            $em->persist($entity);
            $em->flush();
            return;
        }
        foreach($entity->getGoodsDetail() as $goodsDetail){
            $entity->setProviderRead(true);
            if($goodsDetail->getProduct()->getProvider() == $this->container->get('security.token_storage')->getToken()->getUser()){
                $em->persist($entity);
                $em->flush();
                return;
            }
        }
        throw new AccessDeniedException();

    }


}