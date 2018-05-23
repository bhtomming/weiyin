<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/17
 * Time: 19:55
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\City;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('city',EntityType::class,array(
            'class' => 'AppBundle:City',
            'placeholder'=>'请选择城市',
            'label' => '市',
            'choice_value' => function(City $entity = null){
                return $entity ? $entity->getCode() : '';
            },
        ));
    }

}