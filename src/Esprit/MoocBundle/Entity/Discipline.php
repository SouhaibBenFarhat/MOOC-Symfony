<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discipline
 *
 * @ORM\Table(name="discipline")
 * @ORM\Entity
 */
class Discipline {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_discipline", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDiscipline;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_discipline", type="string", length=25, nullable=false)
     */
    private $nomDiscipline;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=500, nullable=false)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="description_discipline", type="text", nullable=true)
     */
    private $description;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=true)
     */
    private $dateCreation;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_cours", type="integer", nullable=true)
     */
    private $nombreCours;

    /**
     * @var \Forum
     *
     * @ORM\ManyToOne(targetEntity="Forum")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_forum_discipline", referencedColumnName="id_forum")
     * })
     */
    private $idForum;

    /**
     * Get idDiscipline
     *
     * @return integer 
     */
    public function getIdDiscipline() {
        return $this->idDiscipline;
    }

    /**
     * Set nomDiscipline
     *
     * @param string $nomDiscipline
     * @return Discipline
     */
    public function setNomDiscipline($nomDiscipline) {
        $this->nomDiscipline = $nomDiscipline;

        return $this;
    }

    /**
     * Get nomDiscipline
     *
     * @return string 
     */
    public function getNomDiscipline() {
        return $this->nomDiscipline;
    }

    function getLogo() {
        return $this->logo;
    }

    function setLogo($logo) {
        $this->logo = $logo;
    }

    function getNombreCours() {
        return $this->nombreCours;
    }

    function setNombreCours($nombreCours) {
        $this->nombreCours = $nombreCours;
    }

    public function __toString() {
        return $this->nomDiscipline;
    }

    function getIdForum() {
        return $this->idForum;
    }

    function setIdForum(\Esprit\MoocBundle\Entity\Forum $idForum) {
        $this->idForum = $idForum;
    }

    function getDescription() {
        return $this->description;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function getDateCreation() {
        return $this->dateCreation;
    }

    function setDateCreation(\DateTime $dateCreation) {
        $this->dateCreation = $dateCreation;
    }

}
