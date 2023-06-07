<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numRue', IntegerType::class, [
                'label' => 'Numéro de rue',
                'label_attr' => [
                    'class' => 'form-label mx-5'
                ],
                'attr' => [
                    'class' => 'form-control mx-5',
                    'style' => 'max-width: 75%;'
                ],
                'required' => false,
                'constraints' => [
                    new Length(['max' => 255]),
                ]
            ])
            ->add('nomRue', TextType::class, [
                'label' => 'Nom de rue',
                'label_attr' => [
                    'class' => 'form-label mx-5'
                ],
                'attr' => [
                    'class' => 'form-control mx-5',
                    'style' => 'max-width: 75%; margin-bottom: 10px;'
                ],
                'required' => false,
                'constraints' => [
                    new Length(['max' => 255]),
                ]
            ])
            ->add('nomVille', TextType::class, [
                'label' => 'Nom de ville',
                'label_attr' => [
                    'class' => 'form-label mx-5'
                ],
                'attr' => [
                    'class' => 'form-control mx-5',
                    'style' => 'max-width: 75%; margin-bottom: 10px;'
                ],
                'required' => false,
                'constraints' => [
                    new Length(['max' => 255]),
                ]
            ])
            ->add('cp', TextType::class, [
                'label' => 'Code postal',
                'label_attr' => [
                    'class' => 'form-label mx-5'
                ],
                'attr' => [
                    'class' => 'form-control mx-5',
                    'style' => 'max-width: 75%; margin-bottom: 10px;'
                ],
                'required' => false,
                'constraints' => [
                    new Length(['max' => 255]),
                ]
            ])
            ->add('pays', TextType::class, [
                'label' => 'Pays',
                'label_attr' => [
                    'class' => 'form-label mx-5'
                ],
                'attr' => [
                    'class' => 'form-control mx-5',
                    'style' => 'max-width: 75%; margin-bottom: 10px;'
                ],
                'required' => false,
                'constraints' => [
                    new Length(['max' => 255]),
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-primary mx-5'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}