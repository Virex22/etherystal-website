<?php

namespace App\Form;

use App\Entity\Etherystal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtherystalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('materialInstanceName')
            ->add('property')
            ->add('material')
            ->add('color')
            ->add('rarety')
            ->add('itemID')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etherystal::class,
        ]);
    }
}