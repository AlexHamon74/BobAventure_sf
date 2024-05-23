<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->setFormTypeOption('disabled', true),

            TextField::new('gender')
            ->setLabel('Genre')
            ->setFormTypeOption('disabled', true)
            ->hideOnIndex(),

            TextField::new('firstname')
            ->setLabel('Prénom')
            ->setFormTypeOption('disabled', true),

            TextField::new('name')
            ->setLabel('Nom')
            ->setFormTypeOption('disabled', true),

            EmailField::new('email')
            ->setFormTypeOption('disabled', true),

            TelephoneField::new('phone_number')
            ->setLabel('Numéro de téléphone')
            ->setFormTypeOption('disabled', true),

            DateField::new('birthdate')
            ->setLabel('Date de naissance')
            ->setFormTypeOption('disabled', true)
            ->setFormat('dd/MM/Y'),

            TextField::new('location')
            ->setLabel('Adresse / Ville')
            ->setFormTypeOption('disabled', true)
            ->hideOnIndex(),

            ArrayField::new('roles')
            ->hideOnIndex(),

            DateField::new('created_at')
            ->setLabel('Créé le')
            ->setFormTypeOption('disabled', true)
            ->setFormat('d/MM/Y')
            ->hideOnForm(),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW)
            ->ADD(Crud::PAGE_INDEX, Action::DETAIL);
    }
    
}
