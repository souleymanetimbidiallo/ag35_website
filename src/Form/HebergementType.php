<?php

namespace App\Form;

use App\Entity\Hebergement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\EmailType;



class HebergementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Entrez votre Nom',
            ],
            'label' => 'Nom',
            'row_attr' => [
                'class' => 'col-3'
            ],
            'label_attr' => [
                'class' => 'form-floating'
            ]
        ]) ->add('prenom', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Entrez votre prénom',
            ],
            'label' => 'Prénom',
            'row_attr' => [
                'class' => 'col-3'
            ],
            'label_attr' => [
                'class' => 'form-floating'
            ]
        ])
        ->add('email', EmailType::class, [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Email',
            ],
            'label' => 'E-mail',
            'row_attr' => [
                'class' => 'col-3'
            ],
            'label_attr' => [
                'class' => 'form-floating'
            ]
        ])
            ->add('universite', ChoiceType::class, [
                'choices' => [
                    'Universite Rennes 1' => 'Universite Rennes 1',
                    'Universite Rennes 2' => 'Universite Rennes 2',
                    'Autre' => 'autre',
                ],
                'placeholder' => 'Choisissez une option',
                'required' => true,
            ])
            ->add('autre_universite', TextType::class, [
                'required' => false,
                'mapped' => false,
                'label' => false,
                'attr' => [
                    'class' => 'autre-universite',
                    'placeholder' => 'Entrer Le nom de  l\'université'
                ]
            ])
            ->add('passeport', FileType::class, [
                'required' => true,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                           
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier PDF valide.',
                    ])
                ],
            ])

            ->add('attestation', FileType::class, [
                'required' => true,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                            
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier PDF valide.',
                    ])
                ],
             ]);
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hebergement::class,
        ]);
    }
}
