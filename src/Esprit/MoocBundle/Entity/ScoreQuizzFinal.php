<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScoreQuizzFinal
 *
 * @ORM\Table(name="score_quizz_final", indexes={@ORM\Index(name="IDX_D367E74DD9E58E96", columns={"id_quizz_final_score_quizz_final"}), @ORM\Index(name="IDX_D367E74DFF745EA7", columns={"id_apprenant_score_quizz_final"}), @ORM\Index(name="id_apprenant_score_quizz_final", columns={"id_apprenant_score_quizz_final", "id_quizz_final_score_quizz_final"})})
 * @ORM\Entity
 */
class ScoreQuizzFinal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_score_quizz", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idScoreQuizz;

    /**
     * @var integer
     *
     * @ORM\Column(name="score_score_quizz", type="integer", nullable=false)
     */
    private $scoreScoreQuizz;

    /**
     * @var string
     *
     * @ORM\Column(name="type_badge_score_quizz", type="string", length=50, nullable=false)
     */
    private $typeBadgeScoreQuizz;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_apprenant_score_quizz_final", referencedColumnName="id")
     * })
     */
    private $idApprenantScoreQuizzFinal;

    /**
     * @var \QuizzFinal
     *
     * @ORM\ManyToOne(targetEntity="QuizzFinal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quizz_final_score_quizz_final", referencedColumnName="id_quizz_final")
     * })
     */
    private $idQuizzFinalScoreQuizzFinal;



    /**
     * Get idScoreQuizz
     *
     * @return integer 
     */
    public function getIdScoreQuizz()
    {
        return $this->idScoreQuizz;
    }

    /**
     * Set scoreScoreQuizz
     *
     * @param integer $scoreScoreQuizz
     * @return ScoreQuizzFinal
     */
    public function setScoreScoreQuizz($scoreScoreQuizz)
    {
        $this->scoreScoreQuizz = $scoreScoreQuizz;

        return $this;
    }

    /**
     * Get scoreScoreQuizz
     *
     * @return integer 
     */
    public function getScoreScoreQuizz()
    {
        return $this->scoreScoreQuizz;
    }

    /**
     * Set typeBadgeScoreQuizz
     *
     * @param string $typeBadgeScoreQuizz
     * @return ScoreQuizzFinal
     */
    public function setTypeBadgeScoreQuizz($typeBadgeScoreQuizz)
    {
        $this->typeBadgeScoreQuizz = $typeBadgeScoreQuizz;

        return $this;
    }

    /**
     * Get typeBadgeScoreQuizz
     *
     * @return string 
     */
    public function getTypeBadgeScoreQuizz()
    {
        return $this->typeBadgeScoreQuizz;
    }

    /**
     * Set idApprenantScoreQuizzFinal
     *
     * @param \Esprit\MoocBundle\Entity\Utilisateur $idApprenantScoreQuizzFinal
     * @return ScoreQuizzFinal
     */
    public function setIdApprenantScoreQuizzFinal(\Esprit\MoocBundle\Entity\Utilisateur $idApprenantScoreQuizzFinal = null)
    {
        $this->idApprenantScoreQuizzFinal = $idApprenantScoreQuizzFinal;

        return $this;
    }

    /**
     * Get idApprenantScoreQuizzFinal
     *
     * @return \Esprit\MoocBundle\Entity\Utilisateur 
     */
    public function getIdApprenantScoreQuizzFinal()
    {
        return $this->idApprenantScoreQuizzFinal;
    }

    /**
     * Set idQuizzFinalScoreQuizzFinal
     *
     * @param \Esprit\MoocBundle\Entity\QuizzFinal $idQuizzFinalScoreQuizzFinal
     * @return ScoreQuizzFinal
     */
    public function setIdQuizzFinalScoreQuizzFinal(\Esprit\MoocBundle\Entity\QuizzFinal $idQuizzFinalScoreQuizzFinal = null)
    {
        $this->idQuizzFinalScoreQuizzFinal = $idQuizzFinalScoreQuizzFinal;

        return $this;
    }

    /**
     * Get idQuizzFinalScoreQuizzFinal
     *
     * @return \Esprit\MoocBundle\Entity\QuizzFinal 
     */
    public function getIdQuizzFinalScoreQuizzFinal()
    {
        return $this->idQuizzFinalScoreQuizzFinal;
    }
}
