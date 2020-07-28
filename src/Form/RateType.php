<?php

namespace App\Form;

use App\Entity\Rate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class RateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstPeriod', DateType::class, [
                'format' => 'dd-MM-yyyy',
                'label'=>'Du',
                ])
            ->add('secondPeriod', DateType::class, [
                'format' => 'dd-MM-yyyy',
                'label'=>'Jusqu\' au',
                ])
            ->add('price', MoneyType::class, [
                'label'=>'Prix par semaine',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rate::class,
        ]);
    }
}
