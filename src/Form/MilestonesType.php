<?php

namespace App\Form;

use App\Entity\Milestone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MilestonesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nazwa'
            ])
            ->add('description', null, [
                'label' => 'Opis'
            ])
            ->add('realizationTime', null, [
                'label' => 'Czas realizacji',
                'widget' => 'single_text',
                'attr' => ['class' => 'picker']
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Milestone::class,
        ]);
    }
}
