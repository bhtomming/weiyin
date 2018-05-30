<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\25 0025
 * Time: 10:06
 */

namespace AppBundle\EventListener;


use AppBundle\Entity\Goods;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class TradeSubscriber implements EventSubscriberInterface
{

    private $container;

    public static function getSubscribedEvents()
    {
        return array(EasyAdminEvents::PRE_SHOW =>  'checkUserRole');
    }

    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }

    public function checkUserRole(GenericEvent $event){
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $roles = $user->getRoles();
        $request = $this->container->get('request_stack')->getCurrentRequest()->query;
        $entity = $request->get('entity');
        $action = $request->get('action');
        $id = $request->get('id');
        $em = $this->container->get('doctrine.orm.entity_manager');
        if('Provider_Goods'==$entity && 'show' == $action && in_array('ROLE_PROVIDER',$roles)){
            $goods = $em->getRepository(Goods::class)->find($id);
            $goods->setProviderRead(true);
            return;
        }
        if('Goods'==$entity && 'show' == $action && in_array('ROLE_ADMIN',$roles)){
            $goods = $em->getRepository(Goods::class)->find($id);
            $goods->setAdminRead(true);
            return;
        }
        $authorization = $this->container->get('security.authorization_checker');

        if($authorization->isGranted('ROLE_ADMIN')){
            return;
        }

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
}