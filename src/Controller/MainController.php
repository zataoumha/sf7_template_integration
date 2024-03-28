<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app.main')]
    public function index(): Response
    {
        return $this->render('home/home.html.twig');
    }

    #[Route('/about', name: 'app.about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig');
    }

    #[Route('/contact', name: 'app.contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig');
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
