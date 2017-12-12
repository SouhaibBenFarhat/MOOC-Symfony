<?php

namespace Esprit\MoocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Esprit\MoocBundle\Entity\ScoreQuizzFinal;
use Esprit\MoocBundle\Entity\ScoreQuizzCours;
use Esprit\MoocBundle\Entity\ScoreQuizzChapitre;
use Esprit\MoocBundle\Form\informationEntrepriseType;
use Esprit\MoocBundle\Repository\CoursRepository;
use Esprit\MoocBundle\Entity\Visite;
use Esprit\MoocBundle\Entity\Aime;
use Esprit\MoocBundle\Entity\Suivie;
use Esprit\MoocBundle\Entity\SuiviDiscipline;
use Esprit\MoocBundle\Entity\Progression;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of CoursController
 *
 * @author souhaib
 */
class CoursController extends Controller {

    public function coursAction(Request $request) {
        $em = $this->get('doctrine.orm.entity_manager');
        $discipline = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Discipline")->findAll();
        $formateur = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:InformationFormateur")->findAll();
        $topCours = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Cours")->findBy(array(), array('nombreVisite' => 'desc'), 5);
        $cours = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Cours")->findBy(array(), array('nombreVisite' => 'desc'));
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $cours, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 21/* limit per page */
        );

        return $this->render('EspritMoocBundle:Mooc:Cours/CoursesList.html.twig', array('pagination' => $pagination, 'disciplines' => $discipline, 'formateurs' => $formateur, 'topCours' => $topCours));
    }

    public function coursByDisciplineAction(Request $request, $idDiscipline) {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findByIdDisciplineCours($idDiscipline);
        $discipline = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Discipline")->findAll();
        $formateur = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:InformationFormateur")->findAll();
        $topCours = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Cours")->findBy(array(), array('nombreVisite' => 'desc'), 5);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $cours, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 21/* limit per page */
        );
        return $this->render('EspritMoocBundle:Mooc:Cours/CoursesList.html.twig', array('pagination' => $pagination, 'disciplines' => $discipline, 'formateurs' => $formateur, 'topCours' => $topCours));
    }

    public function courseDetailsAction(Request $request, $idCours) {
//        die('---' . $idCours . '---');
        $em = $this->getDoctrine()->getManager();
        $discipline = $em->getRepository("EspritMoocBundle:Discipline")->findAll();
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($idCours);
        $aime = $em->getRepository("EspritMoocBundle:Aime")->findBy(array('idUtilisateurAime' => $this->getUser(), 'idCoursAime' => $cours));
        $suivie = $em->getRepository("EspritMoocBundle:Suivie")->findBy(array('idCoursSuivie' => $idCours, 'idUtilisateurSuivie' => $this->getUser()));
//        $idCours = $request->query->get('id');
        $coursdet = $em->getRepository('EspritMoocBundle:Cours')->findOneByIdCours($idCours);
        $coursdet->setNombreVisite($coursdet->getNombreVisite() + 1);
        $em->persist($coursdet);
        $em->flush();
        $progression = $em->getRepository("EspritMoocBundle:Progression")->findOneBy(array('idUtilisateurProgression' => $this->getUser(), 'idCoursProgression' => $cours, 'typeProgression' => 'cours', 'etatProgression' => 'terminer'));
        if (is_object($progression)) {
            $etatProgression = 'true';
        } else {
            $etatProgression = 'false';
        }
        $formateur = $coursdet->getIdFormateurCours();
        $coursFormateur = $em->getRepository("EspritMoocBundle:Cours")->findByIdFormateurCours($formateur);
        $chapitres = $em->getRepository("EspritMoocBundle:Chapitre")->findByidCoursChapitre($coursdet);
        if (is_object($this->getUser())) {
            $this->visiteCours($this->getUser(), $coursdet);
        }
        return $this->render("EspritMoocBundle:Mooc:Cours/CourseDetails.html.twig", array('suivie' => $suivie, 'aime' => $aime, 'cours' => $coursdet, 'chapitres' => $chapitres, 'coursFormateur' => $coursFormateur, 'disciplines' => $discipline, 'etatProgression' => $etatProgression));
    }

    public function afficherChapitreAction($idChapitre, $idCours) {
        $em = $this->getDoctrine()->getManager();
        $chapitre = $em->getRepository("EspritMoocBundle:Chapitre")->findOneByIdChapitre($idChapitre);
        $chapitres = $em->getRepository("EspritMoocBundle:Chapitre")->findByidCoursChapitre($idCours);
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($idCours);
        $discipline = $em->getRepository("EspritMoocBundle:Discipline")->findAll();
        $progression = $em->getRepository("EspritMoocBundle:Progression")->findOneBy(array('idUtilisateurProgression' => $this->getUser(), 'idChapitreProgression' => $chapitre));
        $progressions = $em->getRepository("EspritMoocBundle:Progression")->findBy(array('idUtilisateurProgression' => $this->getUser(), 'idCoursProgression' => $cours, 'typeProgression' => 'chapitre'));

        return $this->render("EspritMoocBundle:Mooc:Chapitre/chapitreDetails.html.twig", array('chapitre' => $chapitre, 'chapitres' => $chapitres, 'disciplines' => $discipline, 'progression' => $progression, 'progressions' => $progressions));
    }

    public function progressionChapitreAction($idChapitre, $idCours) {
        $this->progressionUtilisateur($idChapitre);
        return $this->redirectToRoute('afficher_chapitre', array('idChapitre' => $idChapitre, 'idCours' => $idCours));
    }

    public function progressionCoursAction($idCours, $idChapitre) {
        $this->progressionUtilisateur($idChapitre);
        if ($this->validerProgressionCours($idCours) == 'FALSE') {
            return $this->redirectToRoute('afficher_chapitre', array('idChapitre' => $idChapitre, 'idCours' => $idCours, 'notice' => 'error'));
        }
        $this->progressionUtilisateurCours($idCours);
        return $this->redirectToRoute('esprit_mooc_details_cours', array('idCours' => $idCours));
    }

    public function afficherQuizzChapitreAction($idChapitre) {

        $quizz = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:QuizzChapitre")->findOneByidChapitreQuizzEntrainement($idChapitre);
        $em = $this->getDoctrine()->getManager();
        $progression = $em->getRepository("EspritMoocBundle:Progression")
                ->findOneBy(array('idUtilisateurProgression' => $this->getUser(), 'idChapitreProgression' => $idChapitre));

        if (!is_object($quizz) || !is_object($progression)) {
            return $this->render('EspritMoocBundle:Mooc:exception.html.twig');
        } else {
            $reponses = $em->getRepository("EspritMoocBundle:Reponse");
            $question = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Question")->findByIdQuizzEntrainementQuestion($quizz->getIdQuizzEntrainement());
            $reponse = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Reponse")->findAll($question);
            $reponseExacte = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Reponse")->findBy(array('idQuestionReponse' => $question, 'etatReponse' => 'vrai'));
            foreach ($question as $q) {
                $r = $reponses->findBy(array('idQuestionReponse' => $q->getIdQuestion()));
                if (count($r) < 2) {
                    return $this->render('EspritMoocBundle:Mooc:exception.html.twig', array('error' => 'something went wrong with this quizz, PLZ come back later on'));
                }
            }
            if ((count($question) == 0) || (count($reponse) == 0) || (count($reponseExacte) == 0)) {
                return $this->render('EspritMoocBundle:Mooc:exception.html.twig', array('error' => 'something went wrong with this quizz, PLZ come back later on'));
            }
            $this->get('session')->set('reponseExacte', $reponseExacte);
            $this->get('session')->set('question', $question);
            $this->get('session')->set('reponse', $reponse);
            $this->get('session')->set('quizzChapitre', $quizz);
        }
        return $this->render('EspritMoocBundle:Mooc:QuizzChapitre/quizz_chapitre_affichage.html.twig', array('question' => $question, 'reponse' => $reponse, 'quizz' => $quizz));
    }

    public function afficherQuizzAction($idcours) {
        $em = $this->getDoctrine()->getManager();
        $reponses = $em->getRepository("EspritMoocBundle:Reponse");
        $quizz = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:QuizzCours")->findOneByidCoursQuizzCours($idcours);
        $progression = $em->getRepository("EspritMoocBundle:Progression")
                ->findOneBy(array('idUtilisateurProgression' => $this->getUser(), 'idCoursProgression' => $idcours, 'etatProgression' => 'terminer'));
        if (!is_object($quizz) || !is_object($progression)) {
            return $this->render('EspritMoocBundle:Mooc:exception.html.twig');
        } else {
            $question = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Question")->findByidQuizzCoursQuestion($quizz->getIdQuizzCours());
            $reponse = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Reponse")->findByIdQuestionReponse($question);
            $reponseExacte = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Reponse")->findBy(array('idQuestionReponse' => $question, 'etatReponse' => 'vrai'));
            foreach ($question as $q) {
                $r = $reponses->findBy(array('idQuestionReponse' => $q->getIdQuestion()));
                if (count($r) < 2) {
                    return $this->render('EspritMoocBundle:Mooc:exception.html.twig', array('error' => 'something went wrong with this quizz, PLZ come back later on'));
                }
            }

            if ((count($question) == 0) || (count($reponse) == 0) || (count($reponseExacte) == 0)) {
                return $this->render('EspritMoocBundle:Mooc:exception.html.twig', array('error' => 'something went wrong with this quizz, PLZ come back later on'));
            }
            $this->get('session')->set('reponseExacte', $reponseExacte);
            $this->get('session')->set('question', $question);
            $this->get('session')->set('reponse', $reponse);
            $this->get('session')->set('quizzCours', $quizz);
        }
        return $this->render('EspritMoocBundle:Mooc:QuizzCours/quizz_cours_affichage.html.twig', array('question' => $question, 'reponse' => $reponse, 'quizz' => $quizz));
    }

    public function calculerScoreQuizzChapitreAction() {
        $i = 1;
        $em = $this->getDoctrine()->getManager();
        $requete = $this->getRequest();
        $reponse = $this->get('session')->get('reponseExacte');
        $nombreReponseExacte = $this->nombreReponseExacte($reponse);
        $nombreQuestion = $requete->get('nombreQuestion');
        $nombreReponse = $requete->get('nombreReponse');
        $score = 0;
        $unite = 20 / $nombreReponseExacte;
        while ($i <= $nombreQuestion) {
            $j = 1;
            while ($j <= $nombreReponse) {
                if ($requete->get('checkbox' . $i . $j) == "vrai") {
                    $score = $score + $unite;
                } elseif ($requete->get('checkbox' . $i . $j) == "fausse") {
                    $score = $score - $unite;
                } else {
                    $score = $score;
                }
                $j = $j + 1;
            }
            $i = $i + 1;
        }
        $quizzChapitre = $this->get('session')->get('quizzChapitre');
        $scoreQuizzChapitre = $em->getRepository("EspritMoocBundle:ScoreQuizzChapitre")->findOneBy(array('idApprenantScoreQuizzChapitre' => $this->getUser()->getId(), 'idQuizzChapitreScoreQuizzChapitre' => $quizzChapitre));
        $quizzChapitre2 = $em->getRepository("EspritMoocBundle:QuizzChapitre")->findOneByIdQuizzEntrainement($quizzChapitre);
        if (gettype($scoreQuizzChapitre) != 'object') {
            $newScoreQuizzChapitre = new ScoreQuizzChapitre();
            $newScoreQuizzChapitre->setIdQuizzChapitreScoreQuizzChapitre($em->getRepository("EspritMoocBundle:QuizzChapitre")->findOneByIdQuizzEntrainement($quizzChapitre2->getIdQuizzEntrainement()));
            $newScoreQuizzChapitre->setIdApprenantScoreQuizzChapitre($this->getUser());
            $newScoreQuizzChapitre->setScoreQuizzChapitre($score);
            $newScoreQuizzChapitre->setTypeBadgeScoreQuizzChapitre("BAD");
            $newScoreQuizzChapitre->setDate(new \DateTime());
            $em->persist($newScoreQuizzChapitre);
            $em->flush();
        } else {

            $score = $scoreQuizzChapitre->getScoreQuizzChapitre();
            return $this->render("EspritMoocBundle:Mooc:QuizzChapitre/quizz_chapitre_resultat.html.twig", array('score' => $score, 'message' => "Il est interdit de repasser une epreuve", 'quizz' => $quizzChapitre));
        }
        return $this->render("EspritMoocBundle:Mooc:QuizzChapitre/quizz_chapitre_resultat.html.twig", array('score' => $score, 'quizz' => $quizzChapitre));
    }

    public function calculerScoreQuizzCoursAction() {

        $i = 1;
        $em = $this->getDoctrine()->getManager();
        $requete = $this->getRequest();
        $reponse = $this->get('session')->get('reponseExacte');
        $nombreReponseExacte = $this->nombreReponseExacte($reponse);
        $nombreQuestion = $requete->get('nombreQuestion');
        $nombreReponse = $requete->get('nombreReponse');
        $score = 0;
        $unite = 20 / $nombreReponseExacte;
        while ($i <= $nombreQuestion) {
            $j = 1;
            while ($j <= $nombreReponse) {
                if ($requete->get('checkbox' . $i . $j) == "vrai") {
                    $score = $score + $unite;
                } elseif ($requete->get('checkbox' . $i . $j) == "fausse") {
                    $score = $score - $unite;
                } else {
                    $score = $score;
                }
                $j = $j + 1;
            }
            $i = $i + 1;
        }
        $quizzCours = $this->get('session')->get('quizzCours');
        $scoreQuizzCours = $em->getRepository("EspritMoocBundle:ScoreQuizzCours")->findOneBy(array('idApprenantScoreQuizzCours' => $this->getUser(), 'idQuizzCoursScoreQuizzCours' => $quizzCours));
        $quizzCours2 = $em->getRepository("EspritMoocBundle:QuizzCours")->findOneByIdQuizzCours($quizzCours->getIdQuizzCours());
        if (!is_object($scoreQuizzCours)) {
            $newScoreQuizzCours = new ScoreQuizzCours();
            $newScoreQuizzCours->setIdQuizzCoursScoreQuizzCours($quizzCours2);
            $newScoreQuizzCours->setIdApprenantScoreQuizzCours($this->getUser());
            $newScoreQuizzCours->setScoreScoreQuizzCours($score);
            $newScoreQuizzCours->setTypeBadgeScoreQuizzCours("BAD");
            $em->persist($newScoreQuizzCours);
            $em->flush();
        } else {

            $score = $scoreQuizzCours->getScoreScoreQuizzCours();
            return $this->render("EspritMoocBundle:Mooc:QuizzCours/quizz_cours_resultat.html.twig", array('score' => $score, 'message' => "Il est interdit de repasser une epreuve", 'quizz' => $quizzCours));
        }
        return $this->render("EspritMoocBundle:Mooc:QuizzCours/quizz_cours_resultat.html.twig", array('score' => $score, 'quizz' => $quizzCours));
    }

    public function nombreReponseExacte($reponse) {
        $nombreReponse = 0;
        foreach ($reponse as $r) {
            if ($r->getEtatReponse() == "vrai") {
                $nombreReponse = $nombreReponse + 1;
            }
        }
        return $nombreReponse;
    }

    public function correctionQuizzCoursAction($idCours) {
        $quizz = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:QuizzCours")->findOneByidCoursQuizzCours($idCours);
        $question = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Question")->findByidQuizzCoursQuestion($quizz->getIdQuizzCours());
        $reponse = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Reponse")->findAll($question);
        return $this->render('EspritMoocBundle:Mooc:QuizzCours/quizz_cours_correction.html.twig', array('question' => $question, 'reponse' => $reponse, 'quizz' => $quizz));
    }

    public function correctionQuizzChapitreAction($idChapitre) {
        $quizzChapitre = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:QuizzChapitre")->findOneByIdChapitreQuizzEntrainement($idChapitre);
        $question = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Question")->findByIdQuizzEntrainementQuestion($quizzChapitre->getIdQuizzEntrainement());
        $reponse = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Reponse")->findAll($question);
        return $this->render('EspritMoocBundle:Mooc:QuizzChapitre/quizz_chapitre_correction.html.twig', array('question' => $question, 'reponse' => $reponse, 'quizz' => $quizzChapitre));
    }

    public function chercherCoursAction(Request $request) {
        $requete = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $titre = $requete->get('titre');
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findCours($titre);
        $topCours = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Cours")->findBy(array(), array('nombreVisite' => 'desc'), 5);
        $discipline = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Discipline")->findAll();
        $formateur = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:InformationFormateur")->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($cours, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 2/* limit per page */);
        return $this->render('EspritMoocBundle:Mooc:Cours/CoursesList.html.twig', array('pagination' => $pagination, 'disciplines' => $discipline, 'formateurs' => $formateur, 'topCours' => $topCours));
    }

    public function visiteCours(\Esprit\MoocBundle\Entity\Utilisateur $idApprenant, \Esprit\MoocBundle\Entity\Cours $idCours) {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $visite = $em->getRepository("EspritMoocBundle:Visite")->findOneBy(array('Apprenant' => $user, 'idCours' => $idCours));
        if (is_object($visite)) {
            $visite->setApprenant($user);
            $visite->setIdCours($idCours);
            $visite->setDateVisite(new \DateTime());
            $em->persist($visite);
            $em->flush();
        } else {
            $newVisite = new Visite();
            $newVisite->setApprenant($idApprenant);
            $newVisite->setIdCours($idCours);
            $newVisite->setDateVisite(new \DateTime());
            $em->persist($newVisite);
            $em->flush();
        }
    }

    public function viderHistoriqueAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $visites = $em->getRepository("EspritMoocBundle:Visite")->findBy(array('Apprenant' => $user));
        foreach ($visites as $visite) {
            $em->remove($visite);
        }
        $em->flush();
        return $this->redirectToRoute('afficher_historique');
    }

    public function likeCoursAction($idCours) {
        $aime = new Aime();
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($idCours);
        $cours->setNombreJaime($cours->getNombreJaime() + 1);
        $aime->setIdCoursAime($cours);
        $aime->setIdUtilisateurAime($this->getUser());
        $em->persist($aime);
        $em->persist($cours);
        $em->flush();
        return new JsonResponse(array('name' => "its done"));
    }

    public function suivieCoursAction($idCours) {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($idCours);
        $discipline = $em->getRepository("EspritMoocBundle:Discipline")->findOneByIdDiscipline($cours->getIdDisciplineCours());

        $suivieD = $em->getRepository("EspritMoocBundle:SuiviDiscipline")->findOneBy(array('idUtilisateurSuivi' => $this->getUser(), 'idDisciplineSuivi' => $discipline));

        //instanciation
        $suivie = new Suivie();



        $suivie->setDateSuivie(new \DateTime());
        $suivie->setIdCoursSuivie($cours);
        $suivie->setIdUtilisateurSuivie($this->getUser());
        $cours->setNombreParticipantsCours($cours->getNombreParticipantsCours() + 1);


        if (!is_object($suivieD)) {
            $suivieDiscipline = new SuiviDiscipline();
            $suivieDiscipline->setIdDisciplineSuivi($discipline);
            $suivieDiscipline->setIdUtilisateurSuivi($this->getUser());
            $suivieDiscipline->setDateSuiviDiscipline(new \DateTime());
            $em->persist($suivieDiscipline);
        }



        $em->persist($cours);
        $em->persist($suivie);
        $em->flush();
        return new JsonResponse(array('name' => "its done"));
    }

    public function supprimerSuivieAction($idCours) {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($idCours);
        $cours->setNombreParticipantsCours($cours->getNombreParticipantsCours() - 1);
        $suivie = $em->getRepository("EspritMoocBundle:Suivie")->findOneBy(array('idCoursSuivie' => $idCours, 'idUtilisateurSuivie' => $this->getUser()));
        $em->persist($cours);
        $em->remove($suivie);
        $em->flush();
        return new JsonResponse(array('name' => "its done"));
    }

    public function afficherCoursAction($idCours) {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($idCours);
        $chapitres = $em->getRepository("EspritMoocBundle:Chapitre")->findByIdCoursChapitre($cours);
        $quizzCours = $em->getRepository("EspritMoocBundle:QuizzCours")->findByIdCoursQuizzCours($cours);
        $quizzChapitre = $em->getRepository("EspritMoocBundle:QuizzChapitre")->findByIdChapitreQuizzEntrainement($chapitres);
        return $this->render("EspritMoocBundle:Mooc:Cours/AfficherCours.html.twig", array('cours' => $cours, 'chapitres' => $chapitres, 'quizzCours' => $quizzCours, 'quizzChapitre' => $quizzChapitre));
    }

    public function modifierCoursAction($idCours) {
        $requet = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($idCours);

        if ($requet->getMethod() === "POST") {
            $cours->setTitreCours($requet->get('titreCours'));
            $cours->setDureeCours($requet->get('dureeCours'));
            $cours->setNiveauCours($requet->get('niveauCours'));
            $cours->setIdDisciplineCours($em->getRepository("EspritMoocBundle:Discipline")->findOneByIdDiscipline($requet->get('disciplineCours')));
            if (!is_null($this->getRequest()->files->get('file'))) {
                $date = new \DateTime();
                $result = $date->format('YmdHis');
                $filename = $result . $this->getUser()->getId() . $this->getRequest()->files->get('file')->getClientOriginalName();
                $directory = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/video/';
                $this->getRequest()->files->get('file')->move($directory, $filename);
                $cours->setVideoCours($filename);
            }
            $cours->setIntroductionCours($requet->get('introductionCours'));
            $cours->setDescriptionCours($requet->get('descriptionCours'));
            $cours->setPrerequisCours($requet->get('prerequisCours'));
            $cours->setObjectifCours($requet->get('objectifCours'));
            $em->persist($cours);
            $em->flush();

            return $this->redirectToRoute('mes_cours', array('notice' => 'success'));
        }
        return $this->redirectToRoute('mes_cours');
    }

    public function modifierChapitreAction($idChapitre) {
        $requet = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $chapitre = $em->getRepository("EspritMoocBundle:Chapitre")->findOneByIdChapitre($idChapitre);
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findBy(array('idFormateurCours' => $this->getUser()));

        if ($requet->getMethod() === "POST") {
            
        }
        return $this->render("EspritMoocBundle:Mooc:Chapitre/AfficherChapitre.html.twig", array('chapitre' => $chapitre, 'cours' => $cours));
    }

    public function modifierQuizzChapitreAction($idChapitre) {
        $quizzChapitre = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:QuizzChapitre")->findOneByIdChapitreQuizzEntrainement($idChapitre);
        $question = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Question")->findByIdQuizzEntrainementQuestion($quizzChapitre->getIdQuizzEntrainement());
        $reponse = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Reponse")->findAll($question);
        $etatQuizz = $this->validationQuizzChapitre($quizzChapitre->getIdQuizzEntrainement());


        return $this->render('EspritMoocBundle:Mooc:QuizzChapitre/ModifierQuizzChapitre.html.twig', array('questions' => $question, 'reponses' => $reponse, 'quizz' => $quizzChapitre, 'etatQuizz' => $etatQuizz));
    }

    public function modifierQuizzCoursAction($idCours) {

        $quizzCours = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:QuizzCours")->findOneByIdCoursQuizzCours($idCours);

        $question = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Question")->findByIdQuizzCoursQuestion($quizzCours->getIdQuizzCours());
        $reponse = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Reponse")->findAll($question);
        $etatQuizz = $this->validationQuizzCours($quizzCours->getIdQuizzCours());

        return $this->render('EspritMoocBundle:Mooc:QuizzCours/ModifierQuizzCours.html.twig', array('questions' => $question, 'reponses' => $reponse, 'quizz' => $quizzCours, 'etatQuizz' => $etatQuizz));
    }

    public function validationQuizzChapitre($idQuizzChapitre) {
        $acceptation = 'quizzValide';
        $em = $this->getDoctrine()->getManager();
        $reponses = $em->getRepository("EspritMoocBundle:Reponse");
        $quizzCours = $em->getRepository("EspritMoocBundle:QuizzChapitre")->findOneByIdQuizzEntrainement($idQuizzChapitre);
        $question = $em->getRepository("EspritMoocBundle:Question")->findBy(array('idQuizzEntrainementQuestion' => $quizzCours));
        $reponse = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Reponse")->findByIdQuestionReponse($question);
        $reponseExacte = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Reponse")->findBy(array('idQuestionReponse' => $question, 'etatReponse' => 'vrai'));
        foreach ($question as $q) {
            $r = $reponses->findBy(array('idQuestionReponse' => $q->getIdQuestion()));

            if (count($r) < 2) {
                return $acceptation = 'questionNonValide';
            }
        }
        if ((count($question) == 0)) {
            return $acceptation = 'aucuneQuestion';
        }
        if ((count($reponse) == 0)) {
            return $acceptation = 'aucuneRepone';
        }
        if ((count($reponseExacte) == 0)) {
            return $acceptation = 'aucuneReponseExacte';
        }

        return $acceptation;
    }

    public function validationQuizzCours($idQuizzCours) {
        $acceptation = 'quizzValide';
        $em = $this->getDoctrine()->getManager();
        $reponses = $em->getRepository("EspritMoocBundle:Reponse");
        $quizzCours = $em->getRepository("EspritMoocBundle:QuizzCours")->findOneByIdQuizzCours($idQuizzCours);
        $question = $em->getRepository("EspritMoocBundle:Question")->findBy(array('idQuizzCoursQuestion' => $quizzCours));
        $reponse = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Reponse")->findByIdQuestionReponse($question);
        $reponseExacte = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Reponse")->findBy(array('idQuestionReponse' => $question, 'etatReponse' => 'vrai'));
        foreach ($question as $q) {
            $r = $reponses->findBy(array('idQuestionReponse' => $q->getIdQuestion()));

            if (count($r) < 2) {
                return $acceptation = 'questionNonValide';
            }
        }
        if ((count($question) == 0)) {
            return $acceptation = 'aucuneQuestion';
        }
        if ((count($reponse) == 0)) {
            return $acceptation = 'aucuneRepone';
        }
        if ((count($reponseExacte) == 0)) {
            return $acceptation = 'aucuneReponseExacte';
        }

        return $acceptation;
    }

    public function progressionUtilisateur($idChapitre) {
        $em = $this->getDoctrine()->getManager();
        $progression = new Progression();
        $chapitre = $em->getRepository("EspritMoocBundle:Chapitre")->findOneByIdChapitre($idChapitre);
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($chapitre->getIdCoursChapitre());
        $progression->setDateProgression(new \DateTime());
        $progression->setIdChapitreProgression($chapitre);
        $progression->setIdCoursProgression($cours);
        $progression->setTypeProgression('chapitre');
        $progression->setIdUtilisateurProgression($this->getUser());


        $suivi = $em->getRepository("EspritMoocBundle:Suivie")->findOneBy(array('idCoursSuivie' => $cours, 'idUtilisateurSuivie' => $this->getUser()));
        if (!is_object($suivi)) {
            $this->suivieCoursAction($cours->getIdCours());
        }


        $oldPregression = $em->getRepository("EspritMoocBundle:Progression")->findOneBy(array('idCoursProgression' => $cours, 'typeProgression' => 'cours', 'etatProgression' => 'en cours'));
        if (!is_object($oldPregression)) {
            $progression2 = new Progression();
            $progression2->setDateProgression(new \DateTime());
            $progression2->setIdCoursProgression($cours);
            $progression2->setTypeProgression('cours');
            $progression2->setEtatProgression('en cours');
            $progression2->setIdUtilisateurProgression($this->getUser());
            $em->persist($progression2);
        }

        $em->persist($progression);
        $em->flush();
    }

    public function progressionUtilisateurCours($idCours) {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($idCours);
        $progression = $em->getRepository("EspritMoocBundle:Progression")
                ->findOneBy(array('idUtilisateurProgression' => $this->getUser(), 'idCoursProgression' => $cours, 'typeProgression' => 'cours'));
        $progression->setEtatProgression('terminer');
        $em->persist($progression);
        $em->flush();
    }

    public function validerProgressionCours($idCours) {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository("EspritMoocBundle:Cours")->findOneByIdCours($idCours);
        $chapitre = $em->getRepository("EspritMoocBundle:Chapitre")->findByIdCoursChapitre($cours);

        $validation = 'TRUE';
        foreach ($chapitre as $c) {
            $progression = $em->getRepository("EspritMoocBundle:Progression")
                    ->findOneBy(array('idUtilisateurProgression' => $this->getUser(), 'idCoursProgression' => $cours, 'idChapitreProgression' => $c));
            if (!is_object($progression)) {
                $validation = 'FALSE';
            }
        }
        return $validation;
    }

}
