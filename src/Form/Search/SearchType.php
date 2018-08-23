<?php

namespace App\Form\Search;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
                'placeholder' => 'Search'),
                'label' => false))
            ->add('submit', SubmitType::class,array(
                'attr' => array('class' => 'btn btn-secondary'),
                'label' => 'Go!'))
        ->getForm();

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }
}
