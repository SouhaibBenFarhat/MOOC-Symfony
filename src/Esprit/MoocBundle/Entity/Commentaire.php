<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="IDX_67F068BCD4706035", columns={"id_cours_commentaire"}), @ORM\Index(name="IDX_67F068BCD2E32CA", columns={"id_apprenant_commentaire"}), @ORM\Index(name="id_apprenant_commentaire", columns={"id_apprenant_commentaire", "id_cours_commentaire"})})
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_commentaire", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCommentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="texte_commentaire", type="string", length=200, nullable=false)
     */
    private $texteCommentaire;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_apprenant_commentaire", referencedColumnName="id")
     * })
     */
    private $idApprenantCommentaire;

    /**
     * @var \Cours
     *
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours_commentaire", referencedColumnName="id_cours")
     * })
     */
    private $idCoursCommentaire;



    /**
     * Get idCommentaire
     *
     * @return integer 
     */
    public function getIdCommentaire()
    {
        return $this->idCommentaire;
    }

    /**
     * Set texteCommentaire
     *
     * @param string $texteCommentaire
     * @return Commentaire
     */
    public function setTexteCommentaire($texteCommentaire)
    {
        $this->texteCommentaire = $texteCommentaire;

        return $this;
    }

    /**
     * Get texteCommentaire
     *
     * @return string 
     */
    public function getTexteCommentaire()
    {
        return $this->texteCommentaire;
    }

    /**
     * Set idApprenantCommentaire
     *
     * @param \Esprit\MoocBundle\Entity\Utilisateur $idApprenantCommentaire
     * @return Commentaire
     */
    public function setIdApprenantCommentaire(\Esprit\MoocBundle\Entity\Utilisateur $idApprenantCommentaire = null)
    {
        $this->idApprenantCommentaire = $idApprenantCommentaire;

        return $this;
    }

    /**
     * Get idApprenantCommentaire
     *
     * @return \Esprit\MoocBundle\Entity\Utilisateur 
     */
    public function getIdApprenantCommentaire()
    {
        return $this->idApprenantCommentaire;
    }

    /**
     * Set idCoursCommentaire
     *
     * @param \Esprit\MoocBundle\Entity\Cours $idCoursCommentaire
     * @return Commentaire
     */
    public function setIdCoursCommentaire(\Esprit\MoocBundle\Entity\Cours $idCoursCommentaire = null)
    {
        $this->idCoursCommentaire = $idCoursCommentaire;

        return $this;
    }

    /**
     * Get idCoursCommentaire
     *
     * @return \Esprit\MoocBundle\Entity\Cours 
     */
    public function getIdCoursCommentaire()
    {
        return $this->idCoursCommentaire;
    }
}
