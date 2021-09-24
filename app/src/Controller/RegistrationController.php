<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\RechercheAdherentType;
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

class RegistrationController extends AbstractController
{
    private $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/register/listeAdherents", name="register-listeAdherents")
     */
    // public function listeAdherents(Request $request): Response
    // {
    //     $form = $this->createForm(RechercheAdherentType::class);
    //     $form->handleRequest($request);
    //     return $this->render('registration/listeAdherents.html.twig', [
    //         'form' => $form->createView()
    //     ]);
<<<<<<< HEAD
    // }
=======
    // } 
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b

    /**
     * @Route("/register", name="app_register")
     */
    // public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, ?UserInterface $userConnecte): Response
    // {
    //     $estRoleAdmin = 'none';
    //     if ($userConnecte && $userConnecte->getRoles() == ['ROLE_ADMIN']){
    //         $estRoleAdmin = 'block';
    //     }
    //     $user = new User();
    //     $form = $this->createForm(RegistrationFormType::class, $user);
    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) {
<<<<<<< HEAD

=======
            
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
    //         // encode the plain password
    //         $user->setPassword(
    //             $passwordEncoder->encodePassword(
    //                 $user,
    //                 $form->get('plainPassword')->getData()
    //             )
    //         );
    //         //dd($user->getRoles());
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($user);
    //         $entityManager->flush();
<<<<<<< HEAD

=======
            
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
    //         $this->addFlash(
    //             'info',
    //             "Email de validation envoyé à l'utilisateur."
    //         );
<<<<<<< HEAD

    //         // Génére une URL signée et l'envoyer par e-mail à l'utilisateur
=======
            
    //         // Génére une URL signée et l'envoyer par e-mail à l'utilisateur 
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
    //         $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
    //             (new TemplatedEmail())
    //                 ->from(new Address('sid@dis.com', 'sid'))
    //                 ->to($user->getEmail())
    //                 ->subject('Merci de confirmer cet email')
    //                 ->htmlTemplate('registration/confirmation_email.html.twig')
    //         );
<<<<<<< HEAD
    //         // Faites tout ce dont vous avez besoin ici, comme envoyer un e-mail
=======
    //         // Faites tout ce dont vous avez besoin ici, comme envoyer un e-mail 
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b

    //         return $this->render('enAttenteConfirmationMail.html.twig');
    //     }

    //     return $this->render('registration/register.html.twig', [
    //         'registrationForm' => $form->createView(),
    //         'estRoleAdmin'     => $estRoleAdmin,
    //     ]);
    // }

    /**
     * @Route("/gestion/adherent/{adherent}/modifier", name="gestion-adherent-modification")
     */
    // public function modifierAdherent(Request $request, User $adherent): Response
    // {
    //     $form = $this->createForm(UserType::class, $adherent);
    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $adherent = $form->getData();
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($adherent);
    //         $entityManager->flush();
    //         $this->addFlash(
    //             'success',
    //             "L'adhérent' {$adherent->getEmail()} a bien été modifié."
    //         );
<<<<<<< HEAD

=======
            
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
    //         return $this->redirectToRoute('gestion-pilotes-liste');
    //     }
    //     // Retourne la page web
    //     return $this->render('gestion/pilotes/modification.html.twig', [
    //         'form'      => $form->createView(),
    //         'pilote'   => $adherent
    //     ]);
    // }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    // public function verifyUserEmail(Request $request): Response
    // {
<<<<<<< HEAD

=======
        
>>>>>>> e07df1b42cd2f756d7dd6991eeab3e1c70e30a8b
    //     $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    //     // validate email confirmation link, sets User::isVerified=true and persists
    //     try {
    //         $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
    //         $this->addFlash('success', "L'utilisateur a bien été créé.");

    //     } catch (VerifyEmailExceptionInterface $exception) {
    //         $this->addFlash('verify_email_error', $exception->getReason());

    //         return $this->redirectToRoute('app_login');
    //     }

    //     // @TODO Change the redirect on success and handle or remove the flash message in your templates
    //     $this->addFlash('success', 'Votre email a été vérifié.');

    //     return $this->redirectToRoute('app_register');
    // }
}
