<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    // Fonction pour afficher le user connecté
    #[Route('/user/{id<\d+>}', name: 'user')]
    public function index(User $user): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('index');
        }
        return $this->render('user/user.html.twig', [
            'user' => $user,
        ]);
    }

    // Fonction pour éditer le profil du user connecté
    #[Route('/user/{id<\d+>}/edit', name:'user_edit')]
    public function edit(EntityManagerInterface $em, User $user, Request $request): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            $this->addFlash('success', 'Les modifications ont bien été effectuées');
            return $this->redirectToRoute('user');
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form,
            'user' => $user
        ]);
    }
}
