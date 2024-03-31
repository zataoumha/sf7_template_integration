<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard')]
class SettingsController extends AbstractController
{
    #[Route('/settings', name: 'app.settings')]
    public function index(): Response
    {
        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }

    #[Route('/settings/name', name: 'app.settings.name')]
    public function name(): Response
    {
        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }
    #[Route('/settings/logo', name: 'app.settings.logo')]
    public function logo(): Response
    {
        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }
    #[Route('/settings/email', name: 'app.settings.email')]
    public function email(): Response
    {
        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }
    #[Route('/settings/phone', name: 'app.settings.phone')]
    public function phone(): Response
    {
        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }


    #[Route('/settings/address', name: 'app.settings.address')]
    public function address(): Response
    {
        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }

    #[Route('/settings/tiktok', name: 'app.settings.tiktok')]
    public function tiktok(): Response
    {
        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }

    #[Route('/settings/fb', name: 'app.settings.fb')]
    public function fb(): Response
    {
        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }

    #[Route('/settings/insta', name: 'app.settings.insta')]
    public function insta(): Response
    {
        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }

    #[Route('/settings/hitingemail', name: 'app.settings.hitingemail')]
    public function hitingEmail(): Response
    {
        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }

    #[Route('/settings/hiringPhone', name: 'app.settings.hiringPhone')]
    public function hiringPhone(): Response
    {
        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }


}
