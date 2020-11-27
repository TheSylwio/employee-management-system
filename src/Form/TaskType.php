<?php

namespace App\Form;

use App\Entity\Milestones;
use App\Entity\Status;
use App\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ])
            ->add('status', EntityType::class, [
                'label' => 'Status zadania',
                'class' => Status::class,
            ])
            ->add('milestone', EntityType::class,[
                'label'=>'kamień milowy',
                'class'=> Milestones::class,
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
