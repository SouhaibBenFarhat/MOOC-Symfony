<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Forum
 *
 * @ORM\Table(name="Forum")
 * @ORM\Entity(repositoryClass="Esprit\MoocBundle\Repository\ForumRepository")
 */
class Forum {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_forum", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_forum", type="string", length=200 ,nullable=false)
     */
    private $nomForum;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_sujet", type="integer",nullable=true)
     */
    private $nombreSujet;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_vu", type="integer",nullable=true)
     */
    private $nombreVue;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_creation", type="datetime" ,nullable=false)
     */
    private $dateCreation;

    /**
     * @var \Discipline
     *
     * @ORM\ManyToOne(targetEntity="Discipline")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_discipline_forum", referencedColumnName="id_discipline")
     * })
     */
    private $idDiscipline;

    /**
     * @var \Sujet
     *
     * @ORM\ManyToOne(targetEntity="Sujet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="last_sujet", referencedColumnName="id_sujet")
     * })
     */
    private $lastSujet;

    function getId() {
        return $this->id;
    }

    function getNomForum() {
        return $this->nomForum;
    }

    function getIdDiscipline() {
        return $this->idDiscipline;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNomForum($nomForum) {
        $this->nomForum = $nomForum;
    }

    function setIdDiscipline(\Esprit\MoocBundle\Entity\Discipline $idDiscipline) {
        $this->idDiscipline = $idDiscipline;
    }

    function getDateCreation() {
        return $this->dateCreation;
    }

    function setDateCreation(\DateTime $dateCreation) {
        $this->dateCreation = $dateCreation;
    }

    function getNombreSujet() {
        return $this->nombreSujet;
    }

    function setNombreSujet($nombreSujet) {
        $this->nombreSujet = $nombreSujet;
    }

    function getLastSujet() {
        return $this->lastSujet;
    }

    function setLastSujet(\Esprit\MoocBundle\Entity\Sujet $lastSujet) {
        $this->lastSujet = $lastSujet;
    }
    function getNombreVue() {
        return $this->nombreVue;
    }

    function setNombreVue($nombreVue) {
        $this->nombreVue = $nombreVue;
    }


}
