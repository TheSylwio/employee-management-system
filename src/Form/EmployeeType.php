<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                'label' => 'Imię',
                'attr' => [
                    'placeholder' => 'np. Jan',
                ]
            ])
            ->add('surname', TextType::class, [
                'label' => 'Nazwisko',
                'attr' => [
                    'placeholder' => 'np. Kowalski',
                ]
            ])
            ->add('role', ChoiceType::class, [
                'mapped' => false,
                'label' => 'Rola',
                'choices' => [
                    'Pracownik' => 'ROLE_EMPLOYEE',
                    'Asystent' => 'ROLE_ASSISTANT',
                    'Księgowy' => 'ROLE_ACCOUNTANT'
                ]
            ])
            ->add('dateOfBirth', DateType::class, [
                'label' => 'Data urodzenia',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'birthPicker'
                ],
            ])
            ->add('pesel', TextType::class, [
                'label' => 'PESEL',
                'attr' => [
                    'placeholder' => 'np. 012345678901',
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Adres zamieszkania',
                'attr' => [
                    'placeholder' => 'np. ul. Przykładowa 15, Katowice',
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
