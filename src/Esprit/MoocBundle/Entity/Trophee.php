<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trophee
 *
 * @ORM\Table(name="trophee", indexes={@ORM\Index(name="IDX_D06A57212D44EF3F", columns={"id_cours_trophee"}), @ORM\Index(name="IDX_D06A5721FE244B36", columns={"id_apprenant_trophee"}), @ORM\Index(name="id_cours_trophee", columns={"id_cours_trophee", "id_apprenant_trophee"})})
 * @ORM\Entity
 */
class Trophee
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_trophee", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTrophee;

    /**
     * @var string
     *
     * @ORM\Column(name="chemin_trophee", type="string", length=200, nullable=false)
     */
    private $cheminTrophee;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_apprenant_trophee", referencedColumnName="id")
     * })
     */
    private $idApprenantTrophee;

    /**
     * @var \Cours
     *
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours_trophee", referencedColumnName="id_cours")
     * })
     */
    private $idCoursTrophee;



    /**
     * Get idTrophee
     *
     * @return integer 
     */
    public function getIdTrophee()
    {
        return $this->idTrophee;
    }

    /**
     * Set cheminTrophee
     *
     * @param string $cheminTrophee
     * @return Trophee
     */
    public function setCheminTrophee($cheminTrophee)
    {
        $this->cheminTrophee = $cheminTrophee;

        return $this;
    }

    /**
     * Get cheminTrophee
     *
     * @return string 
     */
    public function getCheminTrophee()
    {
        return $this->cheminTrophee;
    }

    /**
     * Set idApprenantTrophee
     *
     * @param \Esprit\MoocBundle\Entity\Utilisateur $idApprenantTrophee
     * @return Trophee
     */
    public function setIdApprenantTrophee(\Esprit\MoocBundle\Entity\Utilisateur $idApprenantTrophee = null)
    {
        $this->idApprenantTrophee = $idApprenantTrophee;

        return $this;
    }

    /**
     * Get idApprenantTrophee
     *
     * @return \Esprit\MoocBundle\Entity\Utilisateur 
     */
    public function getIdApprenantTrophee()
    {
        return $this->idApprenantTrophee;
    }

    /**
     * Set idCoursTrophee
     *
     * @param \Esprit\MoocBundle\Entity\Cours $idCoursTrophee
     * @return Trophee
     */
    public function setIdCoursTrophee(\Esprit\MoocBundle\Entity\Cours $idCoursTrophee = null)
    {
        $this->idCoursTrophee = $idCoursTrophee;

        return $this;
    }

    /**
     * Get idCoursTrophee
     *
     * @return \Esprit\MoocBundle\Entity\Cours 
     */
    public function getIdCoursTrophee()
    {
        return $this->idCoursTrophee;
    }
}
