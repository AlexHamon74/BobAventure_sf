<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ForgotPasswordType;
use App\Form\UserType;
use App\Form\ForgotPwdEmailType;
use App\Form\ForgotPwdSecretQuestionType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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

    // ---- CI-DESSOUS ON S'OCCUPE DE MODIFIER SON MOT DE PASSE ----

    // On affiche un formulaire d'email en cas de mot de passe oublié
    // Après avoir saisis l'email on vérifie si l'email existe
    #[Route('/login/pwdForgot', name:'pwd_forgot')]
    public function pwdForgot(Request $request, UserRepository $userRepository): Response
    {
        $form = $this->createForm(ForgotPwdEmailType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $email = $data['email'];
            $user = $userRepository->findOneByEmail($email);

            if($user) {
                $this->addFlash('success', 'Votre email à bien été trouvé');
                return $this->redirectToRoute('pwd_forgot_secret_question', ['id' => $user->getId()]);
            } else {
                $this->addFlash('danger', "Cet email n'existe pas");
                return $this->redirectToRoute('pwd_forgot');
            }
            
        }
        return $this->render('user/email.html.twig', [
            'form' => $form
        ]);
    }

    // On affiche un formulaire avec le question secrète si l'email existe
    // Puis on vérifie si la réponse est correct
    #[Route('/login/pwdForgot/secretQuestion/{id}', name:'pwd_forgot_secret_question')]
    public function secretQuestion(Request $request, User $user): Response
    {

        $form = $this->createForm(ForgotPwdSecretQuestionType::class, null,  [
            'secretQuestion' => $user->getSecretQuestion(),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $secretAnswer = $data['secretAnswer'];

            if($user->getSecretAnswer() === $secretAnswer) {
                $this->addFlash('success', 'La réponse est correct');
                return $this->redirectToRoute('edit_password', ['id' => $user->getId()]);
            } else {
                $this->addFlash('danger', 'La réponse est incorrect');
                return $this->redirectToRoute('pwd_forgot_secret_question', ['id' => $user->getId()]);
            }
            
        }
        return $this->render('user/secretQuestion.html.twig', [
            'form' => $form,
        ]);
    }


        // On affiche un formulaire avec le champ mot de passe afin de la modifier
        #[Route('/edit/password/{id}', name:'edit_password')]
        public function editPassword(EntityManagerInterface $em, Request $request, UserPasswordHasherInterface $hasher, UserRepository $userRepository, $id): Response
        {
    
            $user = $userRepository->find($id);

            $form = $this->createForm(ForgotPasswordType::class);
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid())
            {
                $user->setPassword(
                    $hasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );
            
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Votre mot de passe à bien été modifié');
            return $this->redirectToRoute('app_login');
            }
    
            return $this->render('user/editPassword.html.twig', [
                'form' => $form,
            ]);
        }

}
