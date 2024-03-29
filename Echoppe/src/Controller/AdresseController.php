<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\AdresseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/adresse')]
#[IsGranted('ROLE_USER')]
class AdresseController extends AbstractController
{
    #[Route('/', name: 'app_adresse_index', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function index(AdresseRepository $adresseRepository): Response
    {
        return $this->render('adresse/index.html.twig', [
            'adresses' => $adresseRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'app_adresse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AdresseRepository $adresseRepository, User $user): Response
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);
        $adresse->setClient($user->getClient());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adresseRepository->save($adresse, true);

            return $this->redirectToRoute('app_user_show', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adresse/new.html.twig', [
            'adresse' => $adresse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adresse_show', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function show(Adresse $adresse): Response
    {
        return $this->render('adresse/show.html.twig', [
            'adresse' => $adresse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_adresse_edit', methods: ['GET', 'POST'])]
    #[Security("is_granted('ROLE_USER') and user === adresse.getClient().getProfil() or is_granted('ROLE_ADMIN')")]
    public function edit(Request $request, Adresse $adresse, AdresseRepository $adresseRepository): Response
    {
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adresseRepository->save($adresse, true);

            return $this->redirectToRoute('app_user_show', ['id' => $adresse->getClient()->getProfil()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adresse/edit.html.twig', [
            'adresse' => $adresse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adresse_delete', methods: ['POST'])]
    #[Security("is_granted('ROLE_USER') and user === adresse.getClient().getProfil() or is_granted('ROLE_ADMIN')")]
    public function delete(Request $request, Adresse $adresse, AdresseRepository $adresseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresse->getId(), $request->request->get('_token'))) {
            $adresseRepository->remove($adresse, true);
        }

        return $this->redirectToRoute('app_user_show', ['id' => $adresse->getClient()->getProfil()->getId()], Response::HTTP_SEE_OTHER);
    }
}