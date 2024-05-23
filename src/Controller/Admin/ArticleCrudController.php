<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Article;
use App\Form\ArticleImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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

            AssociationField::new('category')
            ->setLabel('Catégorie'),
            
            ImageField::new('main_image')
            ->setLabel('Image de couverture')
            ->setBasePath('/uploads/images/')
            ->setUploadDir('public/uploads/images')
            ->setUploadedFileNamePattern('[randomhash].[extension]'),
            
            DateField::new('published_at')
            ->hideOnForm()
            ->setLabel('Publié le')
            ->setFormat('dd/MM/Y'),

            CollectionField::new('articleImages')
            ->setLabel('Image(s) pour les articles')
            // ->setFormType(FileType::class)
            // ->setFormTypeOptions([
            //     "multiple" => true,
            //     ])
            //     ->setBasePath('uploads/images/')
            //     ->setUploadDir('public/uploads/images')
            //     ->setUploadedFileNamePattern("[randomhash].[extension]"),
            // ImageField::new('articleImages')
            // ->setLabel('Image(s) pour les articles')
            // ->hideOnIndex(),

        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->ADD(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
