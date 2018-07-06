<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\25 0025
 * Time: 10:06
 */

namespace AppBundle\EventListener;


use AppBundle\Entity\Goods;
use AppBundle\Event\TradeEvents;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;

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
            TradeEvents::PRE_PAID=>'checkTrade',
        );
    }

    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }

    public function checkUserRights(GenericEvent $event){
        $authorization = $this->container->get('security.authorization_checker');
        $request = $this->container->get('request_stack')->getCurrentRequest()->query;
        if($authorization->isGranted('ROLE_ADMIN')){
            return;
        }
        $entity = $request->get('entity');
        $action = $request->get('action');
        $userId = $request->get('id');
        if($entity == 'User'){
            if($action == 'show' || $action == 'edit'){
                if($userId == $this->container->get('security.token_storage')->getToken()->getUser()->getId()){
                    return;
                }
            }
        }
        $config = $this->container->get('easyadmin.config.manager')->getBackendConfig();
        foreach ($config['entities'] as $k => $v){
            if($entity == $k && !$authorization->isGranted($v[$action]['role'])){
                throw new AccessDeniedException();
            }
        }
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
            $product->setUpdatedAt(new \DateTime('now'));
            $em->persist($product);
            $em->flush();
        }
        $trade->setStatus(Goods::PAID);
    }
}