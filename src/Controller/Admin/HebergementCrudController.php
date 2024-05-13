<?php

namespace App\Controller\Admin;

use App\Entity\Hebergement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FileField; 
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class HebergementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hebergement::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            //->setEntityLabelInSingular('Liste des demandes d\'attestation d\'hébergement')
           // ->setDateFormat('...')
            ->setPageTitle("index", "AG35 -Gestion des demandes d'attestation d'hébergement")

            ->setPaginatorPageSize(10)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Nom'),
            TextField::new('Prenom'),
            EmailField::new('Email'),
            TextField::new('Universite'),
            //ImageField::new('passeport')
            //->setLabel('passeport')
            //->setBasePath('/uploads') // Chemin de base pour afficher l'image
            // ->setUploadDir('public/uploads/fichiers')
            // ->setLabel('passeport') // Libellé du champ
            // //->onlyOnForms(); // Afficher le champ uniquement sur les formulaires
              
        ];
    //     yield TextField::new('passeport');
    //     yield ImageField::new('passeport')
    //    ->setBasePath('/uploads') // Chemin de base pour afficher l'image
    //    ->setUploadDir('public/uploads/fichiers')
    //    ->setLabel('passeport') // Libellé du champ
    //    ->onlyOnForms(); // Afficher le champ uniquement sur les formulaires
    //     yield TextField::new('attestation');
    //     yield ImageField::new('attestation')
    //    ->setBasePath('/uploads') // Chemin de base pour afficher l'image
    //    ->setUploadDir('public/uploads/fichiers')
    //    ->setLabel('attestation') // Libellé du champ
    //    ->onlyOnForms();
    }
    
}
