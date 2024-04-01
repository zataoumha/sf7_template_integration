<?php

namespace App\Controller;

use App\Entity\SiteParams;
use App\Repository\SiteParamsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard')]
class SettingsController extends AbstractController
{
    #[Route('/settings', name: 'app.settings')]
    public function index(SiteParamsRepository $repo): Response
    {
        $params = $repo->find(1);
        return $this->render('settings/index.html.twig', [
            'params' => $params,
        ]);
    }

    #[Route('/settings/name', name: 'app.settings.name', methods:['POST'])]
    public function name(Request $request, SiteParamsRepository $repo, EntityManagerInterface $em): Response
    {
        // Retrieve params directly if found, otherwise create new instance
        $params = $repo->find(1);

        try {
            if ($request->get('sitename')) {
                $params->setName($request->get('sitename'));
                $em->persist($params);
                $em->flush();
                $this->addFlash('success', 'Website name updated successfully!');
            }

            return $this->redirectToRoute('app.settings');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Failed to update website name.'); // Use a generic error message
            return $this->redirectToRoute('app.settings');
        }
    }


    #[Route('/settings/logo', name: 'app.settings.logo')]
    public function logo(Request $request): Response
    {
        dd($request->files);
        return $this->render('settings/index.html.twig', [
            'controller_name' => 'SettingsController',
        ]);
    }
    #[Route('/settings/email', name: 'app.settings.email')]
    public function email(Request $request, SiteParamsRepository $repo, EntityManagerInterface $em): Response
    {
        $params = $repo->find(1);

        try {
            if ($request->get('siteemail')) {
                $params->setEmail($request->get('siteemail'));
                $em->persist($params);
                $em->flush();
                $this->addFlash('success', 'Website email updated successfully!');
            }

            return $this->redirectToRoute('app.settings');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Failed to update website email.'); // Use a generic error message
            return $this->redirectToRoute('app.settings');
        }
    }


    #[Route('/settings/phone', name: 'app.settings.phone')]
    public function phone(Request $request, SiteParamsRepository $repo, EntityManagerInterface $em): Response
    {
        $params = $repo->find(1);

        try {
            if ($request->get('sitephone')) {
                $params->setPhone($request->get('sitephone'));
                $em->persist($params);
                $em->flush();
                $this->addFlash('success', 'Website phone number updated successfully!');
            }

            return $this->redirectToRoute('app.settings');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Failed to update website phone number.'); // Use a generic error message
            return $this->redirectToRoute('app.settings');
        }
    }


    #[Route('/settings/address', name: 'app.settings.address')]
    public function address(Request $request, SiteParamsRepository $repo, EntityManagerInterface $em): Response
    {
         $params = $repo->find(1);

        try {
            if ($request->get('siteaddress')) {
                $params->setAddress($request->get('siteaddress'));
                $em->persist($params);
                $em->flush();
                $this->addFlash('success', 'Website address updated successfully!');
            }

            return $this->redirectToRoute('app.settings');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Failed to update website address .'); // Use a generic error message
            return $this->redirectToRoute('app.settings');
        }
    }

    #[Route('/settings/tiktok', name: 'app.settings.tiktok')]
    public function tiktok(Request $request, SiteParamsRepository $repo, EntityManagerInterface $em): Response
    {
        
        $params = $repo->find(1);

        try {
            if ($request->get('sitetiktok')) {
                $params->setTiktok($request->get('sitetiktok'));
                $em->persist($params);
                $em->flush();
                $this->addFlash('success', 'Website tiktok link updated successfully!');
            }

            return $this->redirectToRoute('app.settings');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Failed to update website tiktok link.'); // Use a generic error message
            return $this->redirectToRoute('app.settings');
        }
    }

    #[Route('/settings/fb', name: 'app.settings.fb')]
    public function fb(Request $request, SiteParamsRepository $repo, EntityManagerInterface $em): Response
    {
        
        $params = $repo->find(1);

        try {
            if ($request->get('sitefb')) {
                $params->setFacebook($request->get('sitefb'));
                $em->persist($params);
                $em->flush();
                $this->addFlash('success', 'Website facebook link updated successfully!');
            }

            return $this->redirectToRoute('app.settings');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Failed to update website facebook link.'); // Use a generic error message
            return $this->redirectToRoute('app.settings');
        }
    }

    #[Route('/settings/insta', name: 'app.settings.insta')]
    public function insta(Request $request, SiteParamsRepository $repo, EntityManagerInterface $em): Response
    {
        $params = $repo->find(1);

        try {
            if ($request->get('siteinstagram')) {
                $params->setInsta($request->get('siteinstagram'));
                $em->persist($params);
                $em->flush();
                $this->addFlash('success', 'Website instagram link updated successfully!');
            }

            return $this->redirectToRoute('app.settings');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Failed to update website instagram link.'); // Use a generic error message
            return $this->redirectToRoute('app.settings');
        }
        
    }

    #[Route('/settings/hitingemail', name: 'app.settings.hiringemail')]
    public function hitingEmail(Request $request, SiteParamsRepository $repo, EntityManagerInterface $em): Response
    {
        
        $params = $repo->find(1);

        try {
            if ($request->get('sitehiringemail')) {
                $params->setHorigEmail($request->get('sitehiringemail'));
                $em->persist($params);
                $em->flush();
                $this->addFlash('success', 'Website hiring email updated successfully!');
            }

            return $this->redirectToRoute('app.settings');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Failed to update website hiring email.'); // Use a generic error message
            return $this->redirectToRoute('app.settings');
        }
    }

    #[Route('/settings/hiringPhone', name: 'app.settings.hiringPhone')]
    public function hiringPhone(Request $request, SiteParamsRepository $repo, EntityManagerInterface $em): Response
    {
        $params = $repo->find(1);

        try {
            if ($request->get('sitehiringphone')) {
                $params->setHiringPhone($request->get('sitehiringphone'));
                $em->persist($params);
                $em->flush();
                $this->addFlash('success', 'Website hiring phone number updated successfully!');
            }

            return $this->redirectToRoute('app.settings');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Failed to update website hiring phone number.'); // Use a generic error message
            return $this->redirectToRoute('app.settings');
        }
    }


}
