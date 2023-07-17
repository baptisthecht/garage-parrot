<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Horaires;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagesController extends AbstractController
{
    #[Route('/messages', name: 'app_messages')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $horairesrepo = $doctrine->getRepository(Horaires::class);
        $horaires = $horairesrepo->findAll();

        $repo = $doctrine->getRepository(Contact::class);
        $messages = $repo->findAll();

        return $this->render('messages/index.html.twig', [
            'controller_name' => 'MessagesController',
            'messages' => $messages,
            'horaires' => $horaires
        ]);
    }

    #[Route('/setread/{id?0}', name: 'app_messages_setread')]
    public function setRead(ManagerRegistry $doctrine, $id): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $repo = $doctrine->getRepository(Contact::class);
        $message = $repo->find($id);
        $messages = $repo->findAll();

        if($message){
            $manager = $doctrine->getManager();
            $message->setLu(true);
            $manager->persist($message);
            $manager->flush();
            $this->addFlash('success', "Le message a été marqué comme lu.");
        }else{
            $this->addFlash('danger', "Le message n'existe pas.");
        }

        return $this->redirectToRoute('app_messages');
    }
}
