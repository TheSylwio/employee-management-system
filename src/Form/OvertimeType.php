<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\Overtime;
use App\Service\Helper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OvertimeType extends AbstractType

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
            ->add('startDate', null, [
                'label' => 'Początkowa data nadgodzin',
                'widget' => 'single_text',
                'attr' => ['class' => 'datePicker']
            ])
            ->add('endDate', null, [
                'label' => 'Końcowa data nadgodzin',
                'widget' => 'single_text',
                'attr' => ['class' => 'datePicker']
            ])
            ->add('beginHour', null, [
                'label' => 'Przedział godzinowy nadgodzin',
                'attr' => ['class' => 'timePicker']
            ])
            ->add('endHour', null, [
                'label' => false,
                'attr' => ['class' => 'timePicker']
            ])
            ->add('description', null, [
                'label' => 'Dodatkowe informacje',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Overtime::class,
        ]);
    }
}
