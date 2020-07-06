<?php

namespace App\Form;

use App\Entity\Negocio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NegocioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('website', UrlType::class, ['required' => false])
            ->add('correo', EmailType::class)
            ->add('emenuurl', null, ['required' => false])

            ->add('estatus', HiddenType::class, ['label' => '¿ Activo? '])
            ->add('logo',HiddenType::class,['required' => false])
            ->add('foto',HiddenType::class,['required' => false])
            ->add('facebook', UrlType::class, ['required' => false])
            ->add('twitter', UrlType::class, ['required' => false])
            ->add('instagram', UrlType::class, ['required' => false])
            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Negocio::class,
        ]);
    }
}
