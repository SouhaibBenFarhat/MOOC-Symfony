<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * aime
 *
 * @ORM\Table(name="Suivie")
 * @ORM\Entity
 */
class Suivie {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_suivie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_suivie", type="datetime" ,nullable=false)
     */
    private $dateSuivie;

    /**
     * @var \Cours
     *
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours_suivie" , referencedColumnName="id_cours")
     * })
     */
    private $idCoursSuivie;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur_suivie", referencedColumnName="id")
     * })
     */
    private $idUtilisateurSuivie;

    function getId() {
        return $this->id;
    }

    function getDateSuivie() {
        return $this->dateSuivie;
    }

    function getIdCoursSuivie() {
        return $this->idCoursSuivie;
    }

    function getIdUtilisateurSuivie() {
        return $this->idUtilisateurSuivie;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDateSuivie(\DateTime $dateSuivie) {
        $this->dateSuivie = $dateSuivie;
    }

    function setIdCoursSuivie(\Esprit\MoocBundle\Entity\Cours $idCoursSuivie) {
        $this->idCoursSuivie = $idCoursSuivie;
    }

    function setIdUtilisateurSuivie(\Esprit\MoocBundle\Entity\Utilisateur $idUtilisateurSuivie) {
        $this->idUtilisateurSuivie = $idUtilisateurSuivie;
    }

}
