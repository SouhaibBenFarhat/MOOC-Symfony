<?php

namespace Esprit\MoocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Esprit\MoocBundle\Entity\Appreciation;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApprenantController
 *
 * @author souhaib
 */
class ApprenantController extends Controller {

    public function espaceApprenantAction() {
        $user = $this->getUser();
        return $this->render('EspritMoocBundle:Mooc:espace_apprenant.html.twig', array('user' => $user));
    }

    //inscri apprenant
    public function signInApprenantAction() {
        return $this->render('EspritMoocBundle:Mooc:signInApprenant.html.twig');
    }

    public function chapitreAction() {
        return $this->render('EspritMoocBundle:Mooc:chapitre.html.twig');
    }

    //apprenant
    //apprenant
    public function bibliothequeAction(Request $request) {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->get('doctrine.orm.entity_manager');
        $dql = "SELECT a FROM EspritMoocBundle:Bibliotheque a where a.idApprenantBibliotheque=" . $user->getId();
        $query = $em->createQuery($dql);
        $discipline = $em->getRepository("EspritMoocBundle:Discipline")->findAll();
        $formateur = $em->getRepository("EspritMoocBundle:InformationFormateur")->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($query, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 6/* limit per page */);
        return $this->render('EspritMoocBundle:Mooc:bibliotheque.html.twig', array('pagination' => $pagination, 'user' => $user, 'disciplines' => $discipline, 'formateurs' => $formateur));
    }

    public function ajoutBibAction($id) {
        try {
            $id_ap = $this->container->get('security.context')->getToken()->getUser()->getId();
            $bib = new \Esprit\MoocBundle\Entity\Bibliotheque();
            $em = $this->getDoctrine()->getManager();
            $cour = $em->getRepository('EspritMoocBundle:Cours')->findOneByIdCours($id);
            $aprennant = $em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id_ap);

            $bib->setIdCoursBibliotheque($cour);
            $bib->setIdApprenantBibliotheque($aprennant);
            $em->persist($bib);
            $em->flush();

            return $this->redirect($this->generateUrl('apprenant_bibliotheque'));
        } catch (\Doctrine\DBAL\DBALException $ex) {
            return $this->render('EspritMoocBundle:Mooc:exception.html.twig');
        }
        return $this->render('EspritMoocBundle:Mooc:bibliotheque.html.twig');
    }

    public function supprimerbibliothequeAction($id) {

        $em = $this->getDoctrine()->getManager();
        $cour = $em->getRepository('EspritMoocBundle:Bibliotheque')->findOneByIdBibliotheque($id);
        //var_dump($cour);
        $em->remove($cour);
        $em->flush();
        return $this->redirect($this->generateUrl('espace_apprenant'));
    }

    public function signUpApprenantAction() {
        return $this->render('EspritMoocBundle:Mooc:sign_up_apprenant.html.twig');
    }

    public function appreciationAction($idCours) {
        $em = $this->getDoctrine()->getManager();
        $requete = $this->getRequest();
        $contenu = $requete->get('contenu');
        $appreciation = new Appreciation();
        if ($requete->getMethod() === "POST") {
            $appreciation->setApprenant($this->getUser());
            $cours = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($idCours);
            $appreciation->setIdCoursAppreciation($cours);
            $appreciation->setApprenant($this->getUser());
            $appreciation->setValeurAppreciation($contenu);
            $em->persist($appreciation);
            $em->flush();
            return $this->redirectToRoute('esprit_mooc_cours');
        }
    }

}
