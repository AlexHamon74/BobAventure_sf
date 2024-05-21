<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

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
            ->hideOnIndex()
            ->setFormTypeOption('disabled', true),

            TextField::new('title')
            ->setLabel('Titre'),
            
            TextEditorField::new('content')
            ->setLabel('Contenu'),

            TextField::new('category.name')
            ->setLabel('Catégorie'),
            
            ImageField::new('main_image')
            ->setLabel('Image de couverture'),
            
            DateField::new('published_at')
            ->setLabel('Publié le')
            ->setFormat('dd/MM/Y'),
        ];
    }
}
