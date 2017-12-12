<?php

namespace Esprit\MoocBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="information_formateur")
 */
class informationFormateur {

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
     * @ORM\Column(name="cv", type="string", length=200)
     */
    private $cv;

    /**
     *
     * @ORM\Column(name="filename", type="string", length=200)
     */
    private $filename;

    /**
     *
     * @ORM\Column(name="googlePlus", type="string", length=200)
     */
    private $googlePlus;

    /**
     *
     * @ORM\Column(name="siteWeb", type="string", length=200)
     */
    private $siteWeb;

    
    /**
     *
     * @ORM\Column(name="aPropos", type="string", length=5000)
     */
    private $aPropos;

    /**
     *
     * @ORM\Column(name="biographie", type="string", length=5000)
     */
    private $biographie;

    /**
     *
     * @ORM\Column(name="miniBiographie", type="string", length=5000)
     */
    private $miniBiographie;

    /**
     *
     * @ORM\OneToOne(targetEntity="Utilisateur")
     */
    private $formateur;

    function getId() {
        return $this->id;
    }

    function getSpecialite() {
        return $this->specialite;
    }

    function getCv() {
        return $this->cv;
    }

    function getFormateur() {
        return $this->formateur;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setSpecialite($specialite) {
        $this->specialite = $specialite;
    }

    function setCv($cv) {
        $this->cv = $cv;
    }

    function setFormateur($formateur) {
        $this->formateur = $formateur;
    }

    function getFilename() {
        return $this->filename;
    }

    function setFilename($filename) {
        $this->filename = $filename;
    }

    function getGooglePlus() {
        return $this->googlePlus;
    }

    function getSiteWeb() {
        return $this->siteWeb;
    }

    

    function getAPropos() {
        return $this->aPropos;
    }

    function getBiographie() {
        return $this->biographie;
    }

    function getMiniBiographie() {
        return $this->miniBiographie;
    }

    function setGooglePlus($googlePlus) {
        $this->googlePlus = $googlePlus;
    }

    function setSiteWeb($siteWeb) {
        $this->siteWeb = $siteWeb;
    }

    
    function setAPropos($aPropos) {
        $this->aPropos = $aPropos;
    }

    function setBiographie($biographie) {
        $this->biographie = $biographie;
    }

    function setMiniBiographie($miniBiographie) {
        $this->miniBiographie = $miniBiographie;
    }

}
