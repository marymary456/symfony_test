<?php


namespace App\Form\Blog;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'attr' => array('class' => 'form-control',
                'name' => 'title',
                'placeholder' => 'Blog Title'),
                'label' => false));

    }

    public function getBlockPrefix()
    {
        return ''; // return an empty string here
    }
}