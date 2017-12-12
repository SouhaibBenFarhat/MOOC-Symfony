<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Bibliotheque
 *
 * @ORM\Table(name="bibliotheque",uniqueConstraints={@ORM\UniqueConstraint(name="id_apprenant_bibliotheque", columns={"id_apprenant_bibliotheque", "id_cours_bibliotheque"})}, indexes={@ORM\Index(name="IDX_4690D34DFF9CD91E", columns={"id_apprenant_bibliotheque"}), @ORM\Index(name="IDX_4690D34DD24768C1", columns={"id_cours_bibliotheque"}), @ORM\Index(name="id_cours_bibliotheque", columns={"id_cours_bibliotheque", "id_apprenant_bibliotheque"})})
 * @ORM\Entity
 *  @UniqueEntity(fields={"id_cours_bibliotheque","id_apprenant_bibliotheque"}, message="ce cours déja ajouté")

 */
class Bibliotheque
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_bibliotheque", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idBibliotheque;

    /**
     * @var \Cours
     *
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours_bibliotheque", referencedColumnName="id_cours")
     * })
     */
    private $idCoursBibliotheque;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     *
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_apprenant_bibliotheque", referencedColumnName="id")
     * })
     */
    private $idApprenantBibliotheque;
    function getIdBibliotheque() {
        return $this->idBibliotheque;
    }

    function getIdCoursBibliotheque() {
        return $this->idCoursBibliotheque;
    }

    function getIdApprenantBibliotheque() {
        return $this->idApprenantBibliotheque;
    }

    function setIdBibliotheque($idBibliotheque) {
        $this->idBibliotheque = $idBibliotheque;
    }

    function setIdCoursBibliotheque(\Esprit\MoocBundle\Entity\Cours $idCoursBibliotheque) {
        $this->idCoursBibliotheque = $idCoursBibliotheque;
    }

    function setIdApprenantBibliotheque(\Esprit\MoocBundle\Entity\Utilisateur $idApprenantBibliotheque) {
        $this->idApprenantBibliotheque = $idApprenantBibliotheque;
    }



}
