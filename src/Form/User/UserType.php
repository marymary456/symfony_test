<?php
namespace App\Form\User;

        use App\Entity\User\User;
        use Symfony\Component\Form\AbstractType;
        use Symfony\Component\Form\Extension\Core\Type\SubmitType;
        use Symfony\Component\Form\FormBuilderInterface;
        use Symfony\Component\OptionsResolver\OptionsResolver;
        use Symfony\Component\Form\Extension\Core\Type\EmailType;
        use Symfony\Component\Form\Extension\Core\Type\TextType;
        use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
        use Symfony\Component\Form\Extension\Core\Type\PasswordType;

        class UserType extends AbstractType
        {
            public function buildForm(FormBuilderInterface $builder, array $options)
            {
                $builder
                    ->add('email', EmailType::class, array(
                        'attr' => array('class' => 'form-control',
                        'placeholder' => 'Email'),
                        'label' => false))
                    ->add('username', TextType::class, array(
                        'attr' => array('class' => 'form-control',
                        'placeholder' => 'Username'),
                        'label' => false))
                    ->add('plainPassword', RepeatedType::class, array(
                        'type' => PasswordType::class,
                        'first_options'  => array('label' => false,
                        'attr' => array('class' => 'form-control',
                        'placeholder' => 'Password')),
                        'second_options' => array('label' => false,
                        'attr' => array ('class' => 'form-control',
                        'placeholder' => 'Confirm Password'))))
                    ->add('submit', SubmitType::class, array(
                        'attr' => array('class' => 'btn btn-lg btn-primary btn-block'),
                        'label' => 'Sign up'));
            }

            public function configureOptions(OptionsResolver $resolver)
            {
                $resolver->setDefaults(array(
                    'data_class' => User::class,
                ));
            }
        }