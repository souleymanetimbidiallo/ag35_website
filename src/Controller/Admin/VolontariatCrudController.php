<?php

namespace App\Controller\Admin;

use App\Entity\Volontariat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;

class VolontariatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Volontariat::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm();

        yield TextField::new('titre');
        yield TextField::new('description');
        yield TextField::new('lieu');

        yield DateTimeField::new('dateDebut')
            ->setFormat('dd/MM/yyyy');
        yield DateTimeField::new('dateFin')
            ->setFormat('dd/MM/yyyy');
    }
    
}
