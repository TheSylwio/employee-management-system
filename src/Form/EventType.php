<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nazwa'
            ])
            ->add('startDate', null, [
                'label' => 'Data rozpoczęcia',
                'widget' => 'single_text',
                'attr' => ['class' => 'picker']
            ])
            ->add('endDate', null, [
                'label' => 'Data zakończenia',
                'widget' => 'single_text',
                'attr' => ['class' => 'picker']
            ])
            ->add('description', null, [
                'label' => 'Opis'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
