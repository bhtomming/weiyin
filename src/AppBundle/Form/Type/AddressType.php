<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Area;
use AppBundle\Entity\City;
use AppBundle\Entity\Province;
use AppBundle\Form\DataTransFormer\AddressToArrayTransFormer;
use AppBundle\Form\DataTransFormer\ShapeToArrayTransFormer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('street',null,array(
            'attr' =>array(
                'class' => 'form-control'
            ),
        ))->add('isDefault',null,array(
            'label'=>'默认地址',
        ))
            ->add('province',EntityType::class,array(
                'class'=>'AppBundle\Entity\Province',
                'choice_value' => function(Province $entity = null){
                    return $entity ? $entity->getCode() : '';
                },
                'attr' =>array(
                    'class' => 'form-control'
                ),
                'placeholder' => '请选择省份'
            ))->add('city',EntityType::class,array(
                'class' =>'AppBundle:City',
                'choice_value' => function(City $entity = null){
                    return $entity ? $entity->getCode() : '';
                },
                'attr' =>array(
                    'class' => 'form-control'
                ),
                'placeholder' => '请选择城市',
                'required' => false,
            ))->add('area',EntityType::class,array(
                'class'=>'AppBundle:Area',
                'choice_value' => function(Area $entity = null){
                    return $entity ? $entity->getCode() : '';
                },
                'attr' =>array(
                    'class' => 'form-control'
                ),
                'placeholder' => '请选择区域'
            ));
        $builder->addModelTransformer(new AddressToArrayTransFormer());
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Address'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'address';
    }


}
