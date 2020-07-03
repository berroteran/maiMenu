<?php

namespace App\Form;

use App\Entity\Categorias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Button;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;


class CategoriasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion', TextareaType::class)
            ->add('activo', HiddenType::class, ['label' => 'Activa?'] )
            //->add('fechaAlta' , DateType::class, ['required' => false, 'empty_data' => '','attr'=> [ 'readonly' => true ]])
            //->add('fechaModificacion', DateType::class, ['attr'=> [ 'readonly' => true ]])
            ->add('image', HiddenType::class, ['label' => 'Imagen de Categoria', 'required' => false, 'attr'=> [ 'readonly' => true ] ] )


            ->add('imageFile', FileType::class, [
                'label' => 'Cargar Imagen',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                /*'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/jpg','application/x-jpg',
                            'application/png','application/x-png',
                        ],
                        'mimeTypesMessage' => 'por favor cargar una imagen valida.',
                    ])
                ],
                */
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categorias::class,
        ]);
    }
}
