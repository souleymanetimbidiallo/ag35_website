<?php

namespace App\Controller\Admin;

use App\Entity\Guide;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GuideCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Guide::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('PDF')
            ->setEntityLabelInSingular('pdf')

            ->setPageTitle("index", "AG35 - Administration du pdf pour Guide")

            ->setPaginatorPageSize(10)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('pdfName');
        yield ImageField::new('pdfName')
            ->setBasePath('/img') // Chemin de base pour afficher l'image
            ->setUploadDir('public/img/ag35')
            ->setLabel('pdf_pour_guide') // Libellé du champ
            ->onlyOnForms(); // Afficher le champ uniquement sur les formulaires
    }
}
