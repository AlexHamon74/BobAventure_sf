<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('birthdate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de naissance',
                'required' => true
            ])
            ->add('email', TextType::class)

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Mot de passe',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez remplir ce champ',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire au moins 6 caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
