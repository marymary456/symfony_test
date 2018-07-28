<?php

namespace App\Form\Search;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search', TextType::class, array(
                'attr' => array('class' => 'form-control',
                'name' => 'search',
                'placeholder' => 'Search User'),
                'label' => false))
//            ->add('select', ChoiceType::class, array(
//                'choices'  => array(
//                    'ID' => true,
//                    'Username' => false,
//                ),
//                'label' => false,
//                'placeholder' => 'By',
//                'required' => true,
//
//                'attr' => array(
//                    'name' => 'select',
//                    'class' =>"form-control"
//                )))
        ->getForm();

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }
}
