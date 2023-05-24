<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class EvenementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evenement::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Evenements')
            ->setEntityLabelInSingular('Event')

            ->setPageTitle("index", "AG35 - Administration des Evenements")

            ->setPaginatorPageSize(10)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('titre'),
            DateTimeField::new('dateDebut')
                ->setFormat('dd/MM/yyyy hh:mm'),
            DateTimeField::new('dateFin')
                ->setFormat('dd/MM/yyyy hh:mm'),
            TextField::new('adresse'),
            ImageField::new('photo')
                ->setUploadDir('C:\Users\Djibril\ag35_website'),
            TextareaField::new('commentaire')
                ->setFormType(CKEditorType::class)
                ->hideOnIndex()
        ];
    }
}
