<?php

namespace Esprit\MoocBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_1D1C63B392FC23A8", columns={"username_canonical"}), @ORM\UniqueConstraint(name="UNIQ_1D1C63B3A0D96FBF", columns={"email_canonical"})})
 * @ORM\Entity(repositoryClass="Esprit\MoocBundle\Repository\UtilisateurRepository")
 */
class Utilisateur extends BaseUser {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\Column(name="type_utilisateur", type="string", length=200, nullable=true)
     */
    private $typeUtilisateur;

    /**
     *
     * @ORM\Column(name="cv_utilisateur", type="string", length=200, nullable=true)
     */
    private $cvUtilisateur;

    /**
     *
     * @ORM\Column(name="adresse_utlisateur", type="string", length=200, nullable=true)
     */
    private $adresseUtilisateur;

    /**
     *
     * @ORM\Column(name="attestation_utilisateur", type="string", length=200, nullable=true)
     */
    private $attestationUtilisateur;

    /**
     *
     * @ORM\Column(name="etat_utilisateur", type="string", length=200, nullable=true)
     */
    private $etatUtilisateur;

    /**
     *
     * @ORM\Column(name="num_tel_utilisateur", type="string", length=200, nullable=true)
     */
    private $numTelUtilisateur;

    /**
     *
     * @ORM\Column(name="photo_utilisateur", type="string", length=500, nullable=true)
     */
    private $photoUtilisateur;

    /**
     * @var \Cours
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_entreprise_utilisateur", referencedColumnName="id")
     * })
     */
    private $idEntrepriseUtlisateur;

    /**
     *
     * @ORM\Column(name="date_creation_entreprise", type="date", nullable=true)
     */
    private $dateCreationEntreprise;

    /**
     *
     * @ORM\Column(name="specialite_utilisateur", type="string", length=200, nullable=true)
     */
    private $specialiteUtilisateur;

    /**
     *
     * @ORM\Column(name="description_entreprise", type="string", length=200, nullable=true)
     */
    private $descriptionEntreprise;

    /**
     * @var \Cours
     *
     * @ORM\OneToOne(targetEntity="informationEntreprise")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="information_entreprise_utilisateur", referencedColumnName="id")
     * })
     */
    private $informationEntreprise;

    /**
     * @var \Cours
     *
     * @ORM\OneToOne(targetEntity="informationFormateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="information_formateur_utilisateur", referencedColumnName="id")
     * })
     */
    private $informationFormateur;

    /**
     * @var \UserPhoto
     *
     * @ORM\OneToOne(targetEntity="UserPhoto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_photo", referencedColumnName="id_photo")
     * })
     */
    private $userPhoto;

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getTypeUtilisateur() {
        return $this->typeUtilisateur;
    }

    function getCvUtilisateur() {
        return $this->cvUtilisateur;
    }

    function getAdresseUtilisateur() {
        return $this->adresseUtilisateur;
    }

    function getAttestationUtilisateur() {
        return $this->attestationUtilisateur;
    }

    function getEtatUtilisateur() {
        return $this->etatUtilisateur;
    }

    function getNumTelUtilisateur() {
        return $this->numTelUtilisateur;
    }

    function getIdEntrepriseUtlisateur() {
        return $this->idEntrepriseUtlisateur;
    }

    function setTypeUtilisateur($typeUtilisateur) {
        $this->typeUtilisateur = $typeUtilisateur;
    }

    function setCvUtilisateur($cvUtilisateur) {
        $this->cvUtilisateur = $cvUtilisateur;
    }

    function setAdresseUtilisateur($adresseUtilisateur) {
        $this->adresseUtilisateur = $adresseUtilisateur;
    }

    function setAttestationUtilisateur($attestationUtilisateur) {
        $this->attestationUtilisateur = $attestationUtilisateur;
    }

    function setEtatUtilisateur($etatUtilisateur) {
        $this->etatUtilisateur = $etatUtilisateur;
    }

    function setNumTelUtilisateur($numTelUtilisateur) {
        $this->numTelUtilisateur = $numTelUtilisateur;
    }

    function setIdEntrepriseUtlisateur(\Esprit\MoocBundle\Entity\Utilisateur $idEntrepriseUtlisateur) {
        $this->idEntrepriseUtlisateur = $idEntrepriseUtlisateur;
    }

    function getDateCreationEntreprise() {
        return $this->dateCreationEntreprise;
    }

    function setDateCreationEntreprise($dateCreationEntreprise) {
        $this->dateCreationEntreprise = $dateCreationEntreprise;
    }

    function getSpecialiteUtilisateur() {
        return $this->specialiteUtilisateur;
    }

    function setSpecialiteUtilisateur($specialiteUtilisateur) {
        $this->specialiteUtilisateur = $specialiteUtilisateur;
    }

    function getDescriptionEntreprise() {
        return $this->descriptionEntreprise;
    }

    function setDescriptionEntreprise($descriptionEntreprise) {
        $this->descriptionEntreprise = $descriptionEntreprise;
    }

    function getInformationEntreprise() {
        return $this->informationEntreprise;
    }

    function getInformationFormateur() {
        return $this->informationFormateur;
    }

    function setInformationEntreprise(\Esprit\MoocBundle\Entity\informationEntreprise $informationEntreprise) {
        $this->informationEntreprise = $informationEntreprise;
    }

    function setInformationFormateur(\Esprit\MoocBundle\Entity\informationFormateur $informationFormateur) {
        $this->informationFormateur = $informationFormateur;
    }

    function getPhotoUtilisateur() {
        return $this->photoUtilisateur;
    }

    function setPhotoUtilisateur($photoUtilisateur) {
        $this->photoUtilisateur = $photoUtilisateur;
    }

    
    
    function getUserPhoto() {
        return $this->userPhoto;
    }

    function setUserPhoto(\Esprit\MoocBundle\Entity\UserPhoto $userPhoto) {
        $this->userPhoto = $userPhoto;
    }


}
