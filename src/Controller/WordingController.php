<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard')]
class WordingController extends AbstractController
{
    #[Route('/wording', name: 'app.wording')]
    public function index(): Response
    {
        return $this->render('wording/index.html.twig', [
            'controller_name' => 'WordingController',
        ]);
    }
}
