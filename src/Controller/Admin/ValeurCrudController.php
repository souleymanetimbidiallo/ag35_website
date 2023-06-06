<?php

namespace App\Controller\Admin;

use App\Entity\Valeur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ValeurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Valeur::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Valeurs-Asso')
            ->setEntityLabelInSingular('Valeur')

            ->setPageTitle("index", "AG35 - Administration des Valeurs-Association")

            ->setPaginatorPageSize(10)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('titre'),
            TextareaField::new('descriptif')
                ->hideOnIndex()
        ];
    }
}
