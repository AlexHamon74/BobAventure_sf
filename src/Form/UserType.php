<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => true
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => true
            ])
            ->add('birthdate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de naissance',
                'required' => true
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Genre',
                'placeholder' => 'Choisissez une option',
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
                'label' => 'Numéro de téléphone',
                'required' => false
            ])
            ->add('location', TextType::class, [
                'label' => 'Ville',
                'required' => false,
            ])
            ->add('secret_question', ChoiceType::class, [
                'label' => 'Question secrète',
                'placeholder' => 'Choisissez une option',
                'choices' => [
                    'Quel est le nom de votre premier animal de compagnie ?' =>  'Quel est le nom de votre premier animal de compagnie ?',
                    'Quelle est le nom de votre ville de naissance ?' =>  'Quelle est le nom de votre ville de naissance ?',
                    'Quel est le nom de votre film préféré ?' => 'Quel est le nom de votre film préféré ?',
                ],
            ])
            ->add('secret_answer', TextType::class, [
                'label' => 'Réponse'
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
