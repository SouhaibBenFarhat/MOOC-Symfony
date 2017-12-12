<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * ScoreQuizzChapitre
 *
 * @ORM\Table(name="score_quizz_chapitre")
 * @ORM\Entity
 *
 */
class ScoreQuizzChapitre {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_score_quizz_chapitre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idScoreQuizzChapitre;

    /**
     * @var integer
     *
     * @ORM\Column(name="score_quizz_chapitre", type="integer", nullable=false)
     */
    private $scoreQuizzChapitre;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="type_badge_score_quizz_chapitre", type="string", length=50, nullable=false)
     */
    private $typeBadgeScoreQuizzChapitre;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_apprenant_score_quizz_chapitre", referencedColumnName="id")
     * })
     */
    private $idApprenantScoreQuizzChapitre;

    /**
     * @var \QuizzChapitre
     *
     * @ORM\ManyToOne(targetEntity="QuizzChapitre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quizz_chapitre_score_quizz_chapitre", referencedColumnName="id_quizz_entrainement")
     * })
     */
    private $idQuizzChapitreScoreQuizzChapitre;

    
    function getIdScoreQuizzChapitre() {
        return $this->idScoreQuizzChapitre;
    }

    function getScoreQuizzChapitre() {
        return $this->scoreQuizzChapitre;
    }

    function getDate() {
        return $this->date;
    }

    function getTypeBadgeScoreQuizzChapitre() {
        return $this->typeBadgeScoreQuizzChapitre;
    }

    function getIdApprenantScoreQuizzChapitre() {
        return $this->idApprenantScoreQuizzChapitre;
    }

    function getIdQuizzChapitreScoreQuizzChapitre() {
        return $this->idQuizzChapitreScoreQuizzChapitre;
    }

    function setIdScoreQuizzChapitre($idScoreQuizzChapitre) {
        $this->idScoreQuizzChapitre = $idScoreQuizzChapitre;
    }

    function setScoreQuizzChapitre($scoreQuizzChapitre) {
        $this->scoreQuizzChapitre = $scoreQuizzChapitre;
    }

    function setDate(\DateTime $date) {
        $this->date = $date;
    }

    function setTypeBadgeScoreQuizzChapitre($typeBadgeScoreQuizzChapitre) {
        $this->typeBadgeScoreQuizzChapitre = $typeBadgeScoreQuizzChapitre;
    }

    function setIdApprenantScoreQuizzChapitre(\Esprit\MoocBundle\Entity\Utilisateur $idApprenantScoreQuizzChapitre) {
        $this->idApprenantScoreQuizzChapitre = $idApprenantScoreQuizzChapitre;
    }

    function setIdQuizzChapitreScoreQuizzChapitre(\Esprit\MoocBundle\Entity\QuizzChapitre $idQuizzChapitreScoreQuizzChapitre) {
        $this->idQuizzChapitreScoreQuizzChapitre = $idQuizzChapitreScoreQuizzChapitre;
    }




}
