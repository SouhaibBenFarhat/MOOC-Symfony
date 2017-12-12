<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="Message")
 * @ORM\Entity
 */
class Message {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_message", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_message", type="string", length=5000 ,nullable=false)
     */
    private $contenuMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_message", type="text", nullable=false)
     */
    private $titreMessage;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_publication_message", type="datetime" ,nullable=false)
     */
    private $datePublicationMessage;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_modification_message", type="datetime" ,nullable=true)
     */
    private $dateModificationMessage;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur_message", referencedColumnName="id")
     * })
     */
    private $idUtilisateurMessage;

    /**
     * @var \Sujet
     *
     * @ORM\ManyToOne(targetEntity="Sujet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sujet_message", referencedColumnName="id_sujet")
     * })
     */
    private $idSujetMessage;

    function getId() {
        return $this->id;
    }

    function getContenuMessage() {
        return $this->contenuMessage;
    }

    function getDatePublicationMessage() {
        return $this->datePublicationMessage;
    }

    function getIdUtilisateurMessage() {
        return $this->idUtilisateurMessage;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setContenuMessage($contenuMessage) {
        $this->contenuMessage = $contenuMessage;
    }

    function setDatePublicationMessage(\DateTime $datePublicationMessage) {
        $this->datePublicationMessage = $datePublicationMessage;
    }

    function setIdUtilisateurMessage(\Esprit\MoocBundle\Entity\Utilisateur $idUtilisateurMessage) {
        $this->idUtilisateurMessage = $idUtilisateurMessage;
    }

    function getIdSujetMessage() {
        return $this->idSujetMessage;
    }

    function setIdSujetMessage(\Esprit\MoocBundle\Entity\Sujet $idSujetMessage) {
        $this->idSujetMessage = $idSujetMessage;
    }

    function getTitreMessage() {
        return $this->titreMessage;
    }

    function setTitreMessage($titreMessage) {
        $this->titreMessage = $titreMessage;
    }

    function getDateModificationMessage() {
        return $this->dateModificationMessage;
    }

    function setDateModificationMessage(\DateTime $dateModificationMessage) {
        $this->dateModificationMessage = $dateModificationMessage;
    }

}
