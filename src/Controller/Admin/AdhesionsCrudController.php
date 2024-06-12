<?php

namespace App\Controller\Admin;

use App\Entity\Adhesions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class AdhesionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adhesions::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
         {
            yield IdField::new('id');
            yield TextField::new('nom');
            yield TextField::new('prenom');
            yield EmailField::new('email');
            yield EmailField::new('tarif');
            yield MoneyField::new('montant')->setCurrency('EUR');

        }
    }
    
}
