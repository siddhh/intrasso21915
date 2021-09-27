<?php

namespace App\Command\Cron;

use App\Entity\Article;
use App\Entity\ArticleStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Shapecode\Bundle\CronBundle\Annotation\CronJob;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\RechercheAdherentType;
use App\Form\ModificationRegistrationFormType;
use App\Security\EmailVerifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @CronJob("* * * * *")
 * Sera exécuté toutes les mn
 */
class EmailRetardCommand extends Command
{
    /**
     * @var string 
     */
    protected static $defaultName = 'intrasso4:cron:emails-retard';

    /**
     * @var EntityManagerInterface  
     */
    private $em;

    /**
     * @var MailerInterface 
     */
    private $mailer;

    /**
     * @var string 
     */
    private $noreply_mail;

    /**
     * @var string 
     */
    private $noreply_mail_label;

    /**
     * Constructeur de la commande.
     * Permet notamment de récupérer dépendances
     *
     * @param EntityManagerInterface $em
     * @param MailerInterface        $mailer
     * @param string                 $noreply_mail
     * @param string                 $noreply_mail_label
     */
    public function __construct(EntityManagerInterface $em, MailerInterface $mailer, string $noreply_mail, string $noreply_mail_label)
    {
        parent::__construct();
        $this->em = $em;
        $this->mailer = $mailer;
        $this->noreply_mail = $noreply_mail;
        $this->noreply_mail_label = $noreply_mail_label;
    }

    /**
     * Permet d'accéder aux paramètres d'environnement de Gesip.
     *
     * @param  String $clef
     * @return string
     */
    public function getParameter(string $clef): string
    {
        global $kernel;
        return $kernel->getContainer()->getParameter($clef);
    }

    /**
     * Configure la commande
     */
    protected function configure()
    {
        $this
            ->setDescription('[CRON] Permet d\'envoyer un mail aux Equipes/Pilotes/Administrateur des demandes en retard de réponse.')
            ->addOption('--with-interaction', '-i', InputOption::VALUE_NONE, 'Lorsque cette option n\'est pas utilisée, tous les pilotes sont sélectionnés et la date d\'envoi + 11j donne celles en retard, sinon vous serez invité à saisir ces données')
            ->addOption('--dry-run', '-d', InputOption::VALUE_NONE, 'Nous n\'enverrons pas réellement les emails mais afficherons un tableau de debug');
    }

    /**
     * Défini l'éxécution de la commande
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /**
         * On défini quelques variables utiles
         */
        $io = new SymfonyStyle($input, $output);
        $io->newLine();
        $statusRetard = $this->em->getRepository(ArticleStatus::class)->recuperationStatus(4);

        // Mode débug
        $debugMode = $input->getOption('dry-run');

        // Mode interactif
        $interactifMode = $input->getOption('with-interaction');

        // Déclaration de la date pour le script
        $dateDesRetards = (new \DateTime())->setTime(0, 0, 0);

        /**
         * Si nous sommes en mode interactif, on peut indiquer les demandes d'intervention
         * à notifier
         */
        $onlyDemandesIds = [];
        if ($interactifMode) {
            do {
                $tmp = $io->ask('Donnez l\'ID de la Demande d\'Intervention à notifier (ne rien taper pour notifier toutes les demandes)');
                if ($tmp !== null) {
                    $onlyDemandesIds[] = $tmp;
                }
            } while ($tmp !== null);

            // On demander à l'utilisateur de confirmer que l'on souhaite bien envoyer les emails de notifications.
            if (count($onlyDemandesIds) === 0 && !$io->confirm("Confirmez-vous l'envoi des notifications pour toutes les demandes en base de données ?", false)) {
                $io->error("Annulation effectuée");
                return 1;
            }
        }

        /**
         * On récupère la liste des articles dont nous aurons besoin par la suite
        */

        $lienIntrasso = $this->getParameter('base_url');
        $articlesRetards = $this->em->getRepository(Article::class)->getArticlesEnRetard();
        foreach ($articlesRetards as $article) {
            echo($article->getEmprunteur()->getEmail());
            echo($article->getEmprunteur()->getNomCompletCourt());

            // Construction du mail et envoi
            $emailMessage = (new TemplatedEmail())->from(new Address($this->noreply_mail, $this->noreply_mail_label));
            $emailMessage->addTo(new Address($article->getEmprunteur()->getEmail(), $article->getEmprunteur()->getNomCompletCourt()));
            $emailMessage
                ->subject("Article en retard - {$article->getTitre()}")
                ->textTemplate('emails//retardArticle.html.twig')
                ->htmlTemplate('emails/retardArticle.html.twig')
                ->context(
                    [
                    'article'   => $article,
                    'lienIntrasso' => $lienIntrasso
                    ]
                );
            ;
            $this->mailer->send($emailMessage);
            $article->setStatus($statusRetard);
            $this->em->persist($article);
        }
        $this->em->flush();
        echo("...OK...COUNT-->" . count($articlesRetards) . "...");

        return 0;
    }
}
