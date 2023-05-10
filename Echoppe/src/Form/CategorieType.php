<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomCategorie')
            ->add('categoriesParents', EntityType::class, [
                'class' => Categorie::class,
                'label' => 'Catégorie parent',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => 'nomCategorie',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image de la catégorie',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
