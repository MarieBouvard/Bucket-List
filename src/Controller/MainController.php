<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="app_main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }

    /**
     * @Route("/", name="app_home")
     */
    public function home(): Response
    {
        $h1 = 'Bienvenue sur Bucker-List';
        return $this->render('main/home.html.twig',
        ['titre1'=>$h1]);
    }
}
