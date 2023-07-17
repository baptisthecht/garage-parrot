<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Horaires;
use App\Entity\Service;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/', name: 'app_first')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repositoryservices = $doctrine->getRepository(Service::class);
        $services = $repositoryservices->findAll();
        
        $repositoryavis = $doctrine->getRepository(Avis::class);
        $avis = $repositoryavis->findAll();

        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
            'services' => $services,
            'avis' => $avis,
            'horaires' => $this->getHoraires($doctrine)
        ]);
    }

    public function getHoraires(ManagerRegistry $doctrine) : array {
        $repositoryhoraires = $doctrine->getRepository(Horaires::class);
        $horaires = $repositoryhoraires->findAll();
        return $horaires;
    }

}
