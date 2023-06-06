<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $serviceRepository = $options['service_repository'];
        $titres = $serviceRepository->findAllTitres();

        $choices = [];
        foreach ($titres as $titre) {
            $choices[$titre] = (string) $titre;
        }
        // dd($choices);

        $builder
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez votre prénom',
                ],
                'label' => 'Prénom',
                'row_attr' => [
                    'class' => 'col-12'
                ],
                'label_attr' => [
                    'class' => 'form-floating'
                ]
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez votre nom',
                ],
                'label' => 'Nom',
                'row_attr' => [
                    'class' => 'col-12'
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
                    'class' => 'col-12'
                ],
                'label_attr' => [
                    'class' => 'form-floating'
                ]
            ])
            ->add('telephone', TelType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Téléphone',
                ],
                'label' => 'Téléphone',
                'row_attr' => [
                    'class' => 'col-12'
                ],
                'label_attr' => [
                    'class' => 'form-floating'
                ]
            ])
            ->add('titre', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nos Services',
                'choices' => $choices,
                'row_attr' => [
                    'class' => 'col-12'
                ],
                'label_attr' => [
                    'class' => 'form-floating'
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ecrire votre message ici',
                    'style' => 'height: 200px',
                ],
                'label' => 'Message',
                'row_attr' => [
                    'class' => 'col-12'
                ],
                'label_attr' => [
                    'class' => 'form-floating'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary rounded-pill py-3 px-5',
                ],
                'label' => 'Envoyer',
                'row_attr' => [
                    'class' => 'col-12'
                ]
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'service_repository' => null,
        ]);
    }
}
