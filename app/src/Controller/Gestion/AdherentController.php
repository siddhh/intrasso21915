<?php

namespace App\Controller\Gestion;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\RechercheAdherentType;
use App\Form\ModificationRegistrationFormType;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Mailer\MailerInterface;
use Doctrine\ORM\EntityManagerInterface;

class AdherentController extends AbstractController
{
    private $emailVerifier;

    /** @var MailerInterface */
    private $mailer;

    /** @var EntityManagerInterface  */
    private $em;

    /** @var string */
    private $noreply_mail;

    /** @var string */
    private $noreply_mail_label;


    /**
     * Constructeur de la commande.
     * Permet notamment de récupérer dépendances
     * @param EntityManagerInterface $em
     * @param MailerInterface $mailer
     */

    public function __construct(
        EntityManagerInterface $em,
        EmailVerifier $emailVerifier,
        MailerInterface $mailer

        ) {
            $this->em = $em;
            $this->emailVerifier = $emailVerifier;
            $this->mailer = $mailer;
        }

    /**
     * @Route("/gestion/listeAdherents", name="gestion-listeAdherents")
     */
    public function listeAdherents(Request $request): Response
    {
        $form = $this->createForm(RechercheAdherentType::class);
        $form->handleRequest($request);
        return $this->render('registration/listeAdherents.html.twig', [
            'form' => $form->createView()
        ]);
    } 

    /**
     * @Route("/gestion/adherent/creer", name="gestion-adherent-creer")
     */
    public function creerAdherent(Request $request, UserPasswordEncoderInterface $passwordEncoder, ?UserInterface $userConnecte): Response
    {
        $estRoleAdmin = 'none'; 
        if ($userConnecte && $userConnecte->getRoles() == ['ROLE_ADMIN']){
            $estRoleAdmin = 'block';
        }
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            $this->addFlash(
                'info',
                "Email de validation envoyé à l'utilisateur."
            );
            
            // Génére une URL signée et l'envoyer par e-mail à l'utilisateur 
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('sid@dis.com', 'sid'))
                    ->to($user->getEmail())
                    ->subject('Merci de confirmer cet email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // Faites tout ce dont vous avez besoin ici, comme envoyer un e-mail 

            return $this->render('enAttenteConfirmationMail.html.twig');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'estRoleAdmin'     => $estRoleAdmin,
        ]);
    }

    /**
     * @Route("/gestion/adherent/{adherent}/modifier", name="gestion-adherent-modification")
     */
    public function modifierAdherent(Request $request, User $adherent, ?UserInterface $userConnecte): Response
    {

        $listeAdministrateurs = $this->em->getRepository(User::class)->listeAdministrateursTous();
        $valeurActif = $adherent->getActif();
        $estRoleAdmin = 'none'; 
        if ($userConnecte && $userConnecte->getRoles() == ['ROLE_ADMIN']){
            $estRoleAdmin = 'block';
        }
        $registrationForm = $this->createForm(ModificationRegistrationFormType::class, $adherent);
        $registrationForm->handleRequest($request);
        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            $adherent = $registrationForm->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adherent);
            $entityManager->flush();
            
            //Email d'activation 
            if ($valeurActif == false && $valeurActif != $adherent->getActif()) {
                
                $lienIntrasso = $this->getParameter('base_url');
                $emailMessage = (new TemplatedEmail());

                // Envoi d'un mail d activation 
                // foreach ($listeAdministrateurs as $administrateur) {
                //     // Construction de la liste des destinataires
                //     $emailMessage->addTo($destinataire);
                // };
                foreach ($listeAdministrateurs as $administrateur) {
                    $listeAdministrateursAdresses[$administrateur->getEmail()] = 
                        new Address($administrateur->getEmail(),
                        $administrateur->getNom());
                }
                
                $emailMessage->from(new Address($this->getParameter('noreply_mail'), $this->getParameter('noreply_mail_label')));
                foreach ($listeAdministrateursAdresses as $adresse) {
                    $emailMessage->addTo($adresse);
                }
                
                $emailMessage->subject("INTRASSO : Activation de votre compte")
                ->textTemplate('emails/activationAdherent.text.twig')
                ->htmlTemplate('emails/activationAdherent.html.twig')
                ->context([
                        'lienIntrasso' => $lienIntrasso
                    ]);

                $this->mailer->send($emailMessage);
            };

            $this->addFlash(
                'success',
                "L'adhérent' {$adherent->getEmail()} a bien été modifié."
            );
            
            return $this->redirectToRoute('gestion-listeAdherents');
        }

        // Retourne la page web
        return $this->render('registration/modificationRegister.html.twig', [
            'registrationForm'      => $registrationForm->createView(),
            'adherent'              => $adherent,
            'estRoleAdmin'          => $estRoleAdmin,
        ]);
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request): Response
    {
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
            $this->addFlash('success', "L'utilisateur a bien été créé.");

        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_login');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Votre email a été vérifié.');

        return $this->redirectToRoute('gestion-adherent-creer');
    }

    /**
     * @Route("/gestion/adherent/{adherent}/valider", name="gestion-adherent-valider")
     */
    public function validerAdherent(Request $request, User $adherent): Response
    {
        $form = $this->createForm(ModificationRegistrationFormType::class, $adherent);
        
        //article
        $form->handleRequest($request);
        $adherent = $form->getData();
        $adherent->setActif(true);
        $this->em->persist($adherent);
        $this->em->flush();

        //message flash
        $this->addFlash(
            'success',
            "L'adherent {$adherent->getEmail()} a été validé."
        );
        
        return $this->redirectToRoute('gestion-listeAdherents');
    }

    /**
    * @Route("/gestion/adherent/{adherent}/deValider", name="gestion-adherent-deValider")
    */
    public function deValiderAdherent(Request $request, User $adherent): Response
    {
        $form = $this->createForm(ModificationRegistrationFormType::class, $adherent);
        
        //article
        $form->handleRequest($request);
        $adherent = $form->getData();
        $adherent->setActif(false);
        $this->em->persist($adherent);
        $this->em->flush();

        //message flash
        $this->addFlash(
            'success',
            "L'adherent {$adherent->getEmail()} a été dévalidé."
        );
        
        return $this->redirectToRoute('gestion-listeAdherents');
    }

    /**
    * @Route("/gestion/adherent/validerTous", name="gestion-adherent-validerTous")
    */
    public function validerTousAdherent(Request $request ): Response
    {
        $adherents = $this->getDoctrine()->getRepository(User::class)->listeAdherentsAttenteValidation();
        //dd($adherents);

        foreach ($adherents as $adherent) {
            $adherent->setActif(true);
            $this->em->persist($adherent);
            
        } 

        $this->em->flush();

        //Message flash
        $this->addFlash(
            'success',
            "Tous les adhérents en attente ont été activés."
        );
        
        return $this->redirectToRoute('gestion-listeAdherents');
    } 

}
