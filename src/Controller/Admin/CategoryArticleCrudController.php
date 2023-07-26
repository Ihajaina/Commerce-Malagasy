<?php

namespace App\Controller\Admin;

use App\Entity\CategoryArticle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class CategoryArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryArticle::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', "Nom de la catégorie"),
            TextareaField::new('description', "Description de la catégorie"),
            ImageField::new('image')
                ->setBasePath('uploads/categories')
                ->setUploadDir('public/uploads/categories')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
        ];
    }
   
}
