<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\26 0026
 * Time: 14:21
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('phone')
            ->add('sex',ChoiceType::class,array(
                'choices' => array(
                    '男'=> '男',
                    '女' => '女',
                )
            ))
            ->add('birthday',BirthdayType::class,array(
                'placeholder' => array(
                    'year' => '请选择年', 'month' => '请选择月', 'day' => '请选择日',
                )
            ))
            ->add('plainPassword',RepeatedType::class,array(
                'type'=> PasswordType::class,
                'invalid_message' => '你输入的密码不正确，请重新输入',
                'required' => false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'AppBundle\Entity\User'
        ));
    }

    public function getBlockPrefix()
    {
        return 'member';
    }

}