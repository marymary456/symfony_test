<?php


namespace App\Form\User;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', TextType::class, array(
                'attr' => array('class' => 'form-control',
                'placeholder' => 'Username'),
                'label' => false)
            )
            ->add('_password', PasswordType::class, array(
                'attr' => array('class' => 'form-control',
                'placeholder' => 'Password'),
                'label' => false));
    }

    public function getBlockPrefix()
    {
        return ''; // return an empty string here
    }
}