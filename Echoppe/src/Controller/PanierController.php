<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/panier', name: 'panier_')]
class PanierController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $panier = $session->get("panier", []);

        $dataPanier = [];
        $total = 0;

        foreach ($panier as $id => $quantite) {
            $produit = $produitRepository->find($id);
            $dataPanier[] = [
                "produit" => $produit,
                "quantite" => $quantite
            ];

            $total += $produit->getPrixProduit() * $quantite;
        }

        return $this->render('panier/index.html.twig', compact("dataPanier", "total"));
    }

    #[Route('/add/{id}', name:'add')]
    public function add(Produit $produit, SessionInterface $session)
    {
        //Permet de récuperer le panier actuel
        $panier = $session->get("panier", []);
        $id = $produit->getId();

        if (!empty($panier[$id])) {
            $panier[$id]++;
        }else{
            $panier[$id]=1;
        }

        //Sauvegarde en session
        $session->set("panier", $panier);

        return $this->redirectToRoute("panier_index");
    }

    #[Route('/remove/{id}', name:'remove')]
    public function remove(Produit $produit, SessionInterface $session)
    {
        //Permet de récuperer le panier actuel
        $panier = $session->get("panier", []);
        $id = $produit->getId();

        if (!empty($panier[$id])) {
            if($panier[$id] > 1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
            
        }
        
        //Sauvegarde en session
        $session->set("panier", $panier);

        return $this->redirectToRoute("panier_index");
    }

}
