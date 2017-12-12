<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="Notification")
 * @ORM\Entity
 */
class Notification {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_notification", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_notification", type="datetime" ,nullable=false)
     */
    private $dateNotification;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur_notification", referencedColumnName="id")
     * })
     */
    private $idUtilisateurNotification;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat_notification", type="integer", nullable=false)
     */
    private $etatNotification;
    
        /**
     * @var string
     *
     * @ORM\Column(name="type_notification", type="string", nullable=true)
     */
    private $typeNotification;

    /**
     * @var \Sujet
     *
     * @ORM\ManyToOne(targetEntity="Sujet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sujet_notification", referencedColumnName="id_sujet")
     * })
     */
    private $idSujetNotification;
    
        /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proprietaire_notification", referencedColumnName="id")
     * })
     */
    private $idProprietaireNotification;
    
    

    function getId() {
        return $this->id;
    }

    function getDateNotification() {
        return $this->dateNotification;
    }

    function getIdUtilisateurNotification() {
        return $this->idUtilisateurNotification;
    }

    function getIdSujetNotification() {
        return $this->idSujetNotification;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDateNotification(\DateTime $dateNotification) {
        $this->dateNotification = $dateNotification;
    }

    function setIdUtilisateurNotification(\Esprit\MoocBundle\Entity\Utilisateur $idUtilisateurNotification) {
        $this->idUtilisateurNotification = $idUtilisateurNotification;
    }

    function setIdSujetNotification(\Esprit\MoocBundle\Entity\Sujet $idSujetNotification) {
        $this->idSujetNotification = $idSujetNotification;
    }

    function getEtatNotification() {
        return $this->etatNotification;
    }

    function setEtatNotification($etatNotification) {
        $this->etatNotification = $etatNotification;
    }

    function getIdProprietaireNotification() {
        return $this->idProprietaireNotification;
    }

    function setIdProprietaireNotification(\Esprit\MoocBundle\Entity\Utilisateur $idProprietaireNotification) {
        $this->idProprietaireNotification = $idProprietaireNotification;
    }

    function getTypeNotification() {
        return $this->typeNotification;
    }

    function setTypeNotification($typeNotification) {
        $this->typeNotification = $typeNotification;
    }




}
