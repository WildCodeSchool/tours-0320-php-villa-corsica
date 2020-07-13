<?php

namespace App\Form;

use App\Entity\Picture;
use App\Form\VillaType;
use App\Entity\Villa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('photoFile', FileType::class, [
                'label'=> 'Ajoutez une photo depuis votre ordinateur',
                'mapped'=> false,
                'required'=> true,
                'constraints'=>[
                    new File([
                        'maxSize'=>'2048k',
                        'mimeTypes'=>[
                            'image/jpeg',
                            'image/png',
                            'image/jpg'
                        ],
                        'mimeTypesMessage'=>'Insérez une image en .jpg ou.jpeg ou .png'
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
