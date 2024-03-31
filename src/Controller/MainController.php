<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app.main')]
    public function index(Request $request): Response
    {
        /* $locale = $request->getLocale();
        dd($locale); */
        return $this->render('home/home.html.twig');
    }

    #[Route('/about', name: 'app.about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig');
    }
    #[Route('/contact', name: 'app.contact')]
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
        $message = new Message();
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $message = $form->getData();
            $em->persist($message);
            $em->flush();
            $this->addFlash('success','message sent successfully, we will contact you as soon as possible !');
            return $this->redirectToRoute('app.contact');
        }
        return $this->render('home/contact.html.twig', ['form'=>$form]);
    }

    #[Route('/impersum', name: 'app.impersum')]
    public function impersum(): Response
    {
        return $this->render('home/impersum.html.twig');
    }
    
    #[Route('/offers', name: 'app.offers')]
    public function offers(): Response
    {
        return $this->render('home/Offers.html.twig');
    }

    #[Route('/privacy', name: 'app.privacy')]
    public function privacy(): Response
    {
        return $this->render('home/privacy.html.twig');
    }

    #[Route('/services', name: 'app.services')]
    public function services(): Response
    {
        return $this->render('home/services.html.twig');
    }
}
