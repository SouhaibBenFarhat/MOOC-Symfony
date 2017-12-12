<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * aime
 *
 * @ORM\Table(name="Progression")
 * @ORM\Entity
 */
class Progression {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_progression", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProgression;

    /**
     * @var \Cours
     *
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours_progression" , referencedColumnName="id_cours")
     * })
     */
    private $idCoursProgression;

    /**
     * @var \Chapitre
     *
     * @ORM\ManyToOne(targetEntity="Chapitre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_chapitre_progression" , referencedColumnName="id_chapitre")
     * })
     */
    private $idChapitreProgression;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur_pogression", referencedColumnName="id")
     * })
     */
    private $idUtilisateurProgression;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_progression", type="datetime" ,nullable=false)
     */
    private $dateProgression;

    /**
     * @var string
     *
     * @ORM\Column(name="type_progression", type="string" ,nullable=true)
     */
    private $typeProgression;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_progression", type="string" ,nullable=true)
     */
    private $etatProgression;

    function getIdProgression() {
        return $this->idProgression;
    }

    function getIdCoursProgression() {
        return $this->idCoursProgression;
    }

    function getIdChapitreProgression() {
        return $this->idChapitreProgression;
    }

    function getIdUtilisateurProgression() {
        return $this->idUtilisateurProgression;
    }

    function setIdProgression($idProgression) {
        $this->idProgression = $idProgression;
    }

    function setIdCoursProgression(\Esprit\MoocBundle\Entity\Cours $idCoursProgression) {
        $this->idCoursProgression = $idCoursProgression;
    }

    function setIdChapitreProgression(\Esprit\MoocBundle\Entity\Chapitre $idChapitreProgression) {
        $this->idChapitreProgression = $idChapitreProgression;
    }

    function setIdUtilisateurProgression(\Esprit\MoocBundle\Entity\Utilisateur $idUtilisateurProgression) {
        $this->idUtilisateurProgression = $idUtilisateurProgression;
    }

    function getDateProgression() {
        return $this->dateProgression;
    }

    function setDateProgression(\DateTime $dateProgression) {
        $this->dateProgression = $dateProgression;
    }

    function getTypeProgression() {
        return $this->typeProgression;
    }

    function setTypeProgression($typeProgression) {
        $this->typeProgression = $typeProgression;
    }

    function getEtatProgression() {
        return $this->etatProgression;
    }

    function setEtatProgression($etatProgression) {
        $this->etatProgression = $etatProgression;
    }

}
