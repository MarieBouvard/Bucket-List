<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        $h1 = 'Bienvenue sur Bucker-List';
        return $this->render('main/index.html.twig',
        ['titre1'=>$h1]);
    }

     /**
     * @Route("/aboutUs", name="app_about_us")
     */
    public function aboutUs(): Response
    {
        return $this->render('main/aboutUs.html.twig');
    }

    
}
