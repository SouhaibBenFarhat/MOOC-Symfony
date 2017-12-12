<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appreciation
 *
 * @ORM\Table(name="appreciation", indexes={@ORM\Index(name="IDX_5CD4DEABC8036527", columns={"id_cours_appreciation"}), @ORM\Index(name="IDX_5CD4DEABE5D8D4F8", columns={"id_apprenant_appreciation"}), @ORM\Index(name="id_cours", columns={"id_cours_appreciation", "id_apprenant_appreciation"})})
 * @ORM\Entity
 */
class Appreciation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_appreciation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="valeur_appreciation", type="text",nullable=false)
     */
    private $valeurAppreciation;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_apprenant_appreciation", referencedColumnName="id")
     * })
     */
    private $Apprenant;

    /**
     * @var \Cours
     *
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours_appreciation", referencedColumnName="id_cours")
     * })
     */
    private $idCoursAppreciation;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set valeurAppreciation
     *
     * @param string $valeurAppreciation
     * @return Appreciation
     */
    public function setValeurAppreciation($valeurAppreciation)
    {
        $this->valeurAppreciation = $valeurAppreciation;

        return $this;
    }

    /**
     * Get valeurAppreciation
     *
     * @return string 
     */
    public function getValeurAppreciation()
    {
        return $this->valeurAppreciation;
    }

    /**
     * Set Apprenant
     *
     * @param \Esprit\MoocBundle\Entity\Utilisateur $apprenant
     * @return Appreciation
     */
    public function setApprenant(\Esprit\MoocBundle\Entity\Utilisateur $apprenant = null)
    {
        $this->Apprenant = $apprenant;

        return $this;
    }

    /**
     * Get Apprenant
     *
     * @return \Esprit\MoocBundle\Entity\Utilisateur 
     */
    public function getApprenant()
    {
        return $this->Apprenant;
    }

    /**
     * Set idCoursAppreciation
     *
     * @param \Esprit\MoocBundle\Entity\Cours $idCoursAppreciation
     * @return Appreciation
     */
    public function setIdCoursAppreciation(\Esprit\MoocBundle\Entity\Cours $idCoursAppreciation = null)
    {
        $this->idCoursAppreciation = $idCoursAppreciation;

        return $this;
    }

    /**
     * Get idCoursAppreciation
     *
     * @return \Esprit\MoocBundle\Entity\Cours 
     */
    public function getIdCoursAppreciation()
    {
        return $this->idCoursAppreciation;
    }
    
}
