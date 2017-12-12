<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question", indexes={@ORM\Index(name="IDX_B6F7494E4FF5D76F", columns={"id_quizz_final_question"}), @ORM\Index(name="IDX_B6F7494E45E7DB66", columns={"id_quizz_entrainement_question"}), @ORM\Index(name="IDX_B6F7494EF7885782", columns={"id_quizz_cours_question"}), @ORM\Index(name="id_quizz_entrainement_question", columns={"id_quizz_entrainement_question", "id_quizz_cours_question", "id_quizz_final_question"})})
 * @ORM\Entity
 */
class Question {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_question", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idQuestion;

    /**
     * @var string
     *
     * @ORM\Column(name="texte_question", type="string", length=300, nullable=false)
     */
    private $texteQuestion;

    /**
     * @var \QuizzCours
     *
     * @ORM\ManyToOne(targetEntity="QuizzCours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quizz_cours_question", referencedColumnName="id_quizz_cours")
     * })
     */
    private $idQuizzCoursQuestion;

    /**
     * @var \QuizzChapitre
     *
     * @ORM\ManyToOne(targetEntity="QuizzChapitre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quizz_entrainement_question", referencedColumnName="id_quizz_entrainement")
     * })
     */
    private $idQuizzEntrainementQuestion;

    /**
     * @var \QuizzFinal
     *
     * @ORM\ManyToOne(targetEntity="QuizzFinal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quizz_final_question", referencedColumnName="id_quizz_final")
     * })
     */
    private $idQuizzFinalQuestion;

    /**
     *
     * @ORM\Column(name="explication_question", type="string", length=800)
     * 
     */
    private $explication;

    /**
     * Get idQuestion
     *
     * @return integer 
     */
    public function getIdQuestion() {
        return $this->idQuestion;
    }

    /**
     * Set texteQuestion
     *
     * @param string $texteQuestion
     * @return Question
     */
    public function setTexteQuestion($texteQuestion) {
        $this->texteQuestion = $texteQuestion;

        return $this;
    }

    /**
     * Get texteQuestion
     *
     * @return string 
     */
    public function getTexteQuestion() {
        return $this->texteQuestion;
    }

    /**
     * Set idQuizzCoursQuestion
     *
     * @param \Esprit\MoocBundle\Entity\QuizzCours $idQuizzCoursQuestion
     * @return Question
     */
    public function setIdQuizzCoursQuestion(\Esprit\MoocBundle\Entity\QuizzCours $idQuizzCoursQuestion = null) {
        $this->idQuizzCoursQuestion = $idQuizzCoursQuestion;

        return $this;
    }

    /**
     * Get idQuizzCoursQuestion
     *
     * @return \Esprit\MoocBundle\Entity\QuizzCours 
     */
    public function getIdQuizzCoursQuestion() {
        return $this->idQuizzCoursQuestion;
    }

    /**
     * Set idQuizzEntrainementQuestion
     *
     * @param \Esprit\MoocBundle\Entity\QuizzChapitre $idQuizzEntrainementQuestion
     * @return Question
     */
    public function setIdQuizzEntrainementQuestion(\Esprit\MoocBundle\Entity\QuizzChapitre $idQuizzEntrainementQuestion = null) {
        $this->idQuizzEntrainementQuestion = $idQuizzEntrainementQuestion;

        return $this;
    }

    /**
     * Get idQuizzEntrainementQuestion
     *
     * @return \Esprit\MoocBundle\Entity\QuizzChapitre 
     */
    public function getIdQuizzEntrainementQuestion() {
        return $this->idQuizzEntrainementQuestion;
    }

    /**
     * Set idQuizzFinalQuestion
     *
     * @param \Esprit\MoocBundle\Entity\QuizzFinal $idQuizzFinalQuestion
     * @return Question
     */
    public function setIdQuizzFinalQuestion(\Esprit\MoocBundle\Entity\QuizzFinal $idQuizzFinalQuestion = null) {
        $this->idQuizzFinalQuestion = $idQuizzFinalQuestion;

        return $this;
    }

    /**
     * Get idQuizzFinalQuestion
     *
     * @return \Esprit\MoocBundle\Entity\QuizzFinal 
     */
    public function getIdQuizzFinalQuestion() {
        return $this->idQuizzFinalQuestion;
    }

    function getExplication() {
        return $this->explication;
    }

    function setExplication($explication) {
        $this->explication = $explication;
    }

}
