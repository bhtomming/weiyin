<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\25 0025
 * Time: 10:06
 */

namespace AppBundle\EventListener;


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
        return array(EasyAdminEvents::PRE_LIST =>  'checkUserRights');
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
}