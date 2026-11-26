<?php

namespace App\Controller\Admin;

use App\Entity\Guide;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;

class GuideCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Guide::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('guide PDF')
            ->setEntityLabelInPlural('Guides PDF')
            ->setPageTitle('index', 'Guides PDF (page « Guide de l\'étudiant »)')
            ->setPageTitle('new', 'Ajouter un guide PDF')
            ->setHelp('index', 'Le nom affiché sur le site est tiré du nom du fichier : nommez-le clairement, par exemple « livret-accueil-etudiant-2026.pdf ». Pour remplacer un guide, supprimez l\'ancien puis ajoutez le nouveau.')
            ->setPaginatorPageSize(10);
    }

    public function configureActions(Actions $actions): Actions
    {
        // Le fichier ne se remplace pas en modification (pas de colonne "updatedAt") : on passe par Supprimer + Ajouter.
        return $actions->disable(Action::EDIT);
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('pdfName', 'Fichier')
            ->hideOnForm()
            ->formatValue(fn ($value) => $value ? sprintf('<a href="/pdf/%s" target="_blank" rel="noopener">%s</a>', rawurlencode($value), htmlspecialchars($value)) : '')
            ->renderAsHtml();

        yield TextField::new('pdfFile', 'Fichier PDF')
            ->setFormType(VichFileType::class)
            ->setFormTypeOptions([
                'required' => true,
                'allow_delete' => false,
                'download_uri' => false,
                'attr' => ['accept' => 'application/pdf'],
            ])
            ->setHelp('PDF uniquement, 15 Mo maximum.')
            ->onlyWhenCreating();
    }
}
