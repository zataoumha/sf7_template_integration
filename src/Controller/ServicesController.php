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
        $services = $serviceRepository->findBy(['isArchived'=>false]);

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
            'action'=>'Create'
        ]);
    }

    #[Route('/services/update/{service}', name: 'app.services.update')]
    public function update(Request $request, Service $service, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ServiceFormType::class, $service);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($service);
            $em->flush();
            $this->addFlash('success','Service updated successfully !');
            return $this->redirectToRoute('app.services.index');
        }

        return $this->render('services/update.html.twig', [
            'form' => $form,
            'action'=>'Update'
        ]);
    }

    #[Route('/services/delete/{service}', name: 'app.services.delete')]
    public function delete(Request $request, Service $service, EntityManagerInterface $em): Response
    {
        $em->remove($service);
        $em->flush();
        $this->addFlash('success','Service removed successfully !');
        return $this->redirectToRoute('app.services.index');
    }

    #[Route('/services/archive/{service}', name: 'app.services.archive')]
    public function archive(Request $request, Service $service, EntityManagerInterface $em): Response
    {
        if($service->isIsArchived()){
            $service->setIsArchived(false);
            $this->addFlash('success','Service removed from archive !');
        }else{
           $service->setIsArchived(true); 
           $this->addFlash('success','Service archived successfully !');
        }
        
        $em->flush();
        
        return $this->redirectToRoute('app.services.index');
    }

    #[Route('/services/archived', name: 'app.services.archived')]
    public function archived(ServiceRepository $serviceRepository): Response
    {
        $services = $serviceRepository->findBy(['isArchived'=>true]);

        return $this->render('services/archive.html.twig', [
            'services' => $services,
        ]);
    }

    #[Route('/services/show/{service}', name: 'app.services.show')]
    public function show(Request $request, Service $service): Response
    {
        return $this->render('services/show.html.twig', [
            'service' => $service,
        ]);
    }
}
