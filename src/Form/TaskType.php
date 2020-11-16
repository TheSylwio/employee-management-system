<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add ('status',ChoiceType::class, [
                'choices'=>[
                    'Zrobione'=>'Zrobione',
                    'Nie zrobione'=>'Nie zrobione',
                    'W realizacji'=>'W realizacji'
                ],
                    'label'=>'status zadania',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
