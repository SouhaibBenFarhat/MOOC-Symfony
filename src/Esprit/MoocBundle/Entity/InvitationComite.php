<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InvitationComite
 *
 * @ORM\Table(name="invitation_comite", indexes={@ORM\Index(name="IDX_90041155264B8AD5", columns={"id_formateur_invitation_comite"})})
 * @ORM\Entity
 */
class InvitationComite
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_invitation_comite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInvitationComite;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_invitation_comite", type="string", length=50, nullable=false)
     */
    private $etatInvitationComite;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_formateur_invitation_comite", referencedColumnName="id")
     * })
     */
    private $idFormateurInvitationComite;



    /**
     * Get idInvitationComite
     *
     * @return integer 
     */
    public function getIdInvitationComite()
    {
        return $this->idInvitationComite;
    }

    /**
     * Set etatInvitationComite
     *
     * @param string $etatInvitationComite
     * @return InvitationComite
     */
    public function setEtatInvitationComite($etatInvitationComite)
    {
        $this->etatInvitationComite = $etatInvitationComite;

        return $this;
    }

    /**
     * Get etatInvitationComite
     *
     * @return string 
     */
    public function getEtatInvitationComite()
    {
        return $this->etatInvitationComite;
    }

    /**
     * Set idFormateurInvitationComite
     *
     * @param \Esprit\MoocBundle\Entity\Utilisateur $idFormateurInvitationComite
     * @return InvitationComite
     */
    public function setIdFormateurInvitationComite(\Esprit\MoocBundle\Entity\Utilisateur $idFormateurInvitationComite = null)
    {
        $this->idFormateurInvitationComite = $idFormateurInvitationComite;

        return $this;
    }

    /**
     * Get idFormateurInvitationComite
     *
     * @return \Esprit\MoocBundle\Entity\Utilisateur 
     */
    public function getIdFormateurInvitationComite()
    {
        return $this->idFormateurInvitationComite;
    }
}
