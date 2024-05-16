<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => false
            ])
            ->add('firstname', TextType::class, [
                'required' => true,
                'label' => false
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'label' => false
            ])
            ->add('birthdate', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
                'label' => false
            ])
            ->add('gender', ChoiceType::class, [
                'placeholder' => 'Choisissez une option',
                'label' => false,
                'choices' => [
                    'Mr' => 'Mr',
                    'Mme' => 'Mme',
                    'Robot destructeur de planète' => 'Robot destructeur de planète',
                    'Helicoptère de combat' => 'Helicoptère de combat',
                    'Autre' => 'Autre'
                ],
                'required' => false
            ])
            ->add('phone_number', TextType::class, [
                'required' => false,
                'label' => false
            ])
            ->add('location', TextType::class, [
                'required' => false,
                'label' => false
            ])
            ->add('secret_question', ChoiceType::class, [
                'placeholder' => 'Choisissez une option',
                'label' => false,
                'choices' => [
                    'Quel est le nom de votre premier animal de compagnie ?' =>  'Quel est le nom de votre premier animal de compagnie ?',
                    'Quelle est le nom de votre ville de naissance ?' =>  'Quelle est le nom de votre ville de naissance ?',
                    'Quel est le nom de votre film préféré ?' => 'Quel est le nom de votre film préféré ?',
                ],
            ])
            ->add('secret_answer', TextType::class, [
                'label' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
