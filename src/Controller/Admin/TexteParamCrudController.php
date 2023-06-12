<?php

namespace App\Controller\Admin;

use App\Entity\TexteParam;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TexteParamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TexteParam::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Textes')
            ->setEntityLabelInSingular('Texte')

            ->setPageTitle("index", "AG35 - Administration des textes")

            ->setPaginatorPageSize(10)
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm();
        yield ChoiceField::new('titre')
            ->setChoices([
                'texte_page_apropos' => 'texte_about',
                'texte_page_actualites' => 'texte_actu',
                'texte_page_guide' => 'texte_guide',
                'texte_page_adhesion' => 'texte_adhesion',
                // Ajoutez d'autres options si nécessaire
            ]);
        yield TextareaField::new('description')
            ->hideOnIndex();
    }
}
