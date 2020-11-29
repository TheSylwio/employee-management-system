<?php

namespace App\Form;

use App\Entity\Milestones;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MilestonesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', null, [
                'label' => 'nazwa'
            ])
            ->add('description', null, [
                'label' => 'Opis'
            ])
            ->add('realizationTime', null, [
                'label' => 'czas realizacji',
                'widget' => 'single_text',
                'attr' => ['class' => 'picker']
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Milestones::class,
        ]);
    }
}
