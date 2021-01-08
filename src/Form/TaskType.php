<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\Milestone;
use App\Entity\Status;
use App\Entity\Task;
use App\Service\Helper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    /**
     * @var Company
     */
    private $company;

    public function __construct(Helper $helper)
    {
        $this->company = $helper->getCompany();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nazwa',
            ])
            ->add('assignation', ChoiceType::class, [
                'label' => 'Przydział',
                'mapped' => false,
                'choice_label' => 'name',
                'choices' => [
                    'Zespoły' => $this->company->getTeams()->toArray(),
                    'Pracownicy' => $this->company->getEmployees()->toArray(),
                ]
            ])
            ->add('deadline', null, [
                'label' => 'Termin realizacji',
                'widget' => 'single_text',
                'attr' => ['class' => 'picker'],
            ])
            ->add('description', null, [
                'label' => 'Opis zadania',
                'required' => false,
            ])
            ->add('status', EntityType::class, [
                'label' => 'Status zadania',
                'class' => Status::class,
            ])
            ->add('milestone', EntityType::class, [
                'label' => 'Kamień milowy',
                'class' => Milestone::class,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
