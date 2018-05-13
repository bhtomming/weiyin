<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\8 0008
 * Time: 9:02
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;


class NumberType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'class'=>'',
        ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id = $options['attr']['data-id'];
        $numClass = $options['class'];
        $builder->add('reduce',ButtonType::class,array(
            'label'=>'-',
            'attr'=>array(
                'class' => 'btn reduce',
                'data-id'=> $id,
            ),
        ))
            ->add('number',TextType::class,array(
                'label' => '数量',
                'attr' => array(
                    'size' => 2,
                    'class' => 'number '.$numClass,
                    'value' => $options['attr']['value'],
                    'data-id' => $id
                )
            ))
            ->add('add',ButtonType::class,array(
                'label' => '+',
                'attr'=> array(
                    'id'=>'add',
                    'class' => 'btn add',
                    'data-id' => $id,
                )
            ))
        ;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
    }

    public function getParent()
    {
        return FormType::class;
    }

}