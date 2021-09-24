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
<<<<<<< HEAD
    ) {
        $this->em = $em;
        $this->emailVerifier = $emailVerifier;
        $this->mailer = $mailer;
    }
=======

        ) {
            $this->em = $em;
            $this->emailVerifier = $emailVerifier;
            $this->mailer = $mailer;
        }
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b

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
<<<<<<< HEAD
    }
=======
    } 
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b

    /**
     * @Route("/gestion/adherent/creer", name="gestion-adherent-creer")
     */
    public function creerAdherent(Request $request, UserPasswordEncoderInterface $passwordEncoder, ?UserInterface $userConnecte): Response
    {
<<<<<<< HEAD
        $estRoleAdmin = 'none';
        if ($userConnecte && $userConnecte->getRoles() == ['ROLE_ADMIN']) {
=======
        $estRoleAdmin = 'none'; 
        if ($userConnecte && $userConnecte->getRoles() == ['ROLE_ADMIN']){
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
            $estRoleAdmin = 'block';
        }
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
<<<<<<< HEAD

=======
            
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
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
<<<<<<< HEAD

=======
            
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
            $this->addFlash(
                'info',
                "Email de validation envoyé à l'utilisateur."
            );
<<<<<<< HEAD

            // Génére une URL signée et l'envoyer par e-mail à l'utilisateur
            $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $user,
=======
            
            // Génére une URL signée et l'envoyer par e-mail à l'utilisateur 
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
                (new TemplatedEmail())
                    ->from(new Address('sid@dis.com', 'sid'))
                    ->to($user->getEmail())
                    ->subject('Merci de confirmer cet email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
<<<<<<< HEAD
            // Faites tout ce dont vous avez besoin ici, comme envoyer un e-mail
=======
            // Faites tout ce dont vous avez besoin ici, comme envoyer un e-mail 
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b

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
<<<<<<< HEAD
        $listeAdministrateurs = $this->em->getRepository(User::class)->listeAdministrateursTous();
        $valeurActif = $adherent->getActif();
        $estRoleAdmin = 'none';
        if ($userConnecte && $userConnecte->getRoles() == ['ROLE_ADMIN']) {
=======

        $listeAdministrateurs = $this->em->getRepository(User::class)->listeAdministrateursTous();
        $valeurActif = $adherent->getActif();
        $estRoleAdmin = 'none'; 
        if ($userConnecte && $userConnecte->getRoles() == ['ROLE_ADMIN']){
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
            $estRoleAdmin = 'block';
        }
        $registrationForm = $this->createForm(ModificationRegistrationFormType::class, $adherent);
        $registrationForm->handleRequest($request);
        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            $adherent = $registrationForm->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adherent);
            $entityManager->flush();
<<<<<<< HEAD

            //Email d'activation
            if ($valeurActif == false && $valeurActif != $adherent->getActif()) {
                $lienIntrasso = $this->getParameter('base_url');
                $emailMessage = (new TemplatedEmail());

                // Envoi d'un mail d activation
=======
            
            //Email d'activation 
            if ($valeurActif == false && $valeurActif != $adherent->getActif()) {
                
                $lienIntrasso = $this->getParameter('base_url');
                $emailMessage = (new TemplatedEmail());

                // Envoi d'un mail d activation 
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
                // foreach ($listeAdministrateurs as $administrateur) {
                //     // Construction de la liste des destinataires
                //     $emailMessage->addTo($destinataire);
                // };
                foreach ($listeAdministrateurs as $administrateur) {
<<<<<<< HEAD
                    $listeAdministrateursAdresses[$administrateur->getEmail()] =
                        new Address(
                            $administrateur->getEmail(),
                            $administrateur->getNom()
                        );
                }

=======
                    $listeAdministrateursAdresses[$administrateur->getEmail()] = 
                        new Address($administrateur->getEmail(),
                        $administrateur->getNom());
                }
                
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
                $emailMessage->from(new Address($this->getParameter('noreply_mail'), $this->getParameter('noreply_mail_label')));
                foreach ($listeAdministrateursAdresses as $adresse) {
                    $emailMessage->addTo($adresse);
                }
<<<<<<< HEAD

=======
                
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
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
<<<<<<< HEAD

=======
            
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
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
<<<<<<< HEAD
=======
        
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
            $this->addFlash('success', "L'utilisateur a bien été créé.");
<<<<<<< HEAD
=======

>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
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
<<<<<<< HEAD

=======
        
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
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
<<<<<<< HEAD

=======
        
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
        return $this->redirectToRoute('gestion-listeAdherents');
    }

    /**
    * @Route("/gestion/adherent/{adherent}/deValider", name="gestion-adherent-deValider")
    */
    public function deValiderAdherent(Request $request, User $adherent): Response
    {
        $form = $this->createForm(ModificationRegistrationFormType::class, $adherent);
<<<<<<< HEAD

=======
        
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
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
<<<<<<< HEAD

=======
        
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
        return $this->redirectToRoute('gestion-listeAdherents');
    }

    /**
    * @Route("/gestion/adherent/validerTous", name="gestion-adherent-validerTous")
    */
<<<<<<< HEAD
    public function validerTousAdherent(Request $request): Response
=======
    public function validerTousAdherent(Request $request ): Response
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
    {
        $adherents = $this->getDoctrine()->getRepository(User::class)->listeAdherentsAttenteValidation();
        //dd($adherents);

        foreach ($adherents as $adherent) {
            $adherent->setActif(true);
            $this->em->persist($adherent);
<<<<<<< HEAD
        }
=======
            
        } 
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b

        $this->em->flush();

        //Message flash
        $this->addFlash(
            'success',
            "Tous les adhérents en attente ont été activés."
        );
<<<<<<< HEAD

        return $this->redirectToRoute('gestion-listeAdherents');
    }
=======
        
        return $this->redirectToRoute('gestion-listeAdherents');
    } 

>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
}
