<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ScoreQuizzCours
 *
 * @ORM\Table(name="score_quizz_cours",uniqueConstraints={@ORM\UniqueConstraint(name="score_quizz_cours", columns={"id_apprenant_score_quizz_cours", "id_quizz_cours_score_quizz_cours"})})
 * @ORM\Entity
 * @UniqueEntity(fields={"id_apprenant_score_quizz_cours","id_quizz_cours_score_quizz_cours"}, message="Vous Avez Déja passer cette Epreuve")
 */
class ScoreQuizzCours {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_score_quizz_cours", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idScoreQuizzCours;

    /**
     * @var integer
     *
     * @ORM\Column(name="score_score_quizz_cours", type="integer", nullable=false)
     */
    private $scoreScoreQuizzCours;

    /**
     * @var string
     *
     * @ORM\Column(name="type_badge_score_quizz_cours", type="string", length=50, nullable=false)
     */
    private $typeBadgeScoreQuizzCours;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_apprenant_score_quizz_cours", referencedColumnName="id")
     * })
     */
    private $idApprenantScoreQuizzCours;

    /**
     * @var \QuizzCours
     *
     * @ORM\ManyToOne(targetEntity="QuizzCours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quizz_cours_score_quizz_cours", referencedColumnName="id_quizz_cours")
     * })
     */
    private $idQuizzCoursScoreQuizzCours;

    function getIdScoreQuizzCours() {
        return $this->idScoreQuizzCours;
    }

    function getScoreScoreQuizzCours() {
        return $this->scoreScoreQuizzCours;
    }

    function getTypeBadgeScoreQuizzCours() {
        return $this->typeBadgeScoreQuizzCours;
    }

    function getIdApprenantScoreQuizzCours() {
        return $this->idApprenantScoreQuizzCours;
    }

    function getIdQuizzCoursScoreQuizzCours() {
        return $this->idQuizzCoursScoreQuizzCours;
    }

    function setIdScoreQuizzCours($idScoreQuizzCours) {
        $this->idScoreQuizzCours = $idScoreQuizzCours;
    }

    function setScoreScoreQuizzCours($scoreScoreQuizzCours) {
        $this->scoreScoreQuizzCours = $scoreScoreQuizzCours;
    }

    function setTypeBadgeScoreQuizzCours($typeBadgeScoreQuizzCours) {
        $this->typeBadgeScoreQuizzCours = $typeBadgeScoreQuizzCours;
    }

    function setIdApprenantScoreQuizzCours(\Esprit\MoocBundle\Entity\Utilisateur $idApprenantScoreQuizzCours) {
        $this->idApprenantScoreQuizzCours = $idApprenantScoreQuizzCours;
    }

    function setIdQuizzCoursScoreQuizzCours(\Esprit\MoocBundle\Entity\QuizzCours $idQuizzCoursScoreQuizzCours) {
        $this->idQuizzCoursScoreQuizzCours = $idQuizzCoursScoreQuizzCours;
    }

}
