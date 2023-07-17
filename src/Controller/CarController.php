<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Contact;
use App\Entity\Horaires;
use App\Form\CarType;
use App\Form\ContactType;
use App\Repository\CarRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/occasions')]
class CarController extends AbstractController
{
    #[Route('/', name: 'cars.home')]
    public function index(CarRepository $carrepo, ManagerRegistry $doctrine, Request $request): Response
    {

        $repositoryhoraires = $doctrine->getRepository(Horaires::class);
        $horaires = $repositoryhoraires->findAll();

        // Get les filtres
        $filtersenergy = $request->get('energies');
        $filterskm = $request->get('kms');
        $filtersyear = $request->get('year');
        $filterprice = $request->get('price');
        // Get les cars selon filtres
        $carslist = $carrepo->getCars($filtersenergy, $filterskm, $filtersyear, $filterprice);
        // Check si requête AJAX
        if($request->get('ajax')){
            return new JsonResponse([
                'content' => $this->renderView('car/_content.html.twig', [
                'controller_name' => 'CarController',
                'cars' => $carslist,
                'horaires' => $horaires
            ])
            ]);
        }


        return $this->render('car/index.html.twig', [
            'controller_name' => 'CarController',
            'cars' => $carslist,
            'horaires' => $horaires
         ]);
    }

    #[Route('/{id}', name: 'cars.show')]
    public function carShow(ManagerRegistry $doctrine,Request $request, $id): Response
    {

        $repositoryhoraires = $doctrine->getRepository(Horaires::class);
        $horaires = $repositoryhoraires->findAll();

        $repo = $doctrine->getRepository(Car::class);
        $car = $repo->find($id);

        $contact = new Contact();
        if($car){
            $subject = 'Au sujet de ' . $car->getBrand() .' ' .$car->getModel() . ' de ' .  $car->getYear();
            $contact->setSubject($subject);
        }
        $form = $this->createForm(ContactType::class, $contact);
        $form->remove('lu');
        $contact->setLu(false);

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $entitymanager = $doctrine->getManager();
            $entitymanager->persist($contact);
            $entitymanager->flush();
            $this->addFlash("success", 'Votre message a bien été envoyé, il sera traité rapidement.');
            return $this->redirectToRoute('cars.show', ['id' => $car->getId()]);
        }


        return $this->render('car/showcar.html.twig', [
            'controller_name' => 'CarController',
            'car' => $car,
            'form' => $form->createView(),
            'horaires' => $horaires
        ]);
    }

    #[Route('/edit/{id?0}', name: 'cars.add')]
    public function addCar(SluggerInterface $slugger, Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $repositoryhoraires = $doctrine->getRepository(Horaires::class);
        $horaires = $repositoryhoraires->findAll();

        $repo = $doctrine->getRepository(Car::class);
        $car = $repo->find($id);
        $new = false;
        if($car == null){
            $new = true;
            $car = new Car();
        }

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);
        if($form->isSubmitted()){

            $image = $form->get('mainImage')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();
                try {
                    $image->move(
                        $this->getParameter('occasions_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $car->setMainImage($newFilename);
            }

            $img2 = $form->get('img2')->getData();
            if ($img2) {
                $originalFilename2 = pathinfo($img2->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename2 = $slugger->slug($originalFilename2);
                $newFilename2 = $safeFilename2.'-'.uniqid().'.'.$img2->guessExtension();
                try {
                    $img2->move(
                        $this->getParameter('occasions_directory'),
                        $newFilename2
                    );
                } catch (FileException $e) {
                }
                $car->setImg2($newFilename2);
            }

            $img3 = $form->get('img3')->getData();
            if ($img3) {
                $originalFilename3 = pathinfo($img3->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename3 = $slugger->slug($originalFilename3);
                $newFilename3 = $safeFilename3.'-'.uniqid().'.'.$img3->guessExtension();
                try {
                    $img3->move(
                        $this->getParameter('occasions_directory'),
                        $newFilename3
                    );
                } catch (FileException $e) {
                }
                $car->setImg3($newFilename3);
            }

            $img4 = $form->get('img4')->getData();
            if ($img4) {
                $originalFilename4 = pathinfo($img4->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename4 = $slugger->slug($originalFilename4);
                $newFilename4 = $safeFilename4.'-'.uniqid().'.'.$img4->guessExtension();
                try {
                    $img4->move(
                        $this->getParameter('occasions_directory'),
                        $newFilename4
                    );
                } catch (FileException $e) {
                }
                $car->setImg4($newFilename4);
            }

            $entityManager = $doctrine->getManager();
            $entityManager->persist($car);
            $entityManager->flush();
            if($new){
                $message = "Le nouveau véhicule d'occasion ".$car->getBrand(). ' '.$car->getModel() .' de '.$car->getYear()." a bien été ajoutée à la liste.";
            }else {
                $message = "Le véhicule d'occasion ".$car->getBrand(). ' '.$car->getModel() .' de '.$car->getYear()." a bien été modifié.";

            }
            $this->addFlash('success', $message);
            return $this->redirectToRoute('cars.show', ['id' => $car->getId()]);
        }

        return $this->render('car/addcar.html.twig', [
            'controller_name' => 'CarController',
            'form' => $form->createView(),
            'car' => $car,
            'horaires' => $horaires
        ]);
    }

    #[Route('/delete/{id}', name: 'car.delete')]
    public function deleteCar(ManagerRegistry $doctrine, $id) : RedirectResponse {
        $this->denyAccessUnlessGranted('ROLE_EMPLOYEE');
        $repo = $doctrine->getRepository(Car::class);
        $car = $repo->find($id);
        if($car){
           $name = $car->getBrand() .' ' .$car->getModel();
            $manager = $doctrine->getManager();
            $manager->remove($car);
            $manager->flush();
            $this->addFlash('success', "Le véhicule ".$name." a bien été supprimé.");
        }else{
            $this->addFlash('error', "Impossible, le véhicule n'existe pas.");
        }
        return $this->redirectToRoute('cars.home');
    }


}
