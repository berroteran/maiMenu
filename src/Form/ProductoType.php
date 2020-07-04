<?php

namespace App\Form;

use App\Entity\Producto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null, ['label' => 'Nombre del producto'])
            ->add('Description')
            ->add('idcategoria',ChoiceType::class, [
                'choices'  => [
                    'BEBIDAS' => 1,
                    'REPOSTERIA + DULCE' => 2,
                    'PARA EMPEZAR' => 3,
                    'WAFFLES' => 4,
                    'ENSALADAS' => 5,
                    'TARTINES' => 6,
                    'SÁNDWICHES' => 7,
                    '' => 8,
                    '' => 4,
                ],
                ])
            ->add('precio', NumberType::class)
            ->add('promocion',CheckboxType::class, ['label' => 'En Promocion?', 'required' => false, 'empty_data' => false ] )
            ->add('activo',HiddenType::class, ['label' => 'Activo?', 'required' => false, 'empty_data' => false ])

            ->add('imagen', HiddenType::class, ['label' => 'Imagen de Categoria', 'required' => false, 'attr'=> [ 'readonly' => true ] ] )


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
            'data_class' => Producto::class,
        ]);
    }
}
