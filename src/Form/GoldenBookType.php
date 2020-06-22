<?php

namespace App\Form;

use App\Entity\GoldenBook;
use App\Entity\Villa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class GoldenBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Prénom'])
            ->add('departureDate', DateType::class, ['label' => 'Date de départ'])
            ->add('commentary', TextType::class, ['label' => 'Commentaire'])
            ->add('villa', EntityType::class, [
                'class' => Villa::class,
                'choice_label'=>'name'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GoldenBook::class,
        ]);
    }
}
