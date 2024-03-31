<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard')]
class UsersController extends AbstractController
{
    #[Route('/users', name: 'app.users.index')]
    public function index(Request $request, UserRepository $user): Response
    {
        return $this->render('users/index.html.twig', [
            'users' => $user->findAll(),
        ]);
    }

    #[Route('/users/create', name: 'app.users.create')]
    public function create(EntityManagerInterface $em, Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user->setIsActivated(true);
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'User Created Successfully !');
            return $this->redirectToRoute('app.users.index');
        }
        return $this->render('users/create.html.twig', [
            'form' => $form,
            'action'=>'Create'
        ]);
    }

    #[Route('/users/update/{user}', name: 'app.users.update')]
    public function update(EntityManagerInterface $em, Request $request, User $user): Response
    {
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user->setIsActivated(true);
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'User updated Successfully !');
            return $this->redirectToRoute('app.users.index');
        }
        return $this->render('users/update.html.twig', [
            'form' => $form,
            'action'=>'Update'
        ]);
    }

    #[Route('/users/delete/{user}', name: 'app.users.delete')]
    public function delete(EntityManagerInterface $em, Request $request, User $user): Response
    {
        $em->remove($user);
        $em->flush();
        $this->addFlash('success', 'User deleted Successfully !');
        return $this->redirectToRoute('app.users.index');  
    }

    #[Route('/users/state', name: 'app.users.state')]
    public function state(EntityManagerInterface $em, Request $request, UserRepository $repo): JsonResponse
    {
        $user = $repo->find($request->get('userId'));
        $message = '';
         $user->setIsActivated(!$user->isIsActivated());
        $em->persist($user);
        $user->isIsActivated() ? $message = "Account activated" : $message = "Account blocked";
        $em->flush(); 
        return new JsonResponse([
            'message' => $message,
        ], 200);
    }

    #[Route('/users/show/{user}', name: 'app.users.show')]
    public function show(EntityManagerInterface $em, Request $request, User $user): Response
    {
        return $this->render('users/show.html.twig', [
            'user' => $user,
        ]);
    }

    /* #[Route('/users/impersonate', name: 'app.users.impersonate')]
    public function impersonate(): Response
    {

    } */
}
