<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
     * @Route("/wish", name="wish_")
     */
class WishController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function list(): Response
    {
        return $this->render('wish/list.html.twig');
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function detail($id): Response
    {
        return $this->render('wish/detail.html.twig', ['id'=>$id]);
    }
}
