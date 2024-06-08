<?php

namespace App\Controller\Admin;

use App\Entity\Membre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class MembreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Membre::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Membres')
            ->setEntityLabelInSingular('Membre')
            ->setPageTitle("index", "AG35 - Administration des Membres")
            ->setPaginatorPageSize(10);
    }



    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm();

        yield TextField::new('nom');
        yield TextField::new('prenom');
        yield EmailField::new('email');
        yield TelephoneField::new('telephone');
        yield TextField::new('villeOrigine');
        yield TextField::new('profession');

        yield DateTimeField::new('dateAdhesion')
            ->setFormat('dd/MM/yyyy');

        yield BooleanField::new('bureau')
            ->renderAsSwitch(false);

        yield TextField::new('fonction');

        yield ImageField::new('imageName')
            ->setBasePath('/img') // Chemin de base pour afficher l'image
            ->setUploadDir('public/img/ag35')
            ->setLabel('Photo') // Libellé du champ
            ->onlyOnForms(); // Afficher le champ uniquement sur les formulaires


    }

}
