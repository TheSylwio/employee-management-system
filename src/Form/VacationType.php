<?php

namespace App\Form;

use App\Entity\Vacation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VacationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', null, [
                'label' => 'Początek urlopu',
                'widget' => 'single_text',
                'attr' => ['class' => 'vacationPicker']
            ])
            ->add('endDate', null, [
                'label' => 'Koniec urlopu',
                'widget' => 'single_text',
                'attr' => ['class' => 'vacationPicker']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vacation::class,
        ]);
    }
}
