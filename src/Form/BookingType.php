<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\FormBuilderInterface;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lastname', TextType::class, ['label' => 'Nom', 'constraints' => new NotBlank()])
                ->add('firstname', TextType::class, ['label' => 'Prénom', 'constraints' => new NotBlank()])
                ->add('address', TextType::class, ['label' => 'Adresse', 'constraints' => new NotBlank()])
                ->add('email', EmailType::class, ['label' => 'Email', 'constraints' => new NotBlank()])
                ->add('adults', ChoiceType::class, [
                    'label' => 'Adultes',
                    'constraints' => new NotBlank(),
                    'choices'  => [
                        0,
                        1,
                        2,
                        3,
                        4,
                        5,
                        6,
                    ],
                ])
                ->add('kids', ChoiceType::class, [
                    'label' => 'Enfants',
                    'choices'  => [
                        0,
                        1,
                        2,
                        3,
                        4,
                    ],
                ])
                ->add('arrive', DateType::class, [
                    'label' => 'Arrivé',
                    'constraints' => new NotBlank(),
                    'widget' => 'single_text',
                ])
                ->add('departure', DateType::class, [
                    'label' => 'Départ',
                    'constraints' => new NotBlank(),
                    'widget' => 'single_text',
                ])
                ;
    }
}
