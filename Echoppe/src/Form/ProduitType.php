<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Fournisseur;
use App\Entity\Produit;
use App\Repository\CategorieRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomProduit')
            ->add('descriptionProduit')
            ->add('prixProduit')
            ->add('tvaProduit')
            ->add('refProduit')
            ->add('isOnline')
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
                'label' => 'Fournisseur',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => 'nomFournisseur',
            ])
            ->add('categories', EntityType::class, [
                'class' => Categorie::class,
                'label' => 'Categorie',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => 'nomCategorie',
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
