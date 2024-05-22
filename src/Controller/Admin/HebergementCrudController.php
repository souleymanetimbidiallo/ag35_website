<?php

namespace App\Controller\Admin;

use App\Entity\Hebergement;
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
use EasyCorp\Bundle\EasyAdminBundle\Field\FileField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait;
use EasyCorp\Bundle\EasyAdminBundle\Field\FieldTrait as BaseFieldTrait;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class HebergementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hebergement::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle("index", "AG35 - Gestion des demandes d'attestation d'hébergement")
            ->setPaginatorPageSize(10)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('nom');
        yield TextField::new('prenom');
        yield EmailField::new('email');
        yield TextField::new('universite');

        yield TextField::new('passeport')->hideOnIndex();
        yield UrlField::new('passeport', 'Télécharger Passeport')
            ->setCustomOption('base_path', '/uploads/fichiers')
            ->formatValue(function ($value, $entity) {
                return sprintf('<a href="%s/%s" target="_blank">%s</a>', '/uploads/fichiers', $entity->getPasseport(), $entity->getPasseport());
            });
    

        yield TextField::new('attestation')->hideOnIndex();
        yield UrlField::new('attestation', 'Télécharger Attestation')
            ->setCustomOption('base_path', '/uploads/fichiers')
            ->formatValue(function ($value, $entity) {
                return sprintf('<a href="%s/%s" target="_blank">%s</a>', '/uploads/fichiers', $entity->getAttestation(),$entity->getAttestation());
            });

        yield ImageField::new('passeport')
            ->setBasePath('/uploads')
            ->setUploadDir('public/uploads/fichiers')
            ->setLabel('Passeport')
            ->onlyOnForms();

        yield ImageField::new('attestation')
            ->setBasePath('/uploads')
            ->setUploadDir('public/uploads/fichiers')
            ->setLabel('Attestation')
            ->onlyOnForms();
    }
}