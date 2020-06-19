<?php

namespace App\Form;

use App\Entity\Producto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
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
            ->add('activo',CheckboxType::class, ['label' => 'Activo?', 'required' => false, 'empty_data' => false ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Producto::class,
        ]);
    }
}
