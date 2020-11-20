<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('topic', TextType::class, [
                'label' => 'Temat',
                'attr' => [
                    'placeholder' => 'O czym chcesz napisać?',
                ]
            ])
            ->add('post', TextareaType::class, [
                'label' => 'Treść',
                'attr' => [
                    'placeholder' => 'Wpisz treść posta',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
