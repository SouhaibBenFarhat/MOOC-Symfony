<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chapitre
 *
 * @ORM\Table(name="chapitre", indexes={@ORM\Index(name="IDX_8C62B0257690A3FE", columns={"id_cours_chapitre"})})
 * @ORM\Entity
 */
class Chapitre {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_chapitre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idChapitre;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_chapitre", type="string", length=200, nullable=false)
     */
    private $titreChapitre;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree_chapitre", type="integer", nullable=false)
     */
    private $dureeChapitre;

    /**
     * @var string
     *
     * @ORM\Column(name="description_chapitre", type="text", nullable=false)
     */
    private $descriptionChapitre;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau_chapitre", type="string", length=200, nullable=false)
     */
    private $niveauChapitre;

    /**
     * @var string
     *
     * @ORM\Column(name="chemin_chapitre", type="string", length=200, nullable=false)
     */
    private $cheminChapitre;

    /**
     * @var string
     *
     * @ORM\Column(name="chemin_video_chapitre", type="string", length=200, nullable=false)
     */
    private $cheminVideoChapitre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_chapitre", type="text", nullable=false)
     */
    private $contenuChapitre;

    /**
     * @var string
     *
     * @ORM\Column(name="chemin_presentation_chapitre", type="string", length=200, nullable=false)
     */
    private $cheminPresentationChapitre;

    /**
     * @var string
     *
     * @ORM\Column(name="introduction_chapitre", type="text", nullable=false)
     */
    private $introductionChapitre;

    /**
     * @var string
     *
     * @ORM\Column(name="objectif_chapitre", type="text", nullable=false)
     */
    private $objectifChapitre;

    /**
     * @var \Cours
     *
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours_chapitre", referencedColumnName="id_cours")
     * })
     */
    private $idCoursChapitre;

    /**
     * @var \QuizzChapitre
     *
     * @ORM\ManyToOne(targetEntity="QuizzChapitre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quizz_chapitre", referencedColumnName="id_quizz_entrainement")
     * })
     */
    private $idQuizzChapitre;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_ajout", type="datetime",nullable=false)
     */
    private $dateAjout;

    /**
     * Get idChapitre
     *
     * @return integer 
     */
    public function getIdChapitre() {
        return $this->idChapitre;
    }

    /**
     * Set titreChapitre
     *
     * @param string $titreChapitre
     * @return Chapitre
     */
    public function setTitreChapitre($titreChapitre) {
        $this->titreChapitre = $titreChapitre;

        return $this;
    }

    /**
     * Get titreChapitre
     *
     * @return string 
     */
    public function getTitreChapitre() {
        return $this->titreChapitre;
    }

    /**
     * Set descriptionChapitre
     *
     * @param string $descriptionChapitre
     * @return Chapitre
     */
    public function setDescriptionChapitre($descriptionChapitre) {
        $this->descriptionChapitre = $descriptionChapitre;

        return $this;
    }

    /**
     * Get descriptionChapitre
     *
     * @return string 
     */
    public function getDescriptionChapitre() {
        return $this->descriptionChapitre;
    }

    /**
     * Set cheminChapitre
     *
     * @param string $cheminChapitre
     * @return Chapitre
     */
    public function setCheminChapitre($cheminChapitre) {
        $this->cheminChapitre = $cheminChapitre;

        return $this;
    }

    /**
     * Get cheminChapitre
     *
     * @return string 
     */
    public function getCheminChapitre() {
        return $this->cheminChapitre;
    }

    /**
     * Set cheminVideoChapitre
     *
     * @param string $cheminVideoChapitre
     * @return Chapitre
     */
    public function setCheminVideoChapitre($cheminVideoChapitre) {
        $this->cheminVideoChapitre = $cheminVideoChapitre;

        return $this;
    }

    /**
     * Get cheminVideoChapitre
     *
     * @return string 
     */
    public function getCheminVideoChapitre() {
        return $this->cheminVideoChapitre;
    }

    /**
     * Set cheminPresentationChapitre
     *
     * @param string $cheminPresentationChapitre
     * @return Chapitre
     */
    public function setCheminPresentationChapitre($cheminPresentationChapitre) {
        $this->cheminPresentationChapitre = $cheminPresentationChapitre;

        return $this;
    }

    /**
     * Get cheminPresentationChapitre
     *
     * @return string 
     */
    public function getCheminPresentationChapitre() {
        return $this->cheminPresentationChapitre;
    }

    /**
     * Set idCoursChapitre
     *
     * @param \Esprit\MoocBundle\Entity\Cours $idCoursChapitre
     * @return Chapitre
     */
    public function setIdCoursChapitre(\Esprit\MoocBundle\Entity\Cours $idCoursChapitre = null) {
        $this->idCoursChapitre = $idCoursChapitre;

        return $this;
    }

    /**
     * Get idCoursChapitre
     *
     * @return \Esprit\MoocBundle\Entity\Cours 
     */
    public function getIdCoursChapitre() {
        return $this->idCoursChapitre;
    }

    function getContenuChapitre() {
        return $this->contenuChapitre;
    }

    function setContenuChapitre($contenuChapitre) {
        $this->contenuChapitre = $contenuChapitre;
    }

    function getDureeChapitre() {
        return $this->dureeChapitre;
    }

    function setDureeChapitre($dureeChapitre) {
        $this->dureeChapitre = $dureeChapitre;
    }

    function getIntroductionChapitre() {
        return $this->introductionChapitre;
    }

    function setIntroductionChapitre($introductionChapitre) {
        $this->introductionChapitre = $introductionChapitre;
    }

    function getObjectifChapitre() {
        return $this->objectifChapitre;
    }

    function setObjectifChapitre($objectifChapitre) {
        $this->objectifChapitre = $objectifChapitre;
    }

    function getNiveauChapitre() {
        return $this->niveauChapitre;
    }

    function setNiveauChapitre($niveauChapitre) {
        $this->niveauChapitre = $niveauChapitre;
    }

    function getDateAjout() {
        return $this->dateAjout;
    }

    function setDateAjout(\DateTime $dateAjout) {
        $this->dateAjout = $dateAjout;
    }
    function getIdQuizzChapitre() {
        return $this->idQuizzChapitre;
    }

    function setIdQuizzChapitre(\Esprit\MoocBundle\Entity\QuizzChapitre $idQuizzChapitre) {
        $this->idQuizzChapitre = $idQuizzChapitre;
    }


}
