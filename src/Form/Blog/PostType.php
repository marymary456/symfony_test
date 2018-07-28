<?php


namespace App\Form\Blog;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                'attr' => array('class' => 'form-control',
                    'name' => 'title',
                    'id' => 'usr',
                    'placeholder' => 'Add title')))
            ->add('content', TextareaType::class, array(
                'attr' => array('class' => 'form-control',
                    'rows' => '5',
                    'id' => 'comment',
                    'name' => 'content',
                    'placeholder' => 'Add content')))
            ->add('submit', SubmitType::class);
    }
}