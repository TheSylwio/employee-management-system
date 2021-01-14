<?php

namespace App\Form;

use App\Entity\OvertimeDisposition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OvertimeDispositionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', null, [
                'label' => 'Początek dyspozycji',
                'widget' => 'single_text',
                'attr' => ['class' => 'picker']
            ])
            ->add('endDate', null, [
                'label' => 'Koniec dyspozycji',
                'widget' => 'single_text',
                'attr' => ['class' => 'picker']
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OvertimeDisposition::class,
        ]);
    }
}
