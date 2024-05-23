<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),

            TextField::new('name')
            ->setLabel('Nom'),

            TextField::new('firstname')
            ->setLabel('Prenom'),

            EmailField::new('email')
            ->setLabel('Email'),

            TelephoneField::new('phone_number')
            ->setLabel('Numéro de téléphone'),

            TextField::new('subject')
            ->setLabel('Objet'),

            TextareaField::new('message')
            ->hideOnIndex()
            ->setLabel('Message'),

            DateField::new('created_at')
            ->setLabel('Créé le')
            ->setFormat('d/MM/Y')

        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW, Action::EDIT)
            ->ADD(Crud::PAGE_INDEX, Action::DETAIL);
    }
    
}
