<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="ContactMessage")
 * @ORM\Entity
 */
class ContactMessage {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_contact_message", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_envoi", type="datetime" ,nullable=false)
     */
    private $dateEnvoi;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_Message", type="string" ,nullable=true)
     */
    private $titreMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_message", type="text" ,nullable=false)
     */
    private $contenuMessage;

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
     * @var \Discussion
     *
     * @ORM\ManyToOne(targetEntity="Discussion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_discussion", referencedColumnName="id_discussion")
     * })
     */
    private $idDiscussion;

    function getId() {
        return $this->id;
    }

    function getDateEnvoi() {
        return $this->dateEnvoi;
    }

    function getTitreMessage() {
        return $this->titreMessage;
    }

    function getContenuMessage() {
        return $this->contenuMessage;
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

    function setDateEnvoi(\DateTime $dateEnvoi) {
        $this->dateEnvoi = $dateEnvoi;
    }

    function setTitreMessage($titreMessage) {
        $this->titreMessage = $titreMessage;
    }

    function setContenuMessage($contenuMessage) {
        $this->contenuMessage = $contenuMessage;
    }

    function setIdUtilisateurSource(\Esprit\MoocBundle\Entity\Utilisateur $idUtilisateurSource) {
        $this->idUtilisateurSource = $idUtilisateurSource;
    }

    function setIdUtilisateurDestination(\Esprit\MoocBundle\Entity\Utilisateur $idUtilisateurDestination) {
        $this->idUtilisateurDestination = $idUtilisateurDestination;
    }

    function getIdDiscussion() {
        return $this->idDiscussion;
    }

    function setIdDiscussion(\Esprit\MoocBundle\Entity\Discussion $idDiscussion) {
        $this->idDiscussion = $idDiscussion;
    }

}
