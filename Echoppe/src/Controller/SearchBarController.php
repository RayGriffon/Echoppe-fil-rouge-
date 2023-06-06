<?php

namespace App\Controller;

use App\Form\SearchProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/search')]
class SearchBarController extends AbstractController
{
    #[Route('/', name: 'search', methods: ['GET','POST'])]
    public function index(Request $request, ProduitRepository $produitRepository): Response
    {
        $form = $this->createForm(SearchProduitType::class);
        $search = $form->handleRequest($request);

        if($form->isSubmitted()){
            $produits = $produitRepository->search($search->get('mots')->getData());

            // dd($produits);
            // redirect sur le resultat
            return $this->render('search_bar/index.html.twig', [
                'produits' => $produits
            ]);
        }

        return $this->render('partials/_form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
