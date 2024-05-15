<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForgotPwdSecretQuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $secretQuestion = $options['secretQuestion'];
        $builder
            ->add('secretQuestion', TextType::class, [
                'label' => 'Question secrète',
                'disabled' => true,
                'attr' => [
                    'readonly' => true,
                    'value' => $secretQuestion
                ]
            ])
            ->add('secretAnswer', TextType::class, [
                'label' => 'Réponse',
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider'
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'secretQuestion' => null,
        ]);
    }
}