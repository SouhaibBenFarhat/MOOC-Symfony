<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuizzChapitre
 *
 * @ORM\Table(name="quizz_chapitre", indexes={@ORM\Index(name="IDX_DB64C37CDD977F0", columns={"id_chapitre_quizz_entrainement"})})
 * @ORM\Entity
 */
class QuizzChapitre {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_quizz_entrainement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idQuizzEntrainement;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_quizz_entrainement", type="string", length=20, nullable=false)
     */
    private $titreQuizzEntrainement;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau_quizz_entrainement", type="string", length=20, nullable=true)
     */
    private $niveauQuizzEntrainement;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_creation", type="datetime",  nullable=true)
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="description_quizz_entrainement", type="text",  nullable=false)
     */
    private $descriptionQuizz;

    /**
     * @var \Chapitre
     *
     * @ORM\ManyToOne(targetEntity="Chapitre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_chapitre_quizz_entrainement", referencedColumnName="id_chapitre")
     * })
     */
    private $idChapitreQuizzEntrainement;

    /**
     * Get idQuizzEntrainement
     *
     * @return integer 
     */
    public function getIdQuizzEntrainement() {
        return $this->idQuizzEntrainement;
    }

    /**
     * Set titreQuizzEntrainement
     *
     * @param string $titreQuizzEntrainement
     * @return QuizzChapitre
     */
    public function setTitreQuizzEntrainement($titreQuizzEntrainement) {
        $this->titreQuizzEntrainement = $titreQuizzEntrainement;

        return $this;
    }

    /**
     * Get titreQuizzEntrainement
     *
     * @return string 
     */
    public function getTitreQuizzEntrainement() {
        return $this->titreQuizzEntrainement;
    }

    /**
     * Set idChapitreQuizzEntrainement
     *
     * @param \Esprit\MoocBundle\Entity\Chapitre $idChapitreQuizzEntrainement
     * @return QuizzChapitre
     */
    public function setIdChapitreQuizzEntrainement(\Esprit\MoocBundle\Entity\Chapitre $idChapitreQuizzEntrainement = null) {
        $this->idChapitreQuizzEntrainement = $idChapitreQuizzEntrainement;

        return $this;
    }

    /**
     * Get idChapitreQuizzEntrainement
     *
     * @return \Esprit\MoocBundle\Entity\Chapitre 
     */
    public function getIdChapitreQuizzEntrainement() {
        return $this->idChapitreQuizzEntrainement;
    }

    function getDescriptionQuizz() {
        return $this->descriptionQuizz;
    }

    function setDescriptionQuizz($descriptionQuizz) {
        $this->descriptionQuizz = $descriptionQuizz;
    }

    function getDateCreation() {
        return $this->dateCreation;
    }

    function setDateCreation(\DateTime $dateCreation) {
        $this->dateCreation = $dateCreation;
    }

    function getNiveauQuizzEntrainement() {
        return $this->niveauQuizzEntrainement;
    }

    function setNiveauQuizzEntrainement($niveauQuizzEntrainement) {
        $this->niveauQuizzEntrainement = $niveauQuizzEntrainement;
    }

}
