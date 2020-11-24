<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('employee', null, [
                'label' => 'Pracownik',
            ])
            ->add('deadline', null, [
                'label' => 'Termin realizacji',
                'widget' => 'single_text',
                'attr'=> ['class' => 'picker']
            ])
            ->add('description', null, [
                'label' => 'Opis zadania',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
