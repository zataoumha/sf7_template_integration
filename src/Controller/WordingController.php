<?php

namespace App\Controller;

use App\Entity\Translation;
use App\Repository\TranslationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Translation\Reader\TranslationReader;

#[Route('/dashboard')]
class WordingController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em){}


    #[Route('/wording', name: 'app.wording')]
    public function index(): Response
    {
        return $this->render('wording/index.html.twig', [
            'controller_name' => 'WordingController',
        ]);
    }

    #[Route('/wording/home', name: 'app.wording.home')]
    public function home(TranslationRepository $repo): Response
    {
        $transde = $repo->findBy(['translationPage'=>"home", "locale"=>"de"]);
        $transen = $repo->findBy(['translationPage'=>"home", "locale"=>"en"]);
        $transfr = $repo->findBy(['translationPage'=>"home", "locale"=>"fr"]);
        $transar = $repo->findBy(['translationPage'=>"home", "locale"=>"ar"]);

        return $this->render('wording/home.html.twig', [
            'transde' => $transde,
            'transen'=>$transen,
            'transfr' => $transfr,
            'transar'=>$transar
        ]);
    }
}
