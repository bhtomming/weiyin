<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\11 0011
 * Time: 14:08
 */

namespace AppBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('phone',null,array(
            'label'=> '电话',
        ))
            ->remove('email')
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }



}