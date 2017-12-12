<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QuizzFinal
 *
 * @ORM\Table(name="quizz_final", indexes={@ORM\Index(name="IDX_162C5638A5AC5EB1", columns={"id_cours_quizz_final"})})
 * @ORM\Entity
 */
class QuizzFinal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_quizz_final", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idQuizzFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_quizz_final", type="string", length=20, nullable=false)
     */
    private $titreQuizzFinal;

    /**
     * @var \Cours
     *
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cours_quizz_final", referencedColumnName="id_cours")
     * })
     */
    private $idCoursQuizzFinal;



    /**
     * Get idQuizzFinal
     *
     * @return integer 
     */
    public function getIdQuizzFinal()
    {
        return $this->idQuizzFinal;
    }

    /**
     * Set titreQuizzFinal
     *
     * @param string $titreQuizzFinal
     * @return QuizzFinal
     */
    public function setTitreQuizzFinal($titreQuizzFinal)
    {
        $this->titreQuizzFinal = $titreQuizzFinal;

        return $this;
    }

    /**
     * Get titreQuizzFinal
     *
     * @return string 
     */
    public function getTitreQuizzFinal()
    {
        return $this->titreQuizzFinal;
    }

    /**
     * Set idCoursQuizzFinal
     *
     * @param \Esprit\MoocBundle\Entity\Cours $idCoursQuizzFinal
     * @return QuizzFinal
     */
    public function setIdCoursQuizzFinal(\Esprit\MoocBundle\Entity\Cours $idCoursQuizzFinal = null)
    {
        $this->idCoursQuizzFinal = $idCoursQuizzFinal;

        return $this;
    }

    /**
     * Get idCoursQuizzFinal
     *
     * @return \Esprit\MoocBundle\Entity\Cours 
     */
    public function getIdCoursQuizzFinal()
    {
        return $this->idCoursQuizzFinal;
    }
}
