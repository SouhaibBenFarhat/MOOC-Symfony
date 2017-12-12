<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of InvitationEntrepriseFormateur
 *
 * @author kods
 */

/**
 * InvitationEntrepriseFormateur 
 *
 * @ORM\Table(name="invitation_entreprise_formateur")
 * @ORM\Entity
 */
class InvitationEntrepriseFormateur {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_invitation_entreprise_formateur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_formateur", referencedColumnName="id")
     * })
     */
    private $idFormateur;
    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_entreprise", referencedColumnName="id")
     * })
     */
    private $idEntreprise;
    
    /**
     *
     * @ORM\Column(name="etat_invitation", type="string", length=200, nullable=false)
     */
    private $etat;
    
    function getId() {
        return $this->id;
    }

    function getIdFormateur() {
        return $this->idFormateur;
    }

    function getIdEntreprise() {
        return $this->idEntreprise;
    }

    function getEtat() {
        return $this->etat;
    }

    function setIdFormateur($idFormateur) {
        $this->idFormateur = $idFormateur;
    }

    function setIdEntreprise($idEntreprise) {
        $this->idEntreprise = $idEntreprise;
    }

    function setEtat($etat) {
        $this->etat = $etat;
    }

}
