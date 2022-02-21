<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NegotiationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'email to be recontacted']
            ])
            ->add('typeOfRequest', ChoiceType::class, [
                'choices'  => [
                    'Bundle' => 0,
                    'lower or free for advertising' => 1,
                    'other' => 2
                ],
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['placeholder' => 'explain me your offer']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}