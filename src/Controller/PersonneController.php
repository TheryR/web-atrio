<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Query;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personne", name="personne_index")
     */
    public function index(): Response
    {

//        $personnes = $this->getDoctrine()->getRepository('AcmeBundle:Personne')->findAll();
        return $this->render('personne/index.html.twig', [
            'controller_name' => 'PersonneController',
            'personnes' => $this->getDoctrine()->getRepository(Personne::class)->findAll(array(),array('last_name' => 'ASC')),
        ]);
    }

    /**
     * Affiche le formulaire de création d'une personne
     * @Route("/personne/new", name="personne_new", methods={"POST","GET"})
     */
    public function new(Request $request)
    {
        $personne = new Personne();
        $form = $this->createForm(PersonneType::class, $personne);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personne = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($personne);
            $entityManager->flush();

            return $this->redirectToRoute('personne_index');
        }

        return $this->render('personne/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Traite la requête d'un formulaire de création d'une personne
     * @Route("/personne", name="personne_create", methods={"POST"})
     */
    public function create()
    {

    }
}
