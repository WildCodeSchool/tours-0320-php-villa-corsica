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
            ->add('name', TextType::class, ['label'=>'Nom de la villa'])
            ->add('location', TextareaType::class, ['label'=>'Adresse'])
            ->add('description', TextareaType::class, ['label'=>'Description détaillée'])
            ->add('nbRoom', IntegerType::class, ['label'=>'Nombre de chambres'])
            ->add('nbBed', IntegerType::class, ['label'=>'Nombre de lits'])
            ->add('nbBathroom', IntegerType::class, ['label'=>'Nombre de salles de bain'])
            ->add('capacity', IntegerType::class, ['label'=>'Capacité'])
            ->add('sqm', IntegerType::class, ['label'=>'Metres carrés'])
            ->add('posterFile', FileType::class, [
                'label'=>'Image de couverture sur la liste des villas',
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
                        'mimeTypesMessage'=>'Veuillez insérer un image en .jpg ou .png'
                    ])
                ]
            ])
            ->add('price', TextType::class, ['label'=>'Tarifs'])
         
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Villa::class,
        ]);
    }
}
