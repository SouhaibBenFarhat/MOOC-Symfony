<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * aime
 *
 * @ORM\Table(name="SuiviDiscipline")
 * @ORM\Entity
 */
class SuiviDiscipline {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_suivi_discipline", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSuiviDiscipline;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_suivi_discipline", type="datetime",  nullable=true)
     */
    private $dateSuiviDiscipline;

    /**
     * @var \Discipline
     *
     * @ORM\ManyToOne(targetEntity="Discipline")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_discipline_suivi" , referencedColumnName="id_discipline")
     * })
     */
    private $idDisciplineSuivi;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur_suivi", referencedColumnName="id")
     * })
     */
    private $idUtilisateurSuivi;

    function getIdSuiviDiscipline() {
        return $this->idSuiviDiscipline;
    }

    function getIdDisciplineSuivi() {
        return $this->idDisciplineSuivi;
    }

    function getIdUtilisateurSuivi() {
        return $this->idUtilisateurSuivi;
    }

    function setIdSuiviDiscipline($idSuiviDiscipline) {
        $this->idSuiviDiscipline = $idSuiviDiscipline;
    }

    function setIdDisciplineSuivi(\Esprit\MoocBundle\Entity\Discipline $idDisciplineSuivi) {
        $this->idDisciplineSuivi = $idDisciplineSuivi;
    }

    function setIdUtilisateurSuivi(\Esprit\MoocBundle\Entity\Utilisateur $idUtilisateurSuivi) {
        $this->idUtilisateurSuivi = $idUtilisateurSuivi;
    }

    function getDateSuiviDiscipline() {
        return $this->dateSuiviDiscipline;
    }

    function setDateSuiviDiscipline(\DateTime$dateSuiviDiscipline) {
        $this->dateSuiviDiscipline = $dateSuiviDiscipline;
    }

}
