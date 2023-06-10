<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Services')
            ->setEntityLabelInSingular('Service')

            ->setPageTitle("index", "AG35 - Administration des Services")

            ->setPaginatorPageSize(10)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm();

        yield TextField::new('titre');
        yield TextField::new('imageName');
        yield ImageField::new('imageName')
            ->setBasePath('/img') // Chemin de base pour afficher l'image
            ->setUploadDir('public/img/ag35')
            ->setLabel('Photo') // Libellé du champ
            ->onlyOnForms(); // Afficher le champ uniquement sur les formulaires
        yield TextareaField::new('descriptif')
            ->hideOnIndex();
    }
}
