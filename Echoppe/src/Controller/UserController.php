<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Client;
use App\Form\UserType;
use App\Form\ProfilType;
use App\Form\UserPasswordType;
use App\Repository\UserRepository;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    #[Security("is_granted('ROLE_USER') and user === user or is_granted('ROLE_ADMIN')")]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    #[Security("is_granted('ROLE_USER') and user === user or is_granted('ROLE_ADMIN')")]
    public function edit(Request $request, User $user, UserRepository $userRepository, UserPasswordHasherInterface $hasher): Response
    {

        if(!$this->getUser()){
            return $this->redirectToRoute('security.login');
        }

        if($this->getUser() !== $user){
            return $this->redirectToRoute('app_index');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($hasher->isPasswordValid($user, $form->getData()->getPlainPassword())){
                $user->setUpdatedAt(new \DateTimeImmutable());
                $userRepository->save($user, true);

                return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
            }
            
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/editProfil', name: 'app_user_edit_profil', methods: ['GET', 'POST'])]
    #[Security("is_granted('ROLE_USER') and user === user or is_granted('ROLE_ADMIN')")]
    public function test(Request $request, User $user, UserRepository $userRepository, ClientRepository $clientRepository): Response
    {

        if(!$this->getUser()){
            return $this->redirectToRoute('security.login');
        }

        if($this->getUser() !== $user){
            return $this->redirectToRoute('app_index');
        }

        $client = $clientRepository->findOneBy(["profil" => $user]);
        if ($client===null) {
            $client = new Client();
            $client->setProfil($user);
        }

        $form = $this->createForm(ProfilType::class, [
            "pseudo" => $user->getPseudo(),
            "nom" => $client->getNom(),
            "prenom" => $client->getPrenom(),
            "contact" => $client->getContact(),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted()  && $form->isValid()) {

            $client->setNom($form->get("nom")->getData());
            $client->setPrenom($form->get("prenom")->getData());
            $client->setContact($form->get("contact")->getData());

            $user->setPseudo($form->get("pseudo")->getData());

            $userRepository->save($user, false);
            $clientRepository->save($client, true);
            
            return $this->render('user/show.html.twig', [
                'user' => $user,
            ]);
            
        }

        return $this->renderForm('user/edit_profil.html.twig', [
            'form' => $form,
        ]);
    }    

    #[Route('/edition-mot-de-passe/{id}', 'app_user_edit_password', methods: ['GET', 'POST'])]
    #[Security("is_granted('ROLE_USER') and user === user or is_granted('ROLE_ADMIN')")]
    public function editPassword(
        User $choosenUser,
        Request $request,
        UserPasswordHasherInterface $hasher,
        UserRepository $userRepository
    ): Response {
        $form = $this->createForm(UserPasswordType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($choosenUser, $form->getData()['plainPassword'])) {
                $choosenUser->setUpdatedAt(new \DateTimeImmutable());
                $choosenUser->setPlainPassword(
                    $form->getData()['newPassword']
                );

                $this->addFlash(
                    'success',
                    'Le mot de passe a été modifié.'
                );

                $userRepository->save($choosenUser, true);

                return $this->redirectToRoute('app_user_index');
            } else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe renseigné est incorrect.'
                );
            }
        }

        return $this->render('user/edit_password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    #[Security("is_granted('ROLE_USER') and user === user or is_granted('ROLE_ADMIN')")]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
