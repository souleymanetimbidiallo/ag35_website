<?php

namespace App\Controller\Admin;

use App\Entity\Volontaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;

class VolontaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Volontaire::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
           

            ->setPageTitle("index", "Listes des personnes volontaires")

            ->setPaginatorPageSize(10)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }




    
    public function configureFields(string $pageName): iterable
    {
       // yield IdField::new('id');
       
         yield TextField::new('nom');
        yield TextField::new('prenom');
        yield EmailField::new('email');
        yield TextField::new('telephone');
        yield TextareaField::new('motivation');
    }
    
}
