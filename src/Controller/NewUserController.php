<?php

namespace App\Controller;

use App\Entity\Horaires;
use App\Form\UserType;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class NewUserController extends AbstractController
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/newuser', name: 'new_user', methods: ['GET', 'POST'])]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $repohoraires = $doctrine->getRepository(Horaires::class);
        $horaires = $repohoraires->findAll();
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->remove('roles');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['ROLE_EMPLOYEE']);
            $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_employes');
        }

        return $this->render('new_user/index.html.twig', [
            'controller_name' => 'CarController',
            'user' => $user,
            'form' => $form->createView(),
            'horaires' => $horaires
        ]);
    }
}