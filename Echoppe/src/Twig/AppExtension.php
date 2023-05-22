<?php

namespace App\Twig;

use Twig\TwigFunction;
use App\Repository\ProduitRepository;
use Twig\Extension\AbstractExtension;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('totalProduit', [$this, 'totalProduit']),
        ];
    }

    public function totalProduit(SessionInterface $session)
    {
        $panier = $session->get("panier", []);

        $dataPanier = [];
        $total = 0;

        foreach ($panier as $id => $quantite) {
            $dataPanier[] = [
                "quantite" => $quantite
            ];
            $total += $quantite;
        }

        return $total;
    }
}