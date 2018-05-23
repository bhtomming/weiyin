<?php

namespace AppBundle\Form\Type;

use AppBundle\Form\DataTransFormer\ShapeToArrayTransFormer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShapeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('neckAround')->add('neckRoot')->add('shoulderLength')->add('preShoulderWidth')->add('backSchoulderWidth')->add('shoulderWidth')->add('chestMiddle')->add('chestLower')->add('breasWidth')->add('chestWidth')->add('armRoot')->add('armUp')->add('armMiddle')->add('armLower')->add('trunk')->add('armpit')->add('waistLength')->add('neckToBreast')->add('neckToWaist')->add('shoulderToBreast')->add('waistPreLength')->add('chestHeight')->add('armLength')->add('armUpLength')->add('armLowerLength')->add('neckToWrist')->add('preWaistJoint')->add('backWaistJoint')->add('sitToNeck')->add('humpback')->add('shoulderSlash')->add('waist')->add('abdomen')->add('hipline')->add('neckToLap')->add('neckToKnee')->add('neckHeight')->add('waistHeight')->add('crotch')->add('waistToHipline')->add('belly')->add('legRoot')->add('legMiddle')->add('knee')->add('kneeLower')->add('legBelly')->add('ankleUp')->add('ankle')->add('legOutLength')->add('legInLength')->add('thigh')->add('waistToAnkle')->add('hipHeight')->add('ankleOut')->add('perineum')->add('height')->add('weight')->add('remarks')->add('keep')->add('user');
        //$builder->addModelTransformer(new ShapeToArrayTransFormer(),true);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Shape'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_shape';
    }


}
