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
                'class' => 'col-10'
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
                'class' => 'col-10'
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
                'class' => 'col-10'
            ],
            'label_attr' => [
                'class' => 'form-floating'
            ]
        ])
            ->add('universite', ChoiceType::class, [
                'choices' => [
                    'Universite Rennes' => 'Universite Rennes 1',
                    'Universite Rennes 2' => 'Universite Rennes 2',
                    'Autre' => 'autre',
                ],
                'row_attr' => [
                    'class' => 'col-10'
                ],
                'placeholder' => 'Choisissez une option',
                'required' => true,
            ])
            ->add('autre_universite', TextType::class, [
                'required' => false,
                'mapped' => false,
                'label' => false,
                'row_attr' => [
                    'class' => 'col-10'
                ],
                'attr' => [
                    'class' => 'autre-universite',
                    'placeholder' => 'Entrer Le nom de  l\'université'
                ]
            ])
            ->add('passeport', FileType::class, [
                'required' => true,
                'mapped' => false,
                'row_attr' => [
                    'class' => 'col-10'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                            'image/jpeg',
                            'image/pjpeg',
                            
                           
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier PDF valide ou une image jpg.',
                    ])
                ],
            ])

            ->add('attestation', FileType::class, [
                'required' => true,
                'mapped' => false,
                'row_attr' => [
                    'class' => 'col-10'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                            'image/jpeg',
                            'image/pjpeg', 
                            'image/png',
                            
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger un fichier PDF valide ou une image jpg.',
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
