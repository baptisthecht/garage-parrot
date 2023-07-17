<?php

namespace App\Controller;

use App\Entity\Horaires;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $horairesrepo = $doctrine->getRepository(Horaires::class);
        $horaires = $horairesrepo->findAll();

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'horaires' => $horaires
        ]);
    }
}
