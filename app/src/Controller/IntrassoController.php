<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class IntrassoController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->render('base.menu.html.twig');
    }

    /**
     * @Route("/accueil", name="accueil")
     */
    public function accueil()
    {
        return $this->render('base.menu.html.twig');
    }
}
