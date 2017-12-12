<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cours
 *
 * @ORM\Table(name="sexe")
 *  @ORM\Entity
 */
class Sexe {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sexe", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSexe;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_sexe", type="string", length=200, nullable=false)
     */
    private $nomSexe;

    function getIdSexe() {
        return $this->idSexe;
    }

    function getNomSexe() {
        return $this->nomSexe;
    }

    function setIdSexe($idSexe) {
        $this->idSexe = $idSexe;
    }

    function setNomSexe($nomSexe) {
        $this->nomSexe = $nomSexe;
    }

    public function __toString() {
        return $this->nomSexe;
    }

}
