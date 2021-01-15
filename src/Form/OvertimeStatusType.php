<?php

namespace App\Form;

use App\Entity\Overtime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OvertimeStatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', null, [
                'label' => 'Początek nadgodzin',
                'widget' => 'single_text',
                'attr' => ['class' => 'vacationPicker']
            ])
            ->add('endDate', null, [
                'label' => 'Koniec nadgodzin',
                'widget' => 'single_text',
                'attr' => ['class' => 'vacationPicker']
            ])
            ->add('beginHour', null, [
                'label' => 'Początkowa godzina',
                'attr' => ['class' => 'timePicker']
            ])
            ->add('endHour', null, [
                'label' => 'Końcowa godzina',
                'attr' => ['class' => 'timePicker']
            ])
            ->add('description', null, [
                'label' => 'Dodatkowe informacje',
            ])
            ->add('status', ChoiceType::class, [
                'label' => "Status",
                'choices' => [
                    'Zaakceptuj' => 'overtime',
                    'Odrzuć' => 'dispositionRejected',
                ],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Overtime::class,
        ]);
    }
}
