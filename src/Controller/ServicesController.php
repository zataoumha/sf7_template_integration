<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceFormType;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/dashboard')]
class ServicesController extends AbstractController
{
    #[Route('/services', name: 'app.services.index')]
    public function index(ServiceRepository $serviceRepository): Response
    {
        $services = $serviceRepository->findAll();

        return $this->render('services/index.html.twig', [
            'services' => $services,
        ]);
    }

    #[Route('/services/create', name: 'app.services.create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceFormType::class, $service);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($service);
            $em->flush();
            $this->addFlash('success','Service created successfully !');
            return $this->redirectToRoute('app.services.index');
        }

        return $this->render('services/create.html.twig', [
            'form' => $form,
        ]);
    }
}
