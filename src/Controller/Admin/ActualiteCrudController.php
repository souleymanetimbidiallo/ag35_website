<?php

namespace App\Controller\Admin;

use App\Entity\Actualite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ActualiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actualite::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Actualites')
            ->setEntityLabelInSingular('Actu')

            ->setPageTitle("index", "AG35 - Administration des Actualités")

            ->setPaginatorPageSize(10)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm();

        yield TextField::new('titre');
        yield DateTimeField::new('datePublication')
            ->setFormat('dd/MM/yyyy hh:mm');
        yield TextField::new('imageName');
        yield ImageField::new('imageName')
            ->setBasePath('/img') // Chemin de base pour afficher l'image
            ->setUploadDir('public/img/ag35')
            ->setLabel('Photo') // Libellé du champ
            ->onlyOnForms(); // Afficher le champ uniquement sur les formulaires
        yield TextareaField::new('description')
            ->hideOnIndex();
    }
}
