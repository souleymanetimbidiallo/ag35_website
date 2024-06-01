<?php

namespace App\Controller\Admin;

use App\Entity\Categoriesujet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoriesujetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categoriesujet::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
             ->hideOnForm(),
            TextField::new('subject'),
        ];
    }
    
}
