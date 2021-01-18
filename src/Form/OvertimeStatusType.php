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
                'label' => 'Początkowa data nadgodzin',
                'widget' => 'single_text',
                'attr' => ['class' => 'datePicker']
            ])
            ->add('endDate', null, [
                'label' => 'Końcowa data nadgodzin',
                'widget' => 'single_text',
                'attr' => ['class' => 'datePicker']
            ])
            ->add('beginHour', null, [
                'label' => 'Przedział godzinowy nadgodzin',
                'attr' => ['class' => 'timePicker']
            ])
            ->add('endHour', null, [
                'label' => false,
                'attr' => ['class' => 'timePicker']
            ])
            ->add('description', null, [
                'label' => 'Dodatkowe informacje',
            ])
            ->add('status', ChoiceType::class, [
                'label' => "Status nadgodzin",
                'choices' => [
                    'Zaakceptuj' => 'overtime',
                    'Odrzuć' => 'dispositionRejected',
                ],
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Overtime::class,
        ]);
    }
}
