<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(CategorieRepository $categorieRepository, ProduitRepository $produitRepository): Response
    {
        return $this->render('index/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
            'sousCategories' => $categorieRepository->findMainCategory(),
            'produits' => $produitRepository->findAll()
        ]);
    }
}