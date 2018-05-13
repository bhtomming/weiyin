<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13
 * Time: 11:25
 */

namespace AppBundle\Form\Type;


use AppBundle\AppBundle;
use AppBundle\Entity\City;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('province',EntityType::class,array(
            'class' => 'AppBundle:City',
            'label' => '省份',
            'placeholder' => '',
            'query_builder' => function(EntityRepository $er){
                return $er->getProvince();
            }
        ));


    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

}