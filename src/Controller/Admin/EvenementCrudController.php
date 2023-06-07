<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
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
        yield IdField::new('id')
            ->hideOnForm();

        yield TextField::new('titre');
        yield DateTimeField::new('dateDebut')
            ->setFormat('dd/MM/yyyy hh:mm');
        yield DateTimeField::new('dateFin')
            ->setFormat('dd/MM/yyyy hh:mm');
        yield TextField::new('prix');
        yield TextField::new('adresse');
        yield ImageField::new('imageName')
            ->setBasePath('/img') // Chemin de base pour afficher l'image
            ->setUploadDir('public/img/ag35')
            ->setLabel('Photo') // Libellé du champ
            ->onlyOnForms(); // Afficher le champ uniquement sur les formulaires
        yield TextareaField::new('commentaire')
            ->hideOnIndex();
    }
}
