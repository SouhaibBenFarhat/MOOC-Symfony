<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appreciation
 *
 *
 * @ORM\Entity
 */
class Visite {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_visite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur", referencedColumnName="id")
     * })
     */
    private $Apprenant;

    /**
     * @var \Cours
     *
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours", referencedColumnName="id_cours")
     * })
     */
    private $idCours;
    
        /**
     * @var datetime
     *
     * @ORM\Column(name="date_visite", type="datetime",nullable=false)
     */
    private $dateVisite;

    function getId() {
        return $this->id;
    }

    function getApprenant() {
        return $this->Apprenant;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setApprenant(\Esprit\MoocBundle\Entity\Utilisateur $Apprenant) {
        $this->Apprenant = $Apprenant;
    }

    function getIdCours() {
        return $this->idCours;
    }

    function setIdCours(\Esprit\MoocBundle\Entity\Cours $idCours) {
        $this->idCours = $idCours;
    }
    function getDateVisite() {
        return $this->dateVisite;
    }

    function setDateVisite(\DateTime $dateVisite) {
        $this->dateVisite = $dateVisite;
    }


    
}
