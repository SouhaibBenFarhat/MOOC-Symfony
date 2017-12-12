<?php

namespace Esprit\MoocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Esprit\MoocBundle\Entity\ScoreQuizzFinal;
use Esprit\MoocBundle\Entity\ScoreQuizzCours;
use Esprit\MoocBundle\Entity\QuizzChapitre;
use Esprit\MoocBundle\Entity\Question;
use Esprit\MoocBundle\Entity\Reponse;
use Esprit\MoocBundle\Entity\QuizzCours;
use Esprit\MoocBundle\Form\informationEntrepriseType;
use Esprit\MoocBundle\Repository\CoursRepository;
use Esprit\MoocBundle\Entity\Visite;
use Esprit\MoocBundle\Entity\Aime;
use Esprit\MoocBundle\Controller\CoursController;
use Esprit\MoocBundle\Entity\Suivie;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of QuizController
 *
 * @author souhaib
 */
class QuizzController extends Controller {

    public function modifierQuestionChapitreAction($idQuestion) {
        $em = $this->getDoctrine()->getManager();
        $requete = $this->getRequest();
        $question = $em->getRepository("EspritMoocBundle:Question")->findOneByIdQuestion($idQuestion);
        if ($requete->getMethod() === "POST") {
            $question->setTexteQuestion($requete->get('texteQuestion'));
            $question->setExplication($requete->get('explication'));
            $em->persist($question);
            $em->flush();
            return $this->redirectToRoute('modifier_quizz_chapitre', array('notice' => 'success', 'idChapitre' => $question->getIdQuizzEntrainementQuestion()->getIdChapitreQuizzEntrainement()->getIdChapitre()));
        }
        return $this->redirectToRoute('modifier_quizz_chapitre', array('idChapitre' => $question->getIdQuizzEntrainementQuestion()->getIdChapitreQuizzEntrainement()->getIdChapitre()));
    }

    public function modifierQuestionCoursAction($idQuestion) {
        $em = $this->getDoctrine()->getManager();
        $requete = $this->getRequest();
        $question = $em->getRepository("EspritMoocBundle:Question")->findOneByIdQuestion($idQuestion);

        if ($requete->getMethod() === "POST") {
            $question->setTexteQuestion($requete->get('texteQuestion'));
            $question->setExplication($requete->get('explication'));
            $em->persist($question);
            $em->flush();
            return $this->redirectToRoute('modifier_quizz_cours', array('notice' => 'success', 'idCours' => $question->getIdQuizzCoursQuestion()->getIdCoursQuizzCours()->getIdCours()));
        }
        return $this->redirectToRoute('modifier_quizz_cours', array('idCours' => $question->getIdQuizzCoursQuestion()->getIdCoursQuizzCours()->getIdCours()));
    }

    public function modifierReponseCoursAction($idReponse) {
        $em = $this->getDoctrine()->getManager();
        $requete = $this->getRequest();
        $reponse = $em->getRepository("EspritMoocBundle:Reponse")->findOneByIdReponse($idReponse);
        if ($requete->getMethod() === "POST") {

            $reponse->setTexteReponse($requete->get('texteReponse'));
            $reponse->setEtatReponse($requete->get('etatReponse'));
            $em->persist($reponse);
            $em->flush();
            return $this->redirectToRoute('modifier_quizz_cours', array('notice' => 'success', 'idCours' => $reponse->getIdQuestionReponse()->getIdQuizzCoursQuestion()->getIdCoursQuizzCours()->getIdCours()));
        }
        return $this->redirectToRoute('modifier_quizz_cours', array('idCours' => $reponse->getIdQuestionReponse()->getIdQuizzCoursQuestion()->getIdCoursQuizzCours()->getIdCours()));
    }

    public function modifierReponseChapitreAction($idReponse) {
        $em = $this->getDoctrine()->getManager();
        $requete = $this->getRequest();
        $reponse = $em->getRepository("EspritMoocBundle:Reponse")->findOneByIdReponse($idReponse);
        if ($requete->getMethod() === "POST") {

            $reponse->setTexteReponse($requete->get('texteReponse'));
            $reponse->setEtatReponse($requete->get('etatReponse'));
            $em->persist($reponse);
            $em->flush();
            return $this->redirectToRoute('modifier_quizz_chapitre', array('notice' => 'success', 'idChapitre' => $reponse->getIdQuestionReponse()->getIdQuizzEntrainementQuestion()->getIdChapitreQuizzEntrainement()->getIdChapitre()));
        }
        return $this->redirectToRoute('modifier_quizz_chapitre', array('idChapitre' => $reponse->getIdQuestionReponse()->getIdQuizzEntrainementQuestion()->getIdChapitreQuizzEntrainement()->getIdChapitre()));
    }

    public function supprimerQuestionChapitreAction($idQuestion) {
        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository("EspritMoocBundle:Question")->findOneByIdQuestion($idQuestion);
        $idChapitre = $question->getIdQuizzEntrainementQuestion()->getIdChapitreQuizzEntrainement()->getIdChapitre();
        $em->remove($question);
        $em->flush();
        return $this->redirectToRoute('modifier_quizz_chapitre', array('notice' => 'success', 'idChapitre' => $idChapitre));
    }

    public function supprimerQuestionCoursAction($idQuestion) {
        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository("EspritMoocBundle:Question")->findOneByIdQuestion($idQuestion);
        $idCours = $question->getIdQuizzCoursQuestion()->getIdCoursQuizzCours()->getidCours();
//        die('---' . $idCours);
        $em->remove($question);
        $em->flush();
        return $this->redirectToRoute('modifier_quizz_cours', array('notice' => 'success', 'idCours' => $idCours));
    }

    public function supprimerReponseCoursAction($idReponse) {

        $em = $this->getDoctrine()->getManager();
        $reponse = $em->getRepository("EspritMoocBundle:Reponse")->findOneByIdReponse($idReponse);
        $idCours = $reponse->getIdQuestionReponse()->getIdQuizzCoursQuestion()->getIdCoursQuizzCours()->getIdCours();
        $em->remove($reponse);
        $em->flush();
        return $this->redirectToRoute('modifier_quizz_cours', array('notice' => 'success', 'idCours' => $idCours));
    }

    public function supprimerReponseChapitreAction($idReponse) {
        $em = $this->getDoctrine()->getManager();
        $reponse = $em->getRepository("EspritMoocBundle:Reponse")->findOneByIdReponse($idReponse);
        $idChapitre = $reponse->getIdQuestionReponse()->getIdQuizzEntrainementQuestion()->getIdChapitreQuizzEntrainement()->getIdChapitre();
        $em->remove($reponse);
        $em->flush();
        return $this->redirectToRoute('modifier_quizz_chapitre', array('notice' => 'success', 'idChapitre' => $idChapitre));
    }

    public function modifierDonneeQuizzCoursAction($idQuizzCours) {
        $em = $this->getDoctrine()->getManager();
        $requete = $this->getRequest();
        $quizzCours = $em->getRepository("EspritMoocBundle:QuizzCours")->findOneByIdQuizzCours($idQuizzCours);
        if ($requete->getMethod() === "POST") {
            $quizzCours->setDuree($requete->get('dureeQuizz'));
            $quizzCours->setDescriptionQuizzCours($requete->get('description'));
            $quizzCours->setTitreQuizzCours($requete->get('titreQuizzCours'));
            $em->persist($quizzCours);
            $em->flush();
            return $this->redirectToRoute('mes_cours');
        }
        return $this->redirectToRoute('mes_cours');
    }

    public function modifierDonneeQuizzChapitreAction($idQuizzChapitre) {
        $em = $this->getDoctrine()->getManager();
        $requete = $this->getRequest();
        $quizzChapitre = $em->getRepository("EspritMoocBundle:QuizzChapitre")->findOneByIdQuizzEntrainement($idQuizzChapitre);
        if ($requete->getMethod() === "POST") {
            $quizzChapitre->setDescriptionQuizz($requete->get('description'));
            $quizzChapitre->setTitreQuizzEntrainement($requete->get('titreQuizzChapitre'));
            $em->persist($quizzChapitre);
            $em->flush();
            return $this->redirectToRoute('mes_cours', array('notice' => 'success'));
        }
        return $this->redirectToRoute('mes_cours');
    }

    public function ajouterQuestionChapitreAction($idQuizzChapitre) {
        $requete = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $quizzChapitre = $em->getRepository("EspritMoocBundle:QuizzChapitre")->findOneByIdQuizzEntrainement($idQuizzChapitre);
        $questionChapitre = new Question();
        $questionChapitre->setExplication($requete->get('explicationQuestion'));
        $questionChapitre->setTexteQuestion($requete->get('texteQuestion'));
        $questionChapitre->setIdQuizzEntrainementQuestion($quizzChapitre);
        $em->persist($questionChapitre);
        $em->flush();
        return $this->redirectToRoute('modifier_quizz_chapitre', array('notice' => 'success', 'idChapitre' => $quizzChapitre->getIdChapitreQuizzEntrainement()->getIdChapitre()));
    }

    public function ajouterReponseAction($idQuestion) {

        $em = $this->getDoctrine()->getManager();
        $requete = $this->getRequest();
        $question = $em->getRepository("EspritMoocBundle:Question")->findOneByIdQuestion($idQuestion);
        $reponse = new Reponse();
        $reponse->setEtatReponse($requete->get('etatReponse'));
        $reponse->setIdQuestionReponse($question);
        $reponse->setTexteReponse($requete->get('texteReponse'));
        $em->persist($reponse);
        $em->flush();
        if (is_null($question->getIdQuizzEntrainementQuestion())) {
            return $this->redirectToRoute('modifier_quizz_cours', array('notice' => 'success', 'idCours' => $question->getIdQuizzCoursQuestion()->getIdCoursQuizzCours()->getIdCours()));
        } else {
            return $this->redirectToRoute('modifier_quizz_chapitre', array('notice' => 'success', 'idChapitre' => $question->getIdQuizzEntrainementQuestion()->getIdChapitreQuizzEntrainement()->getIdChapitre()));
        }
    }

    public function ajouterQuestionCoursAction($idQuizzCours) {
        $requete = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $quizzCours = $em->getRepository("EspritMoocBundle:QuizzCours")->findOneByIdQuizzCours($idQuizzCours);
        $questionCours = new Question();
        $questionCours->setExplication($requete->get('explicationQuestion'));
        $questionCours->setTexteQuestion($requete->get('texteQuestion'));
        $questionCours->setIdQuizzCoursQuestion($quizzCours);
        $em->persist($questionCours);
        $em->flush();
        return $this->redirectToRoute('modifier_quizz_cours', array('notice' => 'success', 'idCours' => $quizzCours->getIdCoursQuizzCours()->getIdCours()));
    }

    public function supprimerQuizzCoursAction($idQuizzCours) {
        $em = $this->getDoctrine()->getManager();
        $quizzCours = $em->getRepository("EspritMoocBundle:QuizzCours")->findOneByIdQuizzCours($idQuizzCours);
        $em->remove($quizzCours);
        $em->flush();
        return $this->redirectToRoute('mes_cours');
    }

    public function supprimerQuizzChapitreAction($idQuizzChapitre) {
        $em = $this->getDoctrine()->getManager();
        $quizzChapitre = $em->getRepository("EspritMoocBundle:QuizzChapitre")->findOneByIdQuizzEntrainement($idQuizzChapitre);
        $em->remove($quizzChapitre);
        $em->flush();
        return $this->redirectToRoute('mes_cours');
    }
    

}
