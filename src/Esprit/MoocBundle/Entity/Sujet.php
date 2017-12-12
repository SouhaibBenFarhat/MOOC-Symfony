<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sujet
 *
 * @ORM\Table(name="Sujet")
 * @ORM\Entity
 */
class Sujet {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sujet", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_sujet", type="string", length=5000 ,nullable=false)
     */
    private $titreSujet;

    /**
     * @var string
     *
     * @ORM\Column(name="soustitre_sujet", type="string", length=5000 ,nullable=true)
     */
    private $sousTitreSujet;

    /**
     * @var string
     *
     * @ORM\Column(name="description_sujet", type="text",nullable=false)
     */
    private $descriptionSujet;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_message", type="integer",nullable=true)
     */
    private $nombreMessage;

    /**
     * @var integer
     *
     * @ORM\Column(name="etat_sujet", type="integer",nullable=true)
     */
    private $etatSujet;

    /**
     * @var integer
     *
     * @ORM\Column(name="aime_sujet", type="integer",nullable=true)
     */
    private $nombreJaime;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_publication_sujet", type="datetime" ,nullable=false)
     */
    private $datePublicationSujet;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_modification_sujet", type="datetime" ,nullable=true)
     */
    private $dateModificationSujet;

    /**
     * @var \Forum
     *
     * @ORM\ManyToOne(targetEntity="Forum")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_forum_sujet", referencedColumnName="id_forum")
     * })
     */
    private $idForum;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_apprenant_sujet", referencedColumnName="id")
     * })
     */
    private $idApprenant;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="last_poster", referencedColumnName="id")
     * })
     */
    private $lastPoster;

    /**
     * @var \Message
     *
     * @ORM\ManyToOne(targetEntity="Message")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="last_poste", referencedColumnName="id_message")
     * })
     */
    private $lastPoste;

    function getId() {
        return $this->id;
    }

    function getTitreSujet() {
        return $this->titreSujet;
    }

    function getSousTitreSujet() {
        return $this->sousTitreSujet;
    }

    function getDescriptionSujet() {
        return $this->descriptionSujet;
    }

    function getIdForum() {
        return $this->idForum;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitreSujet($titreSujet) {
        $this->titreSujet = $titreSujet;
    }

    function setSousTitreSujet($sousTitreSujet) {
        $this->sousTitreSujet = $sousTitreSujet;
    }

    function setDescriptionSujet($descriptionSujet) {
        $this->descriptionSujet = $descriptionSujet;
    }

    function setIdForum(\Esprit\MoocBundle\Entity\Forum $idForum) {
        $this->idForum = $idForum;
    }

    function getDatePublicationSujet() {
        return $this->datePublicationSujet;
    }

    function setDatePublicationSujet(\DateTime $datePublicationSujet) {
        $this->datePublicationSujet = $datePublicationSujet;
    }

    function getIdApprenant() {
        return $this->idApprenant;
    }

    function setIdApprenant(\Esprit\MoocBundle\Entity\Utilisateur $idApprenant) {
        $this->idApprenant = $idApprenant;
    }

    function getNombreMessage() {
        return $this->nombreMessage;
    }

    function setNombreMessage($nombreMessage) {
        $this->nombreMessage = $nombreMessage;
    }

    function getDateModificationSujet() {
        return $this->dateModificationSujet;
    }

    function setDateModificationSujet(\DateTime $dateModificationSujet) {
        $this->dateModificationSujet = $dateModificationSujet;
    }

    function getEtatSujet() {
        return $this->etatSujet;
    }

    function setEtatSujet($etatSujet) {
        $this->etatSujet = $etatSujet;
    }

    function getNombreJaime() {
        return $this->nombreJaime;
    }

    function setNombreJaime($nombreJaime) {
        $this->nombreJaime = $nombreJaime;
    }

    function getLastPoster() {
        return $this->lastPoster;
    }

    function setLastPoster(\Esprit\MoocBundle\Entity\Utilisateur $lastPoster) {
        $this->lastPoster = $lastPoster;
    }

    function getLastPoste() {
        return $this->lastPoste;
    }

    function setLastPoste(\Esprit\MoocBundle\Entity\Message $lastPoste) {
        $this->lastPoste = $lastPoste;
    }


}
