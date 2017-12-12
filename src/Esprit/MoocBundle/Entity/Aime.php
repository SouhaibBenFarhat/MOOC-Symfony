<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * aime
 *
 * @ORM\Table(name="Aime")
 * @ORM\Entity
 */
class Aime {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_aime", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Sujet
     *
     * @ORM\ManyToOne(targetEntity="Sujet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sujet_aime" , referencedColumnName="id_sujet")
     * })
     */
    private $idSujetAime;

    /**
     * @var \Cours
     *
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours_aime" , referencedColumnName="id_cours")
     * })
     */
    private $idCoursAime;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur_aime", referencedColumnName="id")
     * })
     */
    private $idUtilisateurAime;

    function getId() {
        return $this->id;
    }

    function getIdSujetAime() {
        return $this->idSujetAime;
    }

    function getIdUtilisateurAime() {
        return $this->idUtilisateurAime;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdSujetAime(\Esprit\MoocBundle\Entity\Sujet $idSujetAime) {
        $this->idSujetAime = $idSujetAime;
    }

    function setIdUtilisateurAime(\Esprit\MoocBundle\Entity\Utilisateur $idUtilisateurAime) {
        $this->idUtilisateurAime = $idUtilisateurAime;
    }

    function getIdCoursAime() {
        return $this->idCoursAime;
    }

    function setIdCoursAime(\Esprit\MoocBundle\Entity\Cours $idCoursAime) {
        $this->idCoursAime = $idCoursAime;
    }

}
