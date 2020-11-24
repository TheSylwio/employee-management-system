<?php

namespace App\Form;

use App\Entity\Status;
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
            ])
            ->add('description', null, [
                'label' => 'Opis zadania',
            ])
            ->add('status',StatusType::class, [
                'label'=>'Status zadania'
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
