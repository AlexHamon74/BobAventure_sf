<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\ForgotPwdEmailType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    // Fonction pour afficher le user connecté
    #[Route('/user/{id}', name: 'user')]
    public function index(User $user): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('index');
        }
        if($this->getUser() !== $user) {
            return $this->redirectToRoute('index');
        }

        return $this->render('user/user.html.twig', [
            'user' => $user,
        ]);
    }

    
    // Fonction pour éditer le profil du user connecté
    #[Route('/user/edit/{id}', name:'user_edit')]
    public function edit(EntityManagerInterface $em, User $user, Request $request): Response
    {
        if(!$this->getUser()) {
            return $this->redirectToRoute('index');
        }
        if($this->getUser() !== $user) {
            return $this->redirectToRoute('index');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Les modifications ont bien été effectuées');
            return $this->redirectToRoute('user', ['id' => $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form,
            'user' => $user
        ]);
    }



    // Fonction pour afficher un formulaire d'email en cas de mot de passe oublié
    // Après avoir saisis l'email on vérifie si l'email existe
    #[Route('/login/pwdForgot', name:'pwd_forgot')]
    public function pwdForgot(Request $request): Response
    {
        $form = $this->createForm(ForgotPwdEmailType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $form = $form->getData();
            
            dd($form);
        }


        return $this->render('user/email.html.twig', [
            'form' => $form
        ]);
    }
}
