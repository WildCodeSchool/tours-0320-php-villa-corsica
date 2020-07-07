<?php

namespace App\Form;

use App\Entity\Picture;
use App\Entity\Villa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VillaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('location', TextareaType::class)
            ->add('description', TextareaType::class)
            ->add('nbRoom', IntegerType::class)
            ->add('nbBed', IntegerType::class)
            ->add('nbBathroom', IntegerType::class)
            ->add('capacity', IntegerType::class)
            ->add('sqm', IntegerType::class)
            ->add('priceFrom', IntegerType::class)
            ->add('posterFile', FileType::class, [
                'label'=>'image principale',
                'mapped'=>false,
                'required'=>true,
                'constraints'=>[
                    new File([
                        'maxSize'=>'2048k',
                        'mimeTypes'=>[
                            'image/jpeg',
                            'image/png',
                            'image/jpg'
                        ],
                        'mimeTypesMessage'=>'Merci de insérer un image jpg ou png'
                    ])
                ]
            ])
         
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Villa::class,
        ]);
    }
}
