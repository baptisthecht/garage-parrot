<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Horaires;
use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $horairesrepository = $doctrine->getRepository(Horaires::class);
        $horaires = $horairesrepository->findAll();

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->remove('lu');
        $contact->setLu(false);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $entitymanager = $doctrine->getManager();
            $entitymanager->persist($contact);
            $entitymanager->flush();
            $this->addFlash('success', 'Votre message a bien été envoyé, nous le traiterons sous 48h.');
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView(),
            'horaires' =>$horaires
        ]);
    }
}
