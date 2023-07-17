<?php

namespace App\Controller;

use App\Entity\Horaires;
use App\Entity\Service;
use App\Form\ServiceType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/services')]
class ServiceController extends AbstractController
{
    #[Route('/', name: 'service')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Service::class);
        $services = $repository->findAll();

        $horairesrepo = $doctrine->getRepository(Horaires::class);
        $horaires = $horairesrepo->findAll();

        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
            'services' => $services,
            'horaires' => $horaires
        ]);
    }

    #[Route('/edit/{id?0}', name: 'service.edit')]
    public function addService(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger , $id): Response
    {
        $repo = $doctrine->getRepository(Service::class);
        $service = $repo->find($id);

        $repohoraires = $doctrine->getRepository(Horaires::class);
        $horaires = $repohoraires->findAll();

        $new = false;
        if(!$service){
            $new = true;
             $service = new Service();
             $service->setAvailable(true);
        }

        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();
                try {
                    $image->move(
                        $this->getParameter('service_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $service->setImage($newFilename);
            }
            $entityManager = $doctrine->getManager();
            $entityManager->persist($service);
            $entityManager->flush();
            if($new){
                $message = "Le service ".$service->getName()." a été créé avec succès.";
            } else{
                $message = "Le service ".$service->getName()." a été édité avec succès.";
            }
            $this->addFlash("success", $message);
            return $this->redirectToRoute('service');
        }

        return $this->render('service/addservice.html.twig', [
            'controller_name' => 'ServiceController',
            'form' => $form->createView(),
            'horaires' => $horaires
        ]);
    }

    #[Route('/delete/{id}', name: 'service.delete')]
    public function deleteService(ManagerRegistry $doctrine, $id) : RedirectResponse {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $repo = $doctrine->getRepository(Service::class);
        $service = $repo->find($id);
        if($service){
            $name = $service->getName();
            $manager = $doctrine->getManager();
            $manager->remove($service);
            $manager->flush();
            $this->addFlash('success', "Le service ".$name." a bien été supprimé.");
        }else{
            $this->addFlash('error', "Impossible, le service n'existe pas.");
        }
        return $this->redirectToRoute('service');
    }
}
