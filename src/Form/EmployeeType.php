<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'attr' => [
                    'placeholder' => 'np. Jan',
                    'class' => 'custom_class'
                ]
            ])
            ->add('surname', TextType::class, [
                'attr' => [
                    'placeholder' => 'np. Kowalski',
                    'class' => 'custom_class'
                ]
            ])
            ->add('dateOfBirth', DateType::class, [
                'years' => range(date('Y')-100, date('Y')-10)
            ])
            ->add('pesel', TextType::class, [
                'attr' => [
                    'placeholder' => 'np. 012345678901',
                    'class' => 'custom_class'
                ]
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'placeholder' => 'np. ul. Przykładowa 15, Katowice',
                    'class' => 'custom_class'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
