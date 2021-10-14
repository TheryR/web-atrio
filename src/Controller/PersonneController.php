<?php

namespace App\Controller;

use App\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personne", name="personne")
     */
    public function index(): Response
    {

        $personnes = $this->getDoctrine()->getRepository('Personne')->findAll();
        return $this->render('personne/index.html.twig', [
            'controller_name' => 'PersonneController',
            'personnes' => $personnes,
        ]);
    }

    /**
     * Affiche le formulaire de création d'une personne
     * @Route("/personne/new", name="personne_new", methods={"GET"})
     */
    public function new()
    {
    }

    /**
     * Traite la requête d'un formulaire de création d'une personne
     * @Route("/personne", name="personne_create", methods={"POST"})
     */
    public function create()
    {

    }
}
