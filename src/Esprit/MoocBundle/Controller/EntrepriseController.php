<?php

namespace Esprit\MoocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Esprit\MoocBundle\Entity\informationEntreprise;
use Esprit\MoocBundle\Entity\UserPhoto;
use Esprit\MoocBundle\Form\informationEntrepriseType;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SocieteController
 *
 * @author kods
 */
class EntrepriseController extends Controller {

    public function espaceEntrepriseAction() {
        $user = $this->getUser();
        return $this->render('EspritMoocBundle:Mooc:espace_entreprise.html.twig', array('user' => $user));
    }

    //entreprise
    public function signUpEntrepriseAction() {
        return $this->render('EspritMoocBundle:Mooc:sign_up_entreprise.html.twig');
    }

     public function listeMesFormateursAction() {
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        // $em=$this->getDoctrine()->getManager();
        $requete = $this->getDoctrine()->getEntityManager()
                ->createQuery('select f from EspritMoocBundle:Utilisateur f  where f.idEntrepriseUtlisateur = :id');
        $requete->setParameter('id', $id);
        $formateurs = $requete->getResult();
//          var_dump($formateurs);
        $informationFormateurs = $em->getRepository('EspritMoocBundle:informationFormateur')->findAll();
        //$formateurs=$em->getRepository('EspritMoocBundle:Utilisateur')->findFormateursByEntreprise($id);
//        var_dump($informationFormateurs);
        return $this->render('EspritMoocBundle:Mooc:liste_mes_formateurs.html.twig', array('formateurs' => $formateurs, 'information' => $informationFormateurs));
    }

     public function RechercherMesFormateursAction() {
        $req = $this->get('request');
        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $formateurs = $em->getRepository('EspritMoocBundle:Utilisateur')->findFormateursByEntreprise($id);
        if ($req->getMethod() == "POST") {
            $nom = $req->get('nom');
            $formateurs = $em->getRepository('EspritMoocBundle:Utilisateur')->findMesFormateurByNom($id, $nom);
            return $this->render("EspritMoocBundle:Mooc:liste_mes_formateurs.html.twig", array('formateurs' => $formateurs));
        }
        return $this->render('EspritMoocBundle:Mooc:liste_mes_formateurs.html.twig', array('formateurs' => $formateurs));
    }

     public function listeAutreFormateursAction() {
//        $id=$this->getUser()->getId();
//        $em=$this->getDoctrine()->getManager();
//        $formateurs=$em->getRepository('EspritMoocBundle:Utilisateur')->findAutreFormateursByEntreprise($id);
//        $informationFormateurs = $em->getRepository('EspritMoocBundle:informationFormateur')->findAll();
//        $requete=$this->getDoctrine()->getEntityManager()
//                  ->createQuery('select i from EspritMoocBundle:InvitationEntrepriseFormateur i  where i.idEntreprise = :id');
//          $requete->setParameter('id', $id);
//          $invitations=$requete->getResult();
//          //var_dump($invitations);
//        return $this->render('EspritMoocBundle:Mooc:liste_autre_formateurs.html.twig',array('formateurs'=>$formateurs,'information'=>$informationFormateurs,'invitations'=>$invitations));
//    

        $id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $invitationsEntrepriseFormateur = $em->getRepository('EspritMoocBundle:InvitationEntrepriseFormateur')->findBy(array('idEntreprise' => $id));
        $formateurs = $em->getRepository('EspritMoocBundle:Utilisateur')->findUserByRole('%ROLE_FORMATEUR%');
        return $this->render('EspritMoocBundle:Mooc:liste_autre_formateurs.html.twig', array('formateurs' => $formateurs, 'invitations' => $invitationsEntrepriseFormateur));
    }
    
    
    public function informationEntrepriseAction() {
        $requete = $this->getRequest();
        $id_utilisateur = $this->getuser()->getId();
        $em = $this->getDoctrine()->getManager();

        $utilisateur = $em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id_utilisateur);

        if ($requete->getMethod() === "POST") {

//          $user = $this->getuser();
            $entreprise = $this->container->get('security.context')->getToken()->getUser();
            $specialite = $requete->get('specialite');
            $siteWeb = $requete->get('siteWeb');
            $abreviation = $requete->get('abreviation');
            $gouvernerat = $requete->get('gouvernerat');
            $adresse = $requete->get('adresse');
            $codePostale = $requete->get('codePostale');
            $matriculeFiscal = $requete->get('matriculeFiscal');
            $type = $requete->get('type');
            $nationnalite = $requete->get('nationnalite');
            $description = $requete->get('description');
            $raisonInscription = $requete->get('raisonInscription');
            $numTel = $requete->get('numTel');
            $filename = $entreprise->getId() . $this->getRequest()->files->get('file')->getClientOriginalName();
            $extension = $this->getRequest()->files->get('file')->guessExtension();
            $userPhoto = new UserPhoto();
            if ($extension === "pdf") {


                $logoName = $entreprise->getId() . $this->getRequest()->files->get('logo')->getClientOriginalName();
                $logoDirectory = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/userPhoto/';
                $this->getRequest()->files->get('logo')->move($logoDirectory, $logoName);
                $userPhoto->setPath($logoName);



                $directory = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/attestation/';
                $this->getRequest()->files->get('file')->move($directory, $filename);
                $repertoire = $directory . $filename;
                $informationEntreprise = new informationEntreprise();
                $informationEntreprise->setSpecialite($specialite);
                $informationEntreprise->setSiteWeb($siteWeb);
                $informationEntreprise->setAbreviation($abreviation);
                $informationEntreprise->setGouvernerat($gouvernerat);
                $informationEntreprise->setAdresse($adresse);
                $informationEntreprise->setCodePostale($codePostale);
                $informationEntreprise->setMatriculeFiscal($matriculeFiscal);
                $informationEntreprise->setType($type);
                $informationEntreprise->setNationnalite($nationnalite);
                $informationEntreprise->setDescription($description);
                $informationEntreprise->setRaisonInscription($raisonInscription);
                $informationEntreprise->setNumTel($numTel);
                $informationEntreprise->setFilename($filename);
                $informationEntreprise->setAttestation($repertoire);
                $informationEntreprise->setEntreprise($entreprise);

                $em->persist($userPhoto);
                $em = $this->getDoctrine()->getManager();
                $em2 = $this->getDoctrine()->getManager();
                $utilisateur->setInformationEntreprise($informationEntreprise);
                $utilisateur->setUserPhoto($userPhoto);
                $em2->persist($utilisateur);
                $em->persist($informationEntreprise);
                $em->flush();
                $em2->flush();
            } else {
                die("this is not a pdf file");
                return $this->render("EspritMoocBundle:Mooc:second_step_inscription_Entreprise.html.twig");
            }
            $idFormateur = $this->container->get('security.context')->getToken()->getUser()->getId();

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($idFormateur);
            $user->setLocked(true);
            $em->persist($user);
            $em->flush();
            $this->get('security.context')->setToken(null);

            return $this->redirect($this->generateUrl('fos_user_security_login', array('notice' => 'Entreprise')));
        }
        return $this->render("EspritMoocBundle:Mooc:second_step_inscription_Entreprise.html.twig");
    }

    public function editInformationEntrepriseAction() {
        $user = $this->getUser();
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $informationEntreprise = $em->getRepository('EspritMoocBundle:informationEntreprise')->findOneByEntreprise($id);

        $form = $this->createForm(new informationEntrepriseType(), $informationEntreprise);
        $requete = $this->get('request');
        if ($requete->getMethod() == 'POST') {
            $form->bind($requete);
            if ($form->isValid()) {
                $informationEntreprise->setEntreprise($user);
                $em->persist($informationEntreprise);
                $em->flush();
                return $this->redirectToRoute('fos_user_profile_show');
            }
        }
        return $this->render("EspritMoocBundle:Profile:edit_information_Entreprise.html.twig", array('form' => $form->createView(), 'etudiant' => $user));
    }

     public function listeInviToEntrepriseAction() {
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $requete = $this->getDoctrine()->getEntityManager()
                ->createQuery('select f from EspritMoocBundle:Utilisateur f INNER JOIN EspritMoocBundle:InvitationFormateurEntreprise i where f.id=i.idFormateur and i.idEntreprise= :id and i.etat= :etat');
        $requete->setParameter('id', $id);
        $requete->setParameter('etat', 'en attente');
        $formateurs = $requete->getResult();
        $informationFormateurs = $em->getRepository('EspritMoocBundle:informationFormateur')->findAll();

        return $this->render('EspritMoocBundle:Mooc:liste_invitations_vue_entreprise.html.twig', array('formateurs' => $formateurs, 'information' => $informationFormateurs));
    }

    public function accepterFormateurAction($idFormateur) {
        $entreprise = $this->getUser();
        $idEntreprise = $entreprise->getId();
        $em = $this->getDoctrine()->getManager();
        $formateur = $em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($idFormateur);
        $formateur->setIdEntrepriseUtlisateur($entreprise);

        $requete = $this->getDoctrine()
                ->getEntityManager()
                ->createQuery('select i from EspritMoocBundle:InvitationFormateurEntreprise i where i.idFormateur= :idFormateur and i.idEntreprise= :idEntreprise');
        $requete->setParameter('idFormateur', $idFormateur);
        $requete->setParameter('idEntreprise', $idEntreprise);
        $idInvitation = $requete->getResult();
        $invitation = $em->getRepository('EspritMoocBundle:InvitationFormateurEntreprise')->findOneById($idInvitation);
        $em->persist($formateur);
        $em->remove($invitation);
        $em->flush();

        return $this->redirect($this->generateUrl('entreprise_liste_invi'));
    }


    public function refuserFormateurAction($idFormateur) {
        $entreprise = $this->getUser();
        $idEntreprise = $entreprise->getId();
        $em = $this->getDoctrine()->getManager();

        $requete = $this->getDoctrine()
                ->getEntityManager()
                ->createQuery('select i from EspritMoocBundle:InvitationFormateurEntreprise i where i.idFormateur= :idFormateur and i.idEntreprise= :idEntreprise');
        $requete->setParameter('idFormateur', $idFormateur);
        $requete->setParameter('idEntreprise', $idEntreprise);
        $idInvitation = $requete->getResult();
        $invitation = $em->getRepository('EspritMoocBundle:InvitationFormateurEntreprise')->findOneById($idInvitation);

        $em->remove($invitation);
        $em->flush();

        return $this->redirect($this->generateUrl('entreprise_liste_invi'));
    }

   public function envoyerInvitationToFormateurAction($idFormateur) {
        $entreprise = $this->getUser();
        //$idEntreprise=$entreprise->getId();
        $em = $this->getDoctrine()->getManager();
        $formateur = $em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($idFormateur);

        $invitation = new \Esprit\MoocBundle\Entity\InvitationEntrepriseFormateur();
        $invitation->setIdEntreprise($entreprise);
        $invitation->setIdFormateur($formateur);
        $invitation->setEtat('en attente');
        $em->persist($invitation);
        $em->flush();
        return $this->redirect($this->generateUrl('espace_entreprise'));
    }
}
