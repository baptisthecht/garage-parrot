<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Horaires;
use App\Form\AvisType;
use App\Controller\FirstController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/avis')]
class AvisController extends AbstractController
{
    #[Route('/', name: 'avis')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Avis::class);
        $avis = $repository->findAll();

        $repositoryhoraires = $doctrine->getRepository(Horaires::class);
        $horaires = $repositoryhoraires->findAll();

        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController',
            'avis' => $avis,
            'horaires' => $horaires
        ]);
    }

    #[Route('/add', name: 'avis.add')]
    public function addAvis(Request $request, ManagerRegistry $doctrine): Response
    {
        $repositoryhoraires = $doctrine->getRepository(Horaires::class);
        $horaires = $repositoryhoraires->findAll();

        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);
        $form->remove('isVerified');
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $avis->setIsVerified(false);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($avis);
            $entityManager->flush();
            $this->addFlash('success', "Votre avis a bien été envoyé, il sera publié lorsqu'un administrateur l'aura vérifié. Merci pour votre contribution");
           return $this->redirectToRoute('avis');
        }
        return $this->render('avis/addavis.html.twig', [
            'controller_name' => 'AvisController',
            'form' => $form->createView(),
            'horaires' => $horaires
        ]);
    }

    #[Route('/accept/{id?0}', name: 'avis.accept')]
    public function acceptAvis(Request $request, ManagerRegistry $doctrine, $id): Response {
        $repo = $doctrine->getRepository(Avis::class);
        $avis = $repo->find($id);
        if($avis){
            if($avis->isIsVerified()){
                $this->addFlash('danger', "L'avis a déjà été accepté");
                return $this->redirectToRoute('avis');
            }else{
                $avis->setIsVerified(true);
                $entityManager = $doctrine->getManager();
                $entityManager->persist($avis);
                $entityManager->flush();
                $this->addFlash('success', "L'avis a été accepté");
                return $this->redirectToRoute('avis');
                //accept
            }
        }else{
            $this->addFlash('danger', "L'avis n'existe pas");
            return $this->redirectToRoute('avis');
        }

    }

    #[Route('/delete/{id?0}', name: 'avis.delete')]
    public function deleteAvis(Request $request, ManagerRegistry $doctrine, $id): Response {
        $repo = $doctrine->getRepository(Avis::class);
        $avis = $repo->find($id);

        if($avis){
                $entityManager = $doctrine->getManager();
                $entityManager->remove($avis);
                $entityManager->flush();
                $this->addFlash('success', "L'avis a été refusé, il a donc été supprimé.");
                return $this->redirectToRoute('avis');
                //accept
            } else{
            $this->addFlash('danger', "L'avis n'existe pas.");
            return $this->redirectToRoute('avis');
        }

    }


}
