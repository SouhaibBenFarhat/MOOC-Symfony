<?php

namespace Esprit\MoocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Esprit\MoocBundle\Entity\informationFormateur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Esprit\MoocBundle\Form\informationFormateurType;
use Esprit\MoocBundle\Form\QuizzCoursType;
use Esprit\MoocBundle\Entity\Cours;
use Esprit\MoocBundle\Entity\QuizzCours;
use Symfony\Component\HttpFoundation\File;
use Esprit\MoocBundle\Entity\QuizzChapitre;
use Symfony\Component\HttpFoundation\Session;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormateurController
 *
 * @author kods
 */
class FormateurController extends Controller {

    public function espaceFormateurAction() {
        $user = $this->getUser();
        return $this->render('EspritMoocBundle:Mooc:espace_formateur.html.twig', array('user' => $user));
    }

    public function ajouterChapitreAction($idCours) {
        $user = $this->getUser();
        $requete = $this->get('request');
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findOneByidCours($idCours);

        $videoDirectory = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/video/chapitre';
        $presentationDirectory = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/chapitre/presentation';
        $pdfFileDirectory = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/chapitre/pdfFile';

        if ($this->getRequest()->getMethod() === "POST") {
            //recupération des données à partir du fichier twig
            $chapitre = new \Esprit\MoocBundle\Entity\Chapitre();
            $titreChapitre = $requete->get('titre');
            $idCoursChapitre = $requete->get('cours');
            $niveauChapite = $requete->get('niveau');
            $dureeChapitre = $requete->get('duree');
            $introductionChapitre = $requete->get('introduction');
            $descriptionChapitre = $requete->get('description');
            $objectifChapitre = $requete->get('objectif');
            $contenuChapitre = $requete->get('contenu');
            $videoName = $idCoursChapitre . $this->getRequest()->files->get('video')->getClientOriginalName();
            $this->getRequest()->files->get('video')->move($videoDirectory, $videoName);
            $pdfFile = $idCoursChapitre . $this->getRequest()->files->get('file')->getClientOriginalName();
            $this->getRequest()->files->get('file')->move($pdfFileDirectory, $pdfFile);
            $presentationChapitre = $idCoursChapitre . $this->getRequest()->files->get('presentation')->getClientOriginalName();
            $this->getRequest()->files->get('presentation')->move($presentationDirectory, $presentationChapitre);
            //creation de notre objet chapitre et insertion dans la base de données
            $chapitre->setTitreChapitre($titreChapitre);
            $chapitre->setIdCoursChapitre($em->getRepository("EspritMoocBundle:Cours")->findOneByidCours($idCoursChapitre));
            $chapitre->setNiveauChapitre($niveauChapite);
            $chapitre->setDureeChapitre($dureeChapitre);
            $chapitre->setIntroductionChapitre($introductionChapitre);
            $chapitre->setDescriptionChapitre($descriptionChapitre);
            $chapitre->setObjectifChapitre($objectifChapitre);
            $chapitre->setContenuChapitre($contenuChapitre);
            $chapitre->setCheminVideoChapitre($videoName);
            $chapitre->setCheminChapitre($pdfFile);
            $chapitre->setCheminPresentationChapitre($presentationChapitre);
            $chapitre->setDateAjout(new \DateTime());
            $cours->setNombreChapitreCours($cours->getNombreChapitreCours() + 1);
            $em->persist($chapitre);
            $em->flush();
            return $this->redirectToRoute('esprit_mooc_cours');
        }
        return $this->render("EspritMoocBundle:Mooc:Chapitre/ajoutChapitre.html.twig", array('cours' => $cours));
    }

    public function ajoutCoursAction() {

        $id_utilisateur = $this->getuser()->getId();
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id_utilisateur);
        $discipline = $em->getRepository("EspritMoocBundle:Discipline")->findAll();




        $requete = $this->getRequest();
        $titre = $requete->get('titre');
        $disciplineCours = $requete->get('discipline');
        $niveau = $requete->get('niveau');
        $duree = $requete->get('duree');
        $description = $requete->get('description');
        $objectif = $requete->get('objectif');
        $prerequis = $requete->get('prerequis');
        $etat = "en attente";
        $like = 0;



        if ($requete->getMethod() === "POST") {
            $cour = new Cours();
            $discipline2 = $em->getRepository("EspritMoocBundle:Discipline")->findOneByIdDiscipline($disciplineCours);
            $filename = $utilisateur->getId() . $this->getRequest()->files->get('file')->getClientOriginalName();
//            var_dump($filename);
            $directory = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/video/';
            $this->getRequest()->files->get('file')->move($directory, $filename);
            $cour->setTitreCours($titre);
            $cour->setIdDisciplineCours($em->getRepository("EspritMoocBundle:Discipline")->findOneByIdDiscipline($disciplineCours));
            $cour->setDescriptionCours($description);
            $cour->setEtatCours($etat);
            $cour->setObjectifCours($objectif);
            $cour->setPrerequisCours($prerequis);
            $cour->setDureeCours($duree);
            $cour->setLikeCours($like);
            $cour->setVideoCours($filename);
            $cour->setIntroductionCours($this->get('request')->get('introduction'));
            $cour->setNiveauCours($niveau);
            $cour->setIdFormateurCours($utilisateur);
            $cour->setDateAjout(new \DateTime());
            $discipline2->setNombreCours($discipline2->getNombreCours() + 1);
            $em->persist($discipline2);
            $em->persist($cour);
            $em->flush();
            return $this->redirect($this->generateUrl('esprit_mooc_cours'));
        }
        return $this->render('EspritMoocBundle:Mooc:Cours/ajoutCours.html.twig', array('discipline' => $discipline));
    }

    public function signUpFormateurAction() {
        return $this->render('EspritMoocBundle:Mooc:sign_up_formateur.html.twig');
    }

    public function informationFormateurAction(Request $request) {
        $id_utilisateur = $this->getuser()->getId();
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id_utilisateur);
        if ($request->getMethod() === "POST") {
            $formateur = $this->container->get('security.context')->getToken()->getUser();
            $specialite = $request->get('specialite');
            $googlePlus = $request->get('googlePlus');
            $siteWeb = $request->get('siteWeb');
            $sex = $request->get('sex');
            $aPropos = $request->get('description');
            $biographie = $request->get('biographie');
            $miniBiographie = $request->get('mini-biographie');
            $filename = $this->getRequest()->files->get('file')->getClientOriginalName();
            $extension = $this->getRequest()->files->get('file')->guessExtension();

            if ($extension === "pdf") {


                $directory = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/cv/';
                $this->getRequest()->files->get('file')->move($directory, $filename);
                $repertoire = $directory . $filename;
                $informationFormateur = new informationFormateur();
                $informationFormateur->setSpecialite($specialite);
                $informationFormateur->setFilename($filename);
                $informationFormateur->setCv($repertoire);
                $informationFormateur->setGooglePlus($googlePlus);
                $informationFormateur->setSiteWeb($siteWeb);
        
                $informationFormateur->setAPropos($aPropos);
                $informationFormateur->setBiographie($biographie);
                $informationFormateur->setMiniBiographie($miniBiographie);
                $informationFormateur->setFormateur($formateur);
                $utilisateur->setInformationFormateur($informationFormateur);
                $em = $this->getDoctrine()->getManager();
                $em2 = $this->getDoctrine()->getManager();
                $em->persist($informationFormateur);
                $em2->persist($utilisateur);
                $em->flush();
                $em2->flush();
            } else {
                $msg = "this is not a PDF file";
                $this->get('session')->getFlashBag()->add(
                        'notice', $msg
                );
                return $this->render("EspritMoocBundle:Mooc:second_step_inscription_formateur.html.twig");
            }
            $idFormateur = $this->container->get('security.context')->getToken()->getUser()->getId();

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($idFormateur);
            $user->setLocked(true);
            $em->persist($user);
            $em->flush();
            $em2->flush();
            $this->get('security.context')->setToken(null);

            return $this->redirectToRoute('fos_user_security_login', array('notice' => 'formateur'));
        }
        return $this->render("EspritMoocBundle:Mooc:second_step_inscription_formateur.html.twig");
    }

    public function editInformationFormateurAction() {
        $user = $this->getUser();
        $id = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $informationFormateur = $em->getRepository('EspritMoocBundle:informationFormateur')->findOneByFormateur($id);

        $form = $this->createForm(new informationFormateurType(), $informationFormateur);
        $requete = $this->get('request');
        if ($requete->getMethod() == 'POST') {
            $form->bind($requete);
            if ($form->isValid()) {
                $informationFormateur->setFormateur($user);
                $em->persist($informationFormateur);
                $em->flush();
                return $this->redirectToRoute('fos_user_profile_show');
            }
        }
        return $this->render("EspritMoocBundle:Profile:edit_information_Formateur.html.twig", array('form' => $form->createView(), 'etudiant' => $user));
    }

    public function ajouterQuizzChapitreAction($idCours) {
        $requete = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($idCours);
        if ($requete->getMethod() === "POST") {
            $cours = $em->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($requete->get('idCours'));
            $chapitres = $em->getRepository("EspritMoocBundle:Chapitre")->findBy(array('idCoursChapitre' => $cours));
            $quizzChapitre = new QuizzChapitre();
            $titreQuizz = $requete->get('titreQuizz');
            $descriptionQuizz = $requete->get('descriptionQuizz');
            $quizzChapitre->setDateCreation(new \DateTime());
            $quizzChapitre->setNiveauQuizzEntrainement($requete->get('niveauQuizz'));
            $quizzChapitre->setDescriptionQuizz($descriptionQuizz);
            $quizzChapitre->setTitreQuizzEntrainement($titreQuizz);
            $this->get('session')->set('quizzChapitre', $quizzChapitre);
            return $this->render("EspritMoocBundle:Mooc:QuizzChapitre/quizz_chapitre_creation.html.twig", array('chapitres' => $chapitres));
        }
        return $this->render("EspritMoocBundle:Mooc:QuizzChapitre/quizz_chapitre_declaration.html.twig", array('cours' => $cours));
    }

    public function ajouterQuizzCoursAction($idCours) {
        $id_user = $this->getUser();
        $cours = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($idCours);
        $chapitre = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Chapitre")->findByIdCoursChapitre($cours);
        if (count($chapitre) == 0) {
            return $this->redirectToRoute('mes_cours', array('error' => 'vibration', 'Cours' => $idCours));
        }
        $quizzCours = new QuizzCours();
        $form = $this->createForm(new QuizzCoursType($id_user, $idCours), $quizzCours);
        $requete = $this->get('request');
        if ($requete->getMethod() == 'POST') {
            $form->bind($requete);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $quizzCours->setNiveauQuizzCours($requete->get('niveauQuizz'));
                $em->persist($quizzCours);
//                $em->flush();
                $cours->setIdQuizzCours($quizzCours);
                $em->flush();
                return $this->render("EspritMoocBundle:Mooc:QuizzCours/quizz_cours_creation.html.twig", array('quizzCours' => $quizzCours));
            }
        }
        return $this->render("EspritMoocBundle:Mooc:QuizzCours/quizz_cours_declaration.html.twig", array('cours' => $cours, 'form' => $form->createView()));
    }

    public function creerQuizzChapitreAction() {
        $requete = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        if ($requete->getMethod() === "POST") {
            $chapitre = $em->getRepository("EspritMoocBundle:Chapitre")->findOneByIdChapitre($requete->get('idChapitre'));
            $nombreQuestion = $requete->get('nbr_question');
            $nombreReponse = $requete->get('nbr_reponse_question');
            $quizzChapitre = $this->get('session')->get('quizzChapitre');
            $quizzChapitre->setIdChapitreQuizzEntrainement($chapitre);
            $this->get('session')->set('quizzChapitre', $quizzChapitre);
//          die('---' . $this->get('session')->get('quizzChapitre')->getIdChapitreQuizzEntrainement()->getIdChapitre() . '---');
            return $this->render("EspritMoocBundle:Mooc:QuizzChapitre/quizz_chapitre_remplir.html.twig", array('nombreQuestion' => $nombreQuestion, 'nombreReponse' => $nombreReponse));
        }
        return $this->redirectToRoute('quizz_chapitre');
    }

    public function creerQuizzCoursAction() {
        $requete = $this->get('request');
        $idQuizzCours = $requete->get('idQuizzCours');
        $nbrQuestion = $requete->get('nbr_question');
        $nbrReponseQuestion = $requete->get('nbr_reponse_question');
        if ($nbrQuestion != "" && $nbrReponseQuestion != "") {
            return $this->render("EspritMoocBundle:Mooc:QuizzCours/quizz_cours_remplir.html.twig", array('nombreQuestion' => $nbrQuestion, 'nombreReponse' => $nbrReponseQuestion, 'idQuizzCours' => $idQuizzCours));
        }
        return $this->render("EspritMoocBundle:Mooc:QuizzCours/quizz_cours_declaration.html.twig");
    }

    public function sauvegarderQuizzChapitreAction() {
        $i = 1;
        $j = 1;
        $em = $this->getDoctrine()->getManager();
        $quizzChapitre = $this->get('session')->get('quizzChapitre');
        $chapitre = $em->getRepository("EspritMoocBundle:Chapitre")->findOneByIdChapitre($quizzChapitre->getIdChapitreQuizzEntrainement());
        $requete = $this->get('request');
        $nbrQuestion = $requete->get('nombreQuestion');
        $nombreReponse = $requete->get('nombreReponse');
        $quizzChapitre->setIdChapitreQuizzEntrainement($chapitre);
        $em->persist($quizzChapitre);
        $em->flush();
        $chapitre->setIdQuizzChapitre($quizzChapitre);
        $em->persist($chapitre);
        $em->flush();
        while ($i <= $nbrQuestion) {
            $texteQuestion = $requete->get('question' . $i);
            $explication = $requete->get('explication' . $i);
            $question = new \Esprit\MoocBundle\Entity\Question();
            $question->setTexteQuestion($texteQuestion);
            $question->setIdQuizzEntrainementQuestion($quizzChapitre);
            $question->setExplication($explication);
            $em->persist($question);
            $em->flush();
            while ($j <= $nombreReponse) {
                $texteReponse = $requete->get('reponse' . $i . $j);
                $reponse = new \Esprit\MoocBundle\Entity\Reponse();
                $reponse->setTexteReponse($texteReponse);
                if ($requete->get('etatreponse' . $i . $j) == "Vrai") {
                    $reponse->setEtatReponse('vrai');
                } else {
                    $reponse->setEtatReponse('fausse');
                }
                $reponse->setIdQuestionReponse($question);
                $em->persist($reponse);
                $em->flush();
                $j++;
            }
            $i++;
            $j = 1;
        }
        return $this->redirectToRoute('esprit_mooc_home');
    }

    public function sauvegarderQuizzCoursAction() {
        $i = 1;
        $j = 1;
        $em = $this->getDoctrine()->getManager();
        $requete = $this->get('request');
        $nbrQuestion = $requete->get('nombreQuestion');
        $nombreReponse = $requete->get('nombreReponse');
        $idLastQuizz = $requete->get('idQuizzCours');
        $quizzCours = $em->getRepository("EspritMoocBundle:QuizzCours")->findOneByIdQuizzCours($idLastQuizz);
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($quizzCours->getIdCoursQuizzCours());
        $cours->setIdQuizzCours($quizzCours);
        $em->persist($cours);
        $em->flush();
        while ($i <= $nbrQuestion) {
            $texteQuestion = $requete->get('question' . $i);
            $explication = $requete->get('explication' . $i);
            $question = new \Esprit\MoocBundle\Entity\Question();
            $question->setTexteQuestion($texteQuestion);
            $question->setIdQuizzCoursQuestion($em->getRepository('EspritMoocBundle:QuizzCours')->findOneByidQuizzCours($idLastQuizz));
            $question->setExplication($explication);
            $em->persist($question);
            $em->flush();
            while ($j <= $nombreReponse) {
                $texteReponse = $requete->get('reponse' . $i . $j);
                $reponse = new \Esprit\MoocBundle\Entity\Reponse();
                $reponse->setTexteReponse($texteReponse);
                if ($requete->get('etatreponse' . $i . $j) == "Vrai") {
                    $reponse->setEtatReponse('vrai');
                } else {
                    $reponse->setEtatReponse('fausse');
                }
                $reponse->setIdQuestionReponse($question);
                $em->persist($reponse);
                $em->flush();
                $j++;
            }
            $i++;
            $j = 1;
        }
        return $this->redirectToRoute('esprit_mooc_home');
    }

     public function envoyerInvitationToEntrepriseAction($idEntreprise) {
        $formateur=$this->getUser();
          $idFormateur=$formateur->getId();
          $em = $this->getDoctrine()->getManager();
           $entreprise=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($idEntreprise);    
          $invitation=new \Esprit\MoocBundle\Entity\InvitationFormateurEntreprise();
          $invitation->setIdEntreprise($entreprise);
          $invitation->setIdFormateur($formateur);
          $invitation->setEtat('en attente');
          $em->persist($invitation);
          $em->flush();
       return $this->redirect($this->generateUrl('admin_liste_entrprises'));        
    }

     public function listeInviToFormateurAction() {
         
          $id=$this->getUser()->getId();
          $requete=$this->getDoctrine()->getEntityManager()
                  ->createQuery('select i from EspritMoocBundle:InvitationEntrepriseFormateur i where  i.idFormateur= :id and i.etat= :etat');
          $requete->setParameter('id', $id);
          $requete->setParameter('etat', 'en attente');
          $invitations=$requete->getResult();
          //var_dump($invitations);
//          foreach ($invitations as $i){
//           $entreprises=$this->getDoctrine()->getEntityManager()->getRepository('EspritMoocBundle:Utilisateur')->findById($i); 
//             
//          }
          $information=$this->getDoctrine()->getEntityManager()->getRepository('EspritMoocBundle:InformationEntreprise')->findAll(); 
          
        return $this->render('EspritMoocBundle:Mooc:liste_invitations_vue_formateur.html.twig',array('invitations'=>$invitations,'information'=>$information));
    }
    
     public function accepterEntrepriseAction() {
         $req=$this->get('request');
       
          $idEntreprise=$req->get('idEntreprise');
        $formateur=$this->getUser();
          $idFormateur=$formateur->getId();
          $em = $this->getDoctrine()->getManager();
          $entreprise=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($idEntreprise); 
          $formateur->setIdEntrepriseUtlisateur($entreprise);
          
          $requete=$this->getDoctrine()
                  ->getEntityManager()
                  ->createQuery('select i from EspritMoocBundle:InvitationEntrepriseFormateur i where i.idFormateur= :idFormateur and i.idEntreprise= :idEntreprise');
          $requete->setParameter('idFormateur', $idFormateur);
          $requete->setParameter('idEntreprise', $idEntreprise);       
          $idInvitation=$requete->getResult();
//          var_dump($idInvitation);
          $invitation=$em->getRepository('EspritMoocBundle:InvitationEntrepriseFormateur')->findOneById($idInvitation);
//          var_dump($invitation);
        
          $em->persist($formateur);
         $em->remove($invitation);
        $em->flush();
       return $this->redirect($this->generateUrl('formateur_liste_invi'));
       
//       }
//       return $this->redirect($this->generateUrl('espace_formateur'));
       
    }
   public function refuserEntrepriseAction() {
        $req=$this->get('request');
        $idEntreprise=$req->get('idEntreprise');
         $formateur=$this->getUser();
          $idFormateur=$formateur->getId();
          $em = $this->getDoctrine()->getManager();
               
          $requete=$this->getDoctrine()
                  ->getEntityManager()
                  ->createQuery('select i from EspritMoocBundle:InvitationEntrepriseFormateur i where i.idFormateur= :idFormateur and i.idEntreprise= :idEntreprise');
          $requete->setParameter('idFormateur', $idFormateur);
          $requete->setParameter('idEntreprise', $idEntreprise);       
          $idInvitation=$requete->getResult();       
          $invitation=$em->getRepository('EspritMoocBundle:InvitationEntrepriseFormateur')->findOneById($idInvitation);

          $em->remove($invitation);
          $em->flush();
          
         return $this->redirect($this->generateUrl('espace_formateur'));
         
    }
    public function mesCoursAction() {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findByIdFormateurCours($this->getUser());
        $chapitre = $em->getRepository("EspritMoocBundle:Chapitre")->findByIdCoursChapitre($cours);
        $quizzCours = $em->getRepository("EspritMoocBundle:QuizzCours")->findByIdCoursQuizzCours($cours);
        $quizzChapitre = $em->getRepository("EspritMoocBundle:QuizzChapitre")->findByIdChapitreQuizzEntrainement($chapitre);
        $discipline = $em->getRepository("EspritMoocBundle:Discipline")->findAll();
        return $this->render("EspritMoocBundle:Mooc:Cours/mesCours.html.twig", array('disciplines' => $discipline, 'cours' => $cours, 'chapitres' => $chapitre, 'quizzCours' => $quizzCours, 'quizzChapitre' => $quizzChapitre));
    }

    public function listeEntreprisesAction(Request $request)
    {
         $em=$this->getDoctrine()->getManager();
        $entreprises=$em->getRepository('EspritMoocBundle:Utilisateur')->findEntreprises();
        $paginator = $this->get('knp_paginator');
         $pagination = $paginator->paginate($entreprises,$request->query->getInt('page', 1), 9);
        $information=$em->getRepository('EspritMoocBundle:InformationEntreprise')->findAll();
        $id=$this->getUser()->getId();
        $requete=$this->getDoctrine()->getEntityManager()
                  ->createQuery('select i from EspritMoocBundle:InvitationFormateurEntreprise i where  i.idFormateur= :id and i.etat= :etat');
          $requete->setParameter('id', $id);
          $requete->setParameter('etat', 'en attente');
          $invitations=$requete->getResult();
        return $this->render('EspritMoocBundle:Mooc:liste_entreprises.html.twig',array('pagination'=>$pagination,'information'=>$information,'invitations'=>$invitations));
    }
}
