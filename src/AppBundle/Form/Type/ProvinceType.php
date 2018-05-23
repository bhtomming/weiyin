<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\23 0023
 * Time: 17:21
 */

namespace AppBundle\Form\Type;


use AppBundle\Entity\Province;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProvinceType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('province',EntityType::class,array(
            'class' => 'AppBundle:Province',
            'placeholder'=>'请选择省份',
            'label' => '省',
            'choice_value' => function(Province $entity = null){
                return $entity ? $entity->getCode() : '';
            },
        ));
    }

}