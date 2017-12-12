<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuizzCours
 *
 * @ORM\Table(name="quizz_cours")
 * @ORM\Entity
 */
class QuizzCours {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_quizz_cours", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idQuizzCours;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_quizz_cours", type="string", length=40, nullable=false)
     */
    private $titreQuizzCours;

    /**
     * @var string
     *
     * @ORM\Column(name="description_quizz_cours", type="string", length=400, nullable=false)
     */
    private $descriptionQuizzCours;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau_quizz_entrainement", type="string", length=20, nullable=true)
     */
    private $niveauQuizzCours;

    /**
     * @var \Cours
     *
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours_quizz_cours", referencedColumnName="id_cours")
     * })
     */
    private $idCoursQuizzCours;

    /**
     *
     * @ORM\Column(name="duree_quizz_cours", type="integer")
     */
    private $duree;

    /**
     * Get idQuizzCours
     *
     * @return integer 
     */
    public function getIdQuizzCours() {
        return $this->idQuizzCours;
    }

    /**
     * Set titreQuizzCours
     *
     * @param string $titreQuizzCours
     * @return QuizzCours
     */
    public function setTitreQuizzCours($titreQuizzCours) {
        $this->titreQuizzCours = $titreQuizzCours;

        return $this;
    }

    /**
     * Get titreQuizzCours
     *
     * @return string 
     */
    public function getTitreQuizzCours() {
        return $this->titreQuizzCours;
    }

    /**
     * Set idCoursQuizzCours
     *
     * @param \Esprit\MoocBundle\Entity\Cours $idCoursQuizzCours
     * @return QuizzCours
     */
    public function setIdCoursQuizzCours(\Esprit\MoocBundle\Entity\Cours $idCoursQuizzCours = null) {
        $this->idCoursQuizzCours = $idCoursQuizzCours;

        return $this;
    }

    /**
     * Get idCoursQuizzCours
     *
     * @return \Esprit\MoocBundle\Entity\Cours 
     */
    public function getIdCoursQuizzCours() {
        return $this->idCoursQuizzCours;
    }
//
//    public function __toString() {
//        return $this->getTitreQuizzCours();
//    }

    function getDescriptionQuizzCours() {
        return $this->descriptionQuizzCours;
    }

    function setDescriptionQuizzCours($descriptionQuizzCours) {
        $this->descriptionQuizzCours = $descriptionQuizzCours;
    }

    function getDuree() {
        return $this->duree;
    }

    function setDuree($duree) {
        $this->duree = $duree;
    }

    function getNiveauQuizzCours() {
        return $this->niveauQuizzCours;
    }

    function setNiveauQuizzCours($niveauQuizzCours) {
        $this->niveauQuizzCours = $niveauQuizzCours;
    }

}
