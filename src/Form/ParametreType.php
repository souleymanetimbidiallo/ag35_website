<?php
// src/Form/ParametreType.php

namespace App\Form;

use App\Entity\Parametre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ParametreType extends AbstractType
{
    private $imageDir;
    public function __construct(string $directory)
    {
        $this->imageDir = $directory;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ...

            // ->add('site_name')
            ->add('site_adresse',)
            ->add('asso_img1', FileType::class, [

                'label' => 'Image',
                'required' => false,
            ]);

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $parametre = $event->getData();
            $form = $event->getForm();

            // Récupérer l'image téléchargée
            $imageFile = $form->get('asso_img1')->getData();

            if ($imageFile) {
                // Générer un nom unique pour l'image
                $imageName = md5(uniqid()) . '.' . $imageFile->guessExtension();

                // Déplacer l'image vers le répertoire souhaité
                $imageFile->move(
                    $this->imageDir, // Chemin vers le répertoire d'images
                    $imageName
                );

                // Mettre à jour la valeur du paramètre avec le nom de l'image
                $parametre->setValeur($imageName);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parametre::class,
            'image_directory' => null
        ]);
    }
}
