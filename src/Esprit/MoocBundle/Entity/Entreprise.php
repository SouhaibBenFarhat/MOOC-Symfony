<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entreprise
 *
 * @ORM\Table(name="entreprise")
 * @ORM\Entity
 */
class Entreprise
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_entreprise", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_entreprise", type="string", length=25, nullable=false)
     */
    private $nomEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="description_entreprise", type="string", length=350, nullable=false)
     */
    private $descriptionEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="attestation_entreprise", type="string", length=250, nullable=false)
     */
    private $attestationEntreprise;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation_entreprise", type="date", nullable=false)
     */
    private $dateCreationEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_entreprise", type="string", length=20, nullable=false)
     */
    private $responsableEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_entreprise", type="string", length=50, nullable=false)
     */
    private $etatEntreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse_entreprise", type="string", length=100, nullable=false)
     */
    private $adresseEntreprise;

    /**
     * @var integer
     *
     * @ORM\Column(name="tel_entreprise", type="integer", nullable=false)
     */
    private $telEntreprise;



    /**
     * Get idEntreprise
     *
     * @return integer 
     */
    public function getIdEntreprise()
    {
        return $this->idEntreprise;
    }

    /**
     * Set nomEntreprise
     *
     * @param string $nomEntreprise
     * @return Entreprise
     */
    public function setNomEntreprise($nomEntreprise)
    {
        $this->nomEntreprise = $nomEntreprise;

        return $this;
    }

    /**
     * Get nomEntreprise
     *
     * @return string 
     */
    public function getNomEntreprise()
    {
        return $this->nomEntreprise;
    }

    /**
     * Set descriptionEntreprise
     *
     * @param string $descriptionEntreprise
     * @return Entreprise
     */
    public function setDescriptionEntreprise($descriptionEntreprise)
    {
        $this->descriptionEntreprise = $descriptionEntreprise;

        return $this;
    }

    /**
     * Get descriptionEntreprise
     *
     * @return string 
     */
    public function getDescriptionEntreprise()
    {
        return $this->descriptionEntreprise;
    }

    /**
     * Set attestationEntreprise
     *
     * @param string $attestationEntreprise
     * @return Entreprise
     */
    public function setAttestationEntreprise($attestationEntreprise)
    {
        $this->attestationEntreprise = $attestationEntreprise;

        return $this;
    }

    /**
     * Get attestationEntreprise
     *
     * @return string 
     */
    public function getAttestationEntreprise()
    {
        return $this->attestationEntreprise;
    }

    /**
     * Set dateCreationEntreprise
     *
     * @param \DateTime $dateCreationEntreprise
     * @return Entreprise
     */
    public function setDateCreationEntreprise($dateCreationEntreprise)
    {
        $this->dateCreationEntreprise = $dateCreationEntreprise;

        return $this;
    }

    /**
     * Get dateCreationEntreprise
     *
     * @return \DateTime 
     */
    public function getDateCreationEntreprise()
    {
        return $this->dateCreationEntreprise;
    }

    /**
     * Set responsableEntreprise
     *
     * @param string $responsableEntreprise
     * @return Entreprise
     */
    public function setResponsableEntreprise($responsableEntreprise)
    {
        $this->responsableEntreprise = $responsableEntreprise;

        return $this;
    }

    /**
     * Get responsableEntreprise
     *
     * @return string 
     */
    public function getResponsableEntreprise()
    {
        return $this->responsableEntreprise;
    }

    /**
     * Set etatEntreprise
     *
     * @param string $etatEntreprise
     * @return Entreprise
     */
    public function setEtatEntreprise($etatEntreprise)
    {
        $this->etatEntreprise = $etatEntreprise;

        return $this;
    }

    /**
     * Get etatEntreprise
     *
     * @return string 
     */
    public function getEtatEntreprise()
    {
        return $this->etatEntreprise;
    }

    /**
     * Set adresseEntreprise
     *
     * @param string $adresseEntreprise
     * @return Entreprise
     */
    public function setAdresseEntreprise($adresseEntreprise)
    {
        $this->adresseEntreprise = $adresseEntreprise;

        return $this;
    }

    /**
     * Get adresseEntreprise
     *
     * @return string 
     */
    public function getAdresseEntreprise()
    {
        return $this->adresseEntreprise;
    }

    /**
     * Set telEntreprise
     *
     * @param integer $telEntreprise
     * @return Entreprise
     */
    public function setTelEntreprise($telEntreprise)
    {
        $this->telEntreprise = $telEntreprise;

        return $this;
    }

    /**
     * Get telEntreprise
     *
     * @return integer 
     */
    public function getTelEntreprise()
    {
        return $this->telEntreprise;
    }
}
