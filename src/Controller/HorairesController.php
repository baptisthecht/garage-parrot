<?php

namespace App\Controller;

use App\Entity\Horaires;
use App\Form\HorairesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HorairesController extends AbstractController
{
    #[Route('/edithoraires/{id?0}', name: 'horaires.edit')]
    public function index(ManagerRegistry $doctrine,Request $request, $id): Response
    {
        $repo = $doctrine->getRepository(Horaires::class);
        $allhoraires = $repo->findAll();
        $horaires = $repo->find($id);
        $form = $this->createForm(HorairesType::class, $horaires);
        $form->remove('day');
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $entitymanager = $doctrine->getManager();
            $entitymanager->persist($horaires);
            $entitymanager->flush();
            if($horaires->isIsClosed()){
                $message = "L'horaire de ". $horaires->getDay(). " a bien été modifié : Fermé";
            }else{
                $message = "L'horaire de ". $horaires->getDay(). " a bien été modifié : Ouverture à ". $horaires->getOpenTime()->format('H:i')." et fermeture à " .$horaires->getCloseTime()->format('H:i');
            }
            $this->addFlash('success',  $message);
            return $this->redirectToRoute('app_first');
        }
        return $this->render('horaires/index.html.twig', [
            'controller_name' => 'HorairesController',
            'form' => $form->createView(),
            'horaire' => $horaires,
            'allhoraires' => $allhoraires
        ]);
    }
}
