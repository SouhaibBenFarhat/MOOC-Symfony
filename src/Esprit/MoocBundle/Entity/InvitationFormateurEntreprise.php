<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Invitation_formateur_entreprise
 *
 * @author kods
 */

/**
 * InvitationFormateurEntreprise
 *
 * @ORM\Table(name="invitation_formateur_entreprise")
 * @ORM\Entity
 */
class InvitationFormateurEntreprise {
     /**
     * @var integer
     *
     * @ORM\Column(name="id_invitation_formateur__entreprise", type="integer", nullable=false)
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

    function setIdFormateur(\Esprit\MoocBundle\Entity\Utilisateur $idFormateur) {
        $this->idFormateur = $idFormateur;
    }

    function setIdEntreprise( \Esprit\MoocBundle\Entity\Utilisateur $idEntreprise) {
        $this->idEntreprise = $idEntreprise;
    }

    function setEtat($etat) {
        $this->etat = $etat;
    }


}
