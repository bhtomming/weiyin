<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\23 0023
 * Time: 17:21
 */

namespace AppBundle\Form\Type;


use AppBundle\Entity\Area;
use AppBundle\Entity\Province;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AreaType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('area',EntityType::class,array(
            'class' => 'AppBundle:Area',
            'placeholder'=>'区域',
            'label' => '区',
            'choice_value' => function(Area $entity = null){
                return $entity ? $entity->getCode() : '';
            },
        ));
    }

}