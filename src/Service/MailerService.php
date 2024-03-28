<?php


namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\ResetPassword\Controller\ResetPasswordControllerTrait;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordToken;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;

class MailerService
{
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param MailerInterface $mailer
     * @param EntityManagerInterface $em
     */
    private $translator;
    private $resetPasswordHelper;

    public function __construct(MailerInterface $mailer, EntityManagerInterface $em, TranslatorInterface $translator){
        $this->mailer = $mailer;
        $this->em = $em;
        $this->translator  = $translator;
    }

    /**
     * @param $movie
     * @param string $user
     * @param string $action
     * @return void
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function notifyAdmin($movie, string $user, string $action):void
    {
        //récuperer l'email des admins
        $admins = $this->em->getRepository(User::class)->FindUserByRole('ROLE_ADMIN');
        $emails = [];
        foreach($admins as $key => $value){
            array_push($emails, $value->getEmail());
        }

        //recuperer l'action (ajout / modification / supression)
        $act = match($action){
            'create' => 'ajouté',
            'update' => 'modifié',
            'remove' => 'suprimé'
        };

        //envoyer l'email de notification pour chaqye admin
        foreach($emails as $email){
            $email = (new Email())
            ->from('info@gebaude.com')
            ->to($email)
            ->subject('Un filme à était '.$act.'sur la platforme gebaude !')
            ->text('Le filme '.$movie->getTitle().' a etait ajouté par '.$user.' le '.$movie->getCreatedAt()->format('Y-m-d H:i:s') )
            ->html('<p>Le filme <b>'.$movie->getTitle().'</b> a etait '.$act.' par <b>'.$user.'</b> le <b>'.$movie->getCreatedAt()->format('Y-m-d H:i:s').'</b></p>');

            $this->mailer->send($email);
        }

    }

    public function ticketMail(string $user, string $priority, string $date):void{
        $admins = $this->em->getRepository(User::class)->FindUserByRole('ROLE_ADMIN');
        $emails = [];
        foreach($admins as $key => $value){
            array_push($emails, $value->getEmail());
        }

        foreach($emails as $email){
            $email = (new Email())
                ->from('info@gebeaude.com')
                ->to($email)
                ->subject('Une ticket est ouvert sur la platforme GEBEAUD !')
                ->text($user.' à ouvrire une ticket de priorité '.$priority.' le '.$date );

            $this->mailer->send($email);
        }
    }

  

    public function notifyUser(string $email,  $resetPasswordLink):void
    {

        $email = (new TemplatedEmail())
            ->from('info@gebaude.com')
            ->to($email)
            ->subject('Password Reset Request')
            ->htmlTemplate('reset_password/new_password_email.html.twig')
            ->context([
                'resetToken' => $resetPasswordLink,
            ]);

        $this->mailer->send($email);
    }




}