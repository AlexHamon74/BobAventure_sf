<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnIndex()
            ->setFormTypeOption('disabled', true),

            TextField::new('name')
            ->setLabel('Nom')
            ->setFormTypeOption('disabled', true),

            TextField::new('firstname')
            ->setLabel('Prenom')
            ->setFormTypeOption('disabled', true),

            EmailField::new('email')
            ->setLabel('Email')
            ->setFormTypeOption('disabled', true),

            TelephoneField::new('phone_number')
            ->setLabel('Numéro de téléphone')
            ->hideOnIndex()
            ->setFormTypeOption('disabled', true),

            TextField::new('subject')
            ->setLabel('Objet')
            ->setFormTypeOption('disabled', true),

            TextareaField::new('message')
            ->setLabel('Message')
            ->setFormTypeOption('disabled', true),

            DateField::new('created_at')
            ->setLabel('Créé le')
            ->setFormat('d/MM/Y')
            ->setFormTypeOption('disabled', true),

        ];
    }
    
}
