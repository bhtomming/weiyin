<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\25 0025
 * Time: 9:48
 */

namespace AppBundle\DependencyInjection\Compiler;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ConfigPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     */
    public function process(ContainerBuilder $container)
    {
        $config = $container->getParameter('easyadmin.config');
        foreach ($config['design']['menu'] as $k => $v){
            if(!isset($v['role'])){
                $config['design']['menu'][$k]['role'] = 'IS_AUTHENTICATED_FULLY';
            }
        }

        foreach ($config['entities'] as $k => $v){
            if(!isset($v['role'])){
                $config['entities'][$k]['role'] = 'IS_AUTHENTICATED_FULLY';
            }
        }

        foreach ($config['entities'] as $k => $v){
            $views = ['show','new','edit','delete','list','form'];
            foreach ($views as $view){
                if(!isset($v[$view]['role'])){
                    $config['entities'][$k][$view]['role'] = 'IS_AUTHENTICATED_FULLY';
                }
            }
        }

        $container->setParameter('easyadmin.config',$config);
    }
}