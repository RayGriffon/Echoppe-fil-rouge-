<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Contient;
use App\Form\ConfirmationType;
use App\Repository\ClientRepository;
use App\Repository\AdresseRepository;
use App\Repository\ProduitRepository;
use App\Repository\CommandeRepository;
use App\Repository\ContientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/commande')]
class CommandeController extends AbstractController
{
    #[Route('/', name: 'app_commande')]
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }

    #[Route('/confirmation-donnee', name: 'app_confirmation_donnee', methods: ['GET', 'POST'])]
    public function confirmationDonnee(Request $request, ClientRepository $clientRepository, AdresseRepository $adresseRepository, CommandeRepository $commandeRepository, ProduitRepository $produitRepository, SessionInterface $session, ContientRepository $contientRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('security.login');
        }
    
        $client = $clientRepository->findOneBy(["profil" => $user]);
        if ($client === null) {
            $client = new Client();
            $client->setProfil($user);
        }
    
        $adresses = $adresseRepository->findBy(["client" => $client]);

        $form = $this->createForm(ConfirmationType::class, [
            'nom' => $client->getNom(),
            'prenom' => $client->getPrenom(),
            'email' => $user->getEmail(),
            'contact' => $client->getContact(),
            'adresses' => $adresses,
            'user' => $user,
            'client' => $client
        ], [
            "adresses" => $adresses
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commande = new Commande();
            $commande->setClient($client);
            $commande->setNomClient($form->get("nom")->getData());
            $commande->setPrenomClient($form->get("prenom")->getData());
            $commande->setAdresseLivraison($form->get("adresse1")->getData());
            $commande->setAdresseFacture($form->get("adresse2")->getData());

            $panier = $session->get("panier", []);
                foreach ($panier as $id => $quantite) {
                    $produit = $produitRepository->find($id);

                    $contient = new Contient();
                    $contient->setProduit($produit);
                    $contient->setNomProduit($produit->getNomProduit());
                    $contient->setPrixProduit($produit->getPrixProduit());
                    $contient->setQuantite($quantite);
                    $contient->setTvaProduit($produit->getTvaProduit());
                    $contient->setRefProduit($produit->getRefProduit());
                    $contient->setCommande($commande);

                    $contientRepository->save($contient, false);


                    $commande->addContient($contient);
                }

            $commandeRepository->save($commande, true);
            $session->clear();

            return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('panier/confirmation_adresse.html.twig', [
            'form' => $form,
            'user' => $user,
            'client' => $client,
            'adresses' => $adresses,
        ]);
    }
}
