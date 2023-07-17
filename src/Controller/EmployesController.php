<?php

namespace App\Controller;

use App\Entity\Horaires;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployesController extends AbstractController
{
    #[Route('/employes', name: 'app_employes')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repohoraires = $doctrine->getRepository(Horaires::class);
        $horaires = $repohoraires->findAll();

        $repoemployes = $doctrine->getRepository(User::class);
        $employes = $repoemployes->findAll();

        return $this->render('employes/index.html.twig', [
            'controller_name' => 'EmployesController',
            'horaires' => $horaires,
            'employes' => $employes
        ]);
    }

    #[Route('/employes/delete/{id?0}', name: 'app_employes_deleteemployee')]
    public function deleteEmployee(ManagerRegistry $doctrine, $id): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $repoemployes = $doctrine->getRepository(User::class);
        $employee = $repoemployes->find($id);
        if($employee){
            $name = $employee->getPrenom(). ' '. $employee->getNom();
            $manager = $doctrine->getManager();
            $manager->remove($employee);
            $manager->flush();
            $this->addFlash('success', "L'employé ".$name." a bien été supprimé.");
        }else{
            $this->addFlash('error', "Impossible, l'employé n'existe pas.");
        }
        return $this->redirectToRoute('app_employes');
    }
}
