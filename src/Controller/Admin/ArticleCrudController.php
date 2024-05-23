<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Article;
use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->setFormTypeOption('disabled', true),

            TextField::new('title')
            ->setLabel('Titre'),
            
            TextEditorField::new('content')
            ->setLabel('Contenu'),

            ChoiceField::new('category')
            ->setLabel('Catégorie'),
            
            ImageField::new('main_image')
            ->setLabel('Image de couverture')
            ->setBasePath('/uploads/images/')
            ->setUploadDir('public/uploads/images')
            ->setUploadedFileNamePattern('[randomhash].[extension]'),
            
            DateField::new('published_at')
            ->setLabel('Publié le')
            ->setFormat('dd/MM/Y'),

        ];
    }
}
