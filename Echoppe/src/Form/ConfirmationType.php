<?php

namespace App\Form;

use App\Entity\Adresse;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Security;

class ConfirmationType extends AbstractType
{
    private $entityManager;
    private $user;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->user = $security->getUser();
        // dd($this->user);
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom')
        ->add('prenom')
        ->add('email')
        ->add('contact', TextType::class, [
            "label" => "Contact",
            "constraints" => [
            
            ],
            "attr" => ["class_css"]
        ])
        ->add('adresse1', EntityType::class, [
            'class' => Adresse::class,
            'choices' => $options['adresses'],
            'choice_label' => function($adresse){return ($adresse->getPays())." ".($adresse->getCp())." ".($adresse->getNomVille()).", ".($adresse->getNumRue())." ".($adresse->getNomRue());},
            'label' => 'Adresse de livraison',
            'required' => false,
        ])
        ->add('adresse2', EntityType::class, [
            'class' => Adresse::class,
            'query_builder' => function (EntityRepository $er) use ($options) {
                $client = $options['client'];
                return $er->createQueryBuilder('a')
                    ->where('a.client = :client')
                    ->setParameter('client', $this->user->getClient());
            },
            'choice_label' => function($adresse){return ($adresse->getPays())." ".($adresse->getCp())." ".($adresse->getNomVille()).", ".($adresse->getNumRue())." ".($adresse->getNomRue());},
            'label' => 'Adresse de facturation',
            'required' => false,
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'adresses' => [], // Défaut des adresses
            'client' => []
        ]);
    }
}
