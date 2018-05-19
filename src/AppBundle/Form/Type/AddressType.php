<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13
 * Time: 11:25
 */

namespace AppBundle\Form\Type;


use AppBundle\Entity\City;
use AppBundle\Form\DataTransFormer\CityToAddressTransFormer;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    protected $manager;
    public function __construct(ObjectManager $manager){
        $this->manager = $manager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('province',EntityType::class,array(
            'class' => 'AppBundle:City',
            'label' => ' ',
            'placeholder'=>'请选择省份',
            'query_builder' => function(EntityRepository $er){
                return $er->getProvince();
            },
            'choice_value' => function(City $entity = null){
                return $entity ? $entity->getCode() : '';
            }
        ))
            ->add('city',EntityType::class,array(
                'class' => 'AppBundle:City',
                'label' => ' ',
                'placeholder' => '请选择城市',
                'choice_value' => function(City $entity = null){
                    return $entity ? $entity->getCode() : '';
                }
            ))
            ->add('area',EntityType::class,array(
                'class'  => 'AppBundle:City',
                'label' => ' ',
                'placeholder'=>'请选择区域',
                'choice_value' => function(City $entity = null){
                    return $entity ? $entity->getCode() : '';
                }
            ))
            ->add('street',TextType::class,array(
                'label'=>'街道',
            ))
            /*->add('submit',SubmitType::class,array(
                'label'=>'确定'
            ))*/
        ;
        $cityModifier = function (FormInterface $form,  $province = null) {
            $code = null == $province ? '' : substr($province,0,2);
            $form->add('city',EntityType::class,array(
                'class' => 'AppBundle:City',
                'placeholder' => '请选择城市',
                'query_builder' => function(EntityRepository $er) use($code){
                    return $er->getCity($code);
                },
                'choice_value' => function(City $entity = null){
                    return $entity ? $entity->getCode() : '';
                }
            ));
        };
        $areaModifier = function (FormInterface $form,  $city = null) {
            $code = null == $city ? '' : substr($city,0,4);
            $form->add('area',EntityType::class,array(
                'class' => 'AppBundle:City',
                'placeholder'=>'请选择区域',
                'query_builder' => function(EntityRepository $er) use($code){
                    return $er->getArea($code);
                },
                'choice_value' => function(City $entity = null){
                    return $entity ? $entity->getCode() : '';
                },
            ));
        };


        $builder->addEventListener(FormEvents::PRE_SUBMIT,function(FormEvent $event) use($areaModifier,$cityModifier){
            $data = $event->getData();
            $form = $event->getForm();
            $province = isset($data['province']) ? $data['province'] : null;
            $city = isset($data['city']) ? $data['city'] : null;
            if(null != $province){
                $cityModifier($form,$province);
            }
            if(null != $city){
                $areaModifier($form,$city);
            }

        });
        $builder->addModelTransformer(new CityToAddressTransFormer($this->manager), true);

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {

    }

}