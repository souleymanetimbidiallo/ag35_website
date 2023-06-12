<?php

namespace App\Controller\Admin;

use App\Entity\MesImage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MesImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MesImage::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Images')
            ->setEntityLabelInSingular('image')

            ->setPageTitle("index", "AG35 - Administration des Images")

            ->setPaginatorPageSize(10)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('imageName1');
        yield ImageField::new('imageName1')
            ->setBasePath('/img') // Chemin de base pour afficher l'image
            ->setUploadDir('public/img/ag35')
            ->setLabel('logo_topbar') // Libellé du champ
            ->onlyOnForms(); // Afficher le champ uniquement sur les formulaires
        yield TextField::new('imageName2');
        yield ImageField::new('imageName2')
            ->setBasePath('/img') // Chemin de base pour afficher l'image
            ->setUploadDir('public/img/ag35')
            ->setLabel('imgFond1') // Libellé du champ
            ->onlyOnForms();
        yield TextField::new('imageName3');
        yield ImageField::new('imageName3')
            ->setBasePath('/img') // Chemin de base pour afficher l'image
            ->setUploadDir('public/img/ag35')
            ->setLabel('imgFond2') // Libellé du champ
            ->onlyOnForms();
        yield TextField::new('imageName4');
        yield ImageField::new('imageName4')
            ->setBasePath('/img') // Chemin de base pour afficher l'image
            ->setUploadDir('public/img/ag35')
            ->setLabel('imgFond3') // Libellé du champ
            ->onlyOnForms();
        yield TextField::new('imageName5');
        yield ImageField::new('imageName5')
            ->setBasePath('/img') // Chemin de base pour afficher l'image
            ->setUploadDir('public/img/ag35')
            ->setLabel('imgVideo') // Libellé du champ
            ->onlyOnForms();
        yield TextField::new('imageName6');
        yield ImageField::new('imageName6')
            ->setBasePath('/img') // Chemin de base pour afficher l'image
            ->setUploadDir('public/img/ag35')
            ->setLabel('logoApropos') // Libellé du champ
            ->onlyOnForms();
        yield TextField::new('imageName7');
        yield ImageField::new('imageName7')
            ->setBasePath('/img') // Chemin de base pour afficher l'image
            ->setUploadDir('public/img/ag35')
            ->setLabel('guineeApropos') // Libellé du champ
            ->onlyOnForms();
        yield TextField::new('imageName8');
        yield ImageField::new('imageName8')
            ->setBasePath('/img') // Chemin de base pour afficher l'image
            ->setUploadDir('public/img/ag35')
            ->setLabel('img de Fond pour les pages') // Libellé du champ
            ->onlyOnForms();
    }
}
