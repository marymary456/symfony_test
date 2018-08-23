<?php


namespace App\Form\Blog;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', TextareaType::class, array(
                'attr' => array('class' => 'form-control',
                    'rows' => '3',
                    'id' => 'comment',
                    'name' => 'comment'),
            'label' => false))
            ->add('submit', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-primary')));
    }
}