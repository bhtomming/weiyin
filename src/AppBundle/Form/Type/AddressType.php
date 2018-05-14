<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13
 * Time: 11:25
 */

namespace AppBundle\Form\Type;


use AppBundle\Entity\City;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
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
            },
            'choice_value' => function(City $entity = null){
                return $entity ? $entity->getCode() : '';
            }
        ))
            /*->add('city',EntityType::class,array(
                'class' => 'AppBundle:City',
                'label' => ' ',
                'choices' => array(),
                'attr' => array(
                    'hidden' => true
                )
            ))
            ->add('area',EntityType::class,array(
                'class'  => 'AppBundle:City',
                'label' => ' ',
                'choices' => array(),
                'attr' => array(
                    'hidden' => true
                )
            ))*/
            ->add('street',TextType::class,array(
                'label'=>'街道',
            ))
        ;
        $cityModifier = function (FormInterface $form, City $province = null) {
            $code = null == $province ? '' : substr($province->getCode(),0,2);
            $form->add('city',EntityType::class,array(
                'class' => 'AppBundle:City',
                'query_builder' => function(EntityRepository $er) use($code){
                    return $er->getCity($code);
                },
                'choice_value' => function(City $entity = null){
                    return $entity ? $entity->getCode() : '';
                }
            ));
        };
        $areaModifier = function (FormInterface $form, City $city = null) {
            $code = null == $city ? '' : substr($city->getCode(),0,4);
            $form->add('area',EntityType::class,array(
                'class' => 'AppBundle:City',
                'query_builder' => function(EntityRepository $er) use($code){
                    return $er->getArea($code);
                },
                'choice_value' => function(City $entity = null){
                    return $entity ? $entity->getCode() : '';
                },
            ));
        };
        $builder->addEventListener(FormEvents::PRE_SET_DATA,function(FormEvent $event) use($cityModifier,$areaModifier){
            $data = $event->getData();
            $form = $event->getForm();
            $province = $data->getProvince();

            if(null != $province && $province->isGovernment()){
                return $form->remove('city');
            }
            /*return $code$form;
           city = $data->getCity();
           if(null != $city->getCode()){
               return $areaModifier($form,$city);
           }*/
            return $cityModifier($form,$province);


        });
        $builder->addEventListener(FormEvents::POST_SUBMIT,function(FormEvent $event) use($cityModifier){
            $data= $event->getData();
            $province = $data->getProvince();
            $cityModifier($event->getForm()->getParent(),$province);
        });
        /*$builder->get('city')->addEventListener(FormEvents::POST_SUBMIT,function(FormEvent $event) use($areaModifier){
            $city= $event->getForm()->getData();
            $areaModifier($event->getForm()->getParent(),$city);
        });*/

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {

    }

}