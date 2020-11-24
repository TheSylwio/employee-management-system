<?php

namespace App\Form;

use App\Entity\Status;
use phpDocumentor\Reflection\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category',ChoiceType::class,[
                'choices'=>[
                    'Zrobione'=>'Zrobione',
                    'W realizacji'=>'W realizacji',
                    'Nie zrobione'=>'Nie zrobione',
                ],
            ])
            ->add('name', null,[
                'label'=>'Nazwa statusu'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Status::class,
        ]);
    }
}
