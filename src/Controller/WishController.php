<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="wish_list")
     */
    public function list(WishRepository $repo): Response
    {
        $wishes = $repo->findBy([], ['dateCreated'=>'DESC']);
        return $this->render('wish/list.html.twig', compact('wishes'));
    }


   /**
     * @Route("/details/{id}", name="wish_details")
     */
    public function details($id, WishRepository $repo): Response
    {
        $wish = $repo->find($id);
        if(!$wish)
            throw $this->createNotFoundException();
        return $this->render('wish/details.html.twig', ['wish'=>$wish]);
    }

    /**
     * @Route("/wish/add", name="wish_add")
     */
    public function add(EntityManagerInterface $em, WishRepository $repo, Request $request): Response {
        $wish = new Wish();
        $form = $this->createForm(WishType::class, $wish);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $wish->setIsPublished(true);
            $wish->setDateCreated(new DateTime);
            $em->persist($wish);
            $em->flush();
            $this->addFlash('success', "L'idée " . $wish->getTitle() . " a bien été rajoutée ");
            return $this->redirectToRoute('wish_details', ['id'=>$wish->getId()]);
        }
        
        $viewForm = $form->createView();
        return $this->render('wish/add.html.twig',compact('viewForm'));
        // ajout
        // $wish1 = new Wish();
        // $wish1->setTitle('Voir la grande muraille de Chine')
        //     ->setAuthor('Marie Bou')
        //     ->setDescription('Visitez une des septs merveilles du monde moderne')
        //     ->setDateCreated(new \DateTime);
        // $em->persist($wish1);
        // $em->flush();

        // $wish2 = new Wish();
        // $wish2->setTitle('Saut en parachute')
        //     ->setAuthor('Tintin')
        //     ->setDateCreated(new \DateTime);
        // $em->persist($wish2);
        // $em->flush();

        // $wish3 = new Wish();
        // $wish3->setTitle('Faire un tour du monde')
        //     ->setAuthor('Marie Bou')
        //     ->setDateCreated(new \DateTime);
        // $em->persist($wish3);
        // $em->flush();
        // $repo->add($wish1);
        // $repo->add($wish2);
        // $repo->add($wish3);

        //  // suppression
        //  $em->remove($wish1, $wish2, $wish3);
        //  $em->flush();

        
    }


}