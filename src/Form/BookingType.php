<?php

namespace App\Form;

use App\Model\Booking;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lastname', TextType::class, ['label' => 'Nom'])
                ->add('firstname', TextType::class, ['label' => 'Prénom'])
                ->add('address', TextType::class, ['label' => 'Adresse'])
                ->add('email', EmailType::class, ['label' => 'Email'])
                ->add('adults', ChoiceType::class, [
                    'label' => 'Adultes',
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
                    'widget' => 'single_text',
                ])
                ->add('departure', DateType::class, [
                    'label' => 'Départ',
                    'widget' => 'single_text',
                ])
                ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
