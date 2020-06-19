<?php

namespace App\Form;

use App\Entity\Categorias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion', TextareaType::class)
            ->add('activo', CheckboxType::class, ['label' => 'Activa?'] )
            //->add('fechaAlta' , DateType::class, ['required' => false, 'empty_data' => '','attr'=> [ 'readonly' => true ]])
            //->add('fechaModificacion', DateType::class, ['attr'=> [ 'readonly' => true ]])
            ->add('usuarioAlta', TextType::class, ['attr'=> [ 'readonly' => true ]])
            ->add('usuarioBaja',TextType::class , ['attr'=> [ 'readonly' => true ]])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categorias::class,
            'csrf_protection' => false
        ]);
    }
}
