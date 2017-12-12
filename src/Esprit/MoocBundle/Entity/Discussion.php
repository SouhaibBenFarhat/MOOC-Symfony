<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="Discussion")
 * @ORM\Entity(repositoryClass="Esprit\MoocBundle\Repository\DiscussionRepository")
 */
class Discussion {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_discussion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_publication_message", type="datetime" ,nullable=false)
     */
    private $dateCreation;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_mise_a_jour", type="datetime" ,nullable=true)
     */
    private $dateMiseAJour;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_message", type="integer" ,nullable=true)
     */
    private $nombreMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="sujet_discussion", type="string" ,nullable=false)
     */
    private $sujetDiscussion;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur_source", referencedColumnName="id")
     * })
     */
    private $idUtilisateurSource;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur_destination", referencedColumnName="id")
     * })
     */
    private $idUtilisateurDestination;

    /**
     * @var \ContactMessage
     *
     * @ORM\ManyToOne(targetEntity="ContactMessage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="last_message", referencedColumnName="id_contact_message")
     * })
     */
    private $lastMessage;

    function getId() {
        return $this->id;
    }

    function getDateCreation() {
        return $this->dateCreation;
    }

    function getIdUtilisateurSource() {
        return $this->idUtilisateurSource;
    }

    function getIdUtilisateurDestination() {
        return $this->idUtilisateurDestination;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDateCreation(\DateTime $dateCreation) {
        $this->dateCreation = $dateCreation;
    }

    function setIdUtilisateurSource(\Esprit\MoocBundle\Entity\Utilisateur $idUtilisateurSource) {
        $this->idUtilisateurSource = $idUtilisateurSource;
    }

    function setIdUtilisateurDestination(\Esprit\MoocBundle\Entity\Utilisateur $idUtilisateurDestination) {
        $this->idUtilisateurDestination = $idUtilisateurDestination;
    }

    function getSujetDiscussion() {
        return $this->sujetDiscussion;
    }

    function setSujetDiscussion($sujetDiscussion) {
        $this->sujetDiscussion = $sujetDiscussion;
    }

    function getLastMessage() {
        return $this->lastMessage;
    }

    function setLastMessage(\Esprit\MoocBundle\Entity\ContactMessage $lastMessage) {
        $this->lastMessage = $lastMessage;
    }

    function getNombreMessage() {
        return $this->nombreMessage;
    }

    function setNombreMessage($nombreMessage) {
        $this->nombreMessage = $nombreMessage;
    }

    function getDateMiseAJour() {
        return $this->dateMiseAJour;
    }

    function setDateMiseAJour(\DateTime $dateMiseAJour) {
        $this->dateMiseAJour = $dateMiseAJour;
    }

}
