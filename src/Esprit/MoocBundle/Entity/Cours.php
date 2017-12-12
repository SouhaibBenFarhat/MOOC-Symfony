<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cours
 *
 * @ORM\Table(name="cours", indexes={@ORM\Index(name="IDX_FDCA8C9CC92EF92C", columns={"id_formateur_cours"}), @ORM\Index(name="IDX_FDCA8C9C59276A05", columns={"id_discipline_cours"})})
 *  @ORM\Entity(repositoryClass="Esprit\MoocBundle\Repository\CoursRepository")
 */
class Cours {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_cours", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCours;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_cours", type="string", length=200, nullable=false)
     */
    private $titreCours;

    /**
     * @var string
     *
     * @ORM\Column(name="description_cours", type="text", nullable=false)
     */
    private $descriptionCours;

    /**
     * @var string
     *
     * @ORM\Column(name="objectif_cours", type="text", nullable=false)
     */
    private $objectifCours;

    /**
     * @var string
     *
     * @ORM\Column(name="prerequis_cours", type="text",  nullable=false)
     */
    private $prerequisCours;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree_cours", type="integer", nullable=false)
     */
    private $dureeCours;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_cours", type="string", length=50, nullable=false)
     */
    private $etatCours;

    /**
     * @var string
     *
     * @ORM\Column(name="video_cours", type="string", length=200, nullable=false)
     */
    private $videoCours;

    /**
     * @var string
     *
     * @ORM\Column(name="introduction_cours", type="text",  nullable=false)
     */
    private $introductionCours;

    /**
     * @var integer
     *
     * @ORM\Column(name="like_cours", type="integer", nullable=true)
     */
    private $likeCours;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_chapitre_cours", type="integer", nullable=true)
     */
    private $nombreChapitreCours;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau_cours", type="string", length=50, nullable=false)
     */
    private $niveauCours;

    /**
     * @var integer
     *
     * @ORM\Column(name="aime_cours", type="integer",nullable=true)
     */
    private $nombreJaime;

    /**
     * @var \Discipline
     *
     * @ORM\ManyToOne(targetEntity="Discipline")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_discipline_cours", referencedColumnName="id_discipline")
     * })
     */
    private $idDisciplineCours;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_formateur_cours", referencedColumnName="id")
     * })
     */
    private $idFormateurCours;

    /**
     * @var \QuizzCours
     *
     * @ORM\ManyToOne(targetEntity="QuizzCours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_quizz_cours", referencedColumnName="id_quizz_cours")
     * })
     */
    private $idQuizzCours;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_ajout", type="datetime",  nullable=false)
     */
    private $dateAjout;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_visite", type="integer",  nullable=true)
     */
    private $nombreVisite;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_participants_cours", type="integer",  nullable=true )
     */
    private $NombreParticipantsCours;

    function getIdCours() {
        return $this->idCours;
    }

    function getTitreCours() {
        return $this->titreCours;
    }

    function getDescriptionCours() {
        return $this->descriptionCours;
    }

    function getObjectifCours() {
        return $this->objectifCours;
    }

    function getPrerequisCours() {
        return $this->prerequisCours;
    }

    function getDureeCours() {
        return $this->dureeCours;
    }

    function getEtatCours() {
        return $this->etatCours;
    }

    function getVideoCours() {
        return $this->videoCours;
    }

    function getLikeCours() {
        return $this->likeCours;
    }

    function getNiveauCours() {
        return $this->niveauCours;
    }

    function getIdDisciplineCours() {
        return $this->idDisciplineCours;
    }

    function getIdFormateurCours() {
        return $this->idFormateurCours;
    }

    function setIdCours($idCours) {
        $this->idCours = $idCours;
    }

    function setTitreCours($titreCours) {
        $this->titreCours = $titreCours;
    }

    function setDescriptionCours($descriptionCours) {
        $this->descriptionCours = $descriptionCours;
    }

    function setObjectifCours($objectifCours) {
        $this->objectifCours = $objectifCours;
    }

    function setPrerequisCours($prerequisCours) {
        $this->prerequisCours = $prerequisCours;
    }

    function setDureeCours($dureeCours) {
        $this->dureeCours = $dureeCours;
    }

    function setEtatCours($etatCours) {
        $this->etatCours = $etatCours;
    }

    function setVideoCours($videoCours) {
        $this->videoCours = $videoCours;
    }

    function setLikeCours($likeCours) {
        $this->likeCours = $likeCours;
    }

    function setNiveauCours($niveauCours) {
        $this->niveauCours = $niveauCours;
    }

    function setIdDisciplineCours(\Esprit\MoocBundle\Entity\Discipline $idDisciplineCours) {
        $this->idDisciplineCours = $idDisciplineCours;
    }

    function setIdFormateurCours(\Esprit\MoocBundle\Entity\Utilisateur $idFormateurCours) {
        $this->idFormateurCours = $idFormateurCours;
    }

    function getIntroductionCours() {
        return $this->introductionCours;
    }

    function setIntroductionCours($introductionCours) {
        $this->introductionCours = $introductionCours;
    }

    public function __toString() {
        return $this->titreCours;
    }

    function getDateAjout() {
        return $this->dateAjout;
    }

    function setDateAjout(\DateTime $dateAjout) {
        $this->dateAjout = $dateAjout;
    }

    function getNombreVisite() {
        return $this->nombreVisite;
    }

    function setNombreVisite($nombreVisite) {
        $this->nombreVisite = $nombreVisite;
    }

    function getNombreJaime() {
        return $this->nombreJaime;
    }

    function setNombreJaime($nombreJaime) {
        $this->nombreJaime = $nombreJaime;
    }

    function getNombreParticipantsCours() {
        return $this->NombreParticipantsCours;
    }

    function setNombreParticipantsCours($NombreParticipantsCours) {
        $this->NombreParticipantsCours = $NombreParticipantsCours;
    }

    function getIdQuizzCours() {
        return $this->idQuizzCours;
    }

    function setIdQuizzCours(\Esprit\MoocBundle\Entity\QuizzCours $idQuizzCours) {
        $this->idQuizzCours = $idQuizzCours;
    }

    function getNombreChapitreCours() {
        return $this->nombreChapitreCours;
    }

    function setNombreChapitreCours($nombreChapitreCours) {
        $this->nombreChapitreCours = $nombreChapitreCours;
    }

}
