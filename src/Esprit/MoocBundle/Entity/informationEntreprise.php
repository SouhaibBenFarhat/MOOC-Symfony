<?php

namespace Esprit\MoocBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="information_Entreprise")
 */
class informationEntreprise {

    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\Column(name="specialite", type="string", length=200)
     * @Assert\Length(min=1,max=20)
     */
    private $specialite;

    /**
     *
     * @ORM\Column(name="site_web", type="string", length=200)
     */
    private $siteWeb;

    /**
     *
     * @ORM\Column(name="abreviation", type="string", length=10)
     */
    private $abreviation;

    /**
     *
     * @ORM\Column(name="gouvernerat", type="string", length=10)
     */
    private $gouvernerat;

    /**
     *
     * @ORM\Column(name="attestation", type="string", length=200)
     */
    private $attestation;

    /**
     *
     * @ORM\Column(name="filename", type="string", length=200)
     */
    private $filename;

    /**
     *
     * @ORM\Column(name="description", type="string", length=500)
     */
    private $description;

    /**
     *
     * @ORM\Column(name="code_postale", type="integer", length=10)
     */
    private $codePostale;

    /**
     *
     * @ORM\Column(name="type", type="string", length=10, nullable=true)
     */
    private $type;

    /**
     *
     * @ORM\Column(name="adresse", type="string", length=100)
     */
    private $adresse;

    /**
     *
     * @ORM\Column(name="nationnalite", type="string", length=100)
     */
    private $nationnalite;

    /**
     *
     * @ORM\Column(name="numTel", type="integer", length=100)
     */
    private $numTel;

    /**
     *
     * @ORM\Column(name="matriculeFiscal", type="integer", length=100)
     */
    private $matriculeFiscal;

    /**
     *
     * @ORM\Column(name="raison_inscription", type="string", length=300)
     */
    private $raisonInscription;

    /**
     *
     * @ORM\OneToOne(targetEntity="Utilisateur")
     */
    private $entreprise;

    
    function getId() {
        return $this->id;
    }

    function getSpecialite() {
        return $this->specialite;
    }

    function getSiteWeb() {
        return $this->siteWeb;
    }

    function getAbreviation() {
        return $this->abreviation;
    }

    function getGouvernerat() {
        return $this->gouvernerat;
    }

    function getAttestation() {
        return $this->attestation;
    }

    function getFilename() {
        return $this->filename;
    }

    function getDescription() {
        return $this->description;
    }

    function getCodePostale() {
        return $this->codePostale;
    }

    function getType() {
        return $this->type;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getNationnalite() {
        return $this->nationnalite;
    }

    function getNumTel() {
        return $this->numTel;
    }

    function getMatriculeFiscal() {
        return $this->matriculeFiscal;
    }

    function getRaisonInscription() {
        return $this->raisonInscription;
    }

    function getEntreprise() {
        return $this->entreprise;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSpecialite($specialite) {
        $this->specialite = $specialite;
    }

    function setSiteWeb($siteWeb) {
        $this->siteWeb = $siteWeb;
    }

    function setAbreviation($abreviation) {
        $this->abreviation = $abreviation;
    }

    function setGouvernerat($gouvernerat) {
        $this->gouvernerat = $gouvernerat;
    }

    function setAttestation($attestation) {
        $this->attestation = $attestation;
    }

    function setFilename($filename) {
        $this->filename = $filename;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setCodePostale($codePostale) {
        $this->codePostale = $codePostale;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    function setNationnalite($nationnalite) {
        $this->nationnalite = $nationnalite;
    }

    function setNumTel($numTel) {
        $this->numTel = $numTel;
    }

    function setMatriculeFiscal($matriculeFiscal) {
        $this->matriculeFiscal = $matriculeFiscal;
    }

    function setRaisonInscription($raisonInscription) {
        $this->raisonInscription = $raisonInscription;
    }

    function setEntreprise($entreprise) {
        $this->entreprise = $entreprise;
    }


    
}
