<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\ContactFormType;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard')]
class MessagesController extends AbstractController
{



    #[Route('/messages', name: 'app.messages')]
    public function index(MessageRepository $repo): Response
    {
        $messages = $repo->findAll();
        return $this->render('messages/index.html.twig', [
            'messages' => $messages,
        ]);
    }

    #[Route('/messages/show/{message}', name: 'app.message.show')]
    public function show(MessageRepository $repo, Message $message): Response
    {
        $message = $repo->find($message);
        return $this->render('messages/details.html.twig', [
            'message' => $message,
        ]);
    }

    #[Route('/messages/delete/{message}', name: 'app.message.delete')]
    public function delete(MessageRepository $repo, Message $message, EntityManagerInterface $em): Response
    {
        $messages = $repo->find($message);
        $em->remove($message);
        $em->flush();
        $this->addFlash('success', "Message removed !");
        return $this->redirectToRoute('app.messages');
    }
}
