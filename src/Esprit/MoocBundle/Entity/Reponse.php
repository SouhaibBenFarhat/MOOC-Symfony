<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse", indexes={@ORM\Index(name="IDX_5FB6DEC7B2E05E0B", columns={"id_question_reponse"})})
 * @ORM\Entity
 */
class Reponse
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_reponse", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReponse;

    /**
     * @var string
     *
     * @ORM\Column(name="texte_reponse", type="string", length=200, nullable=false)
     */
    private $texteReponse;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="etat_reponse", type="string", length=10, nullable=false)
     */
    private $etatReponse;

    /**
     * @var \Question
     *
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_question_reponse", referencedColumnName="id_question")
     * })
     */
    private $idQuestionReponse;



    /**
     * Get idReponse
     *
     * @return integer 
     */
    public function getIdReponse()
    {
        return $this->idReponse;
    }

    /**
     * Set texteReponse
     *
     * @param string $texteReponse
     * @return Reponse
     */
    public function setTexteReponse($texteReponse)
    {
        $this->texteReponse = $texteReponse;

        return $this;
    }

    /**
     * Get texteReponse
     *
     * @return string 
     */
    public function getTexteReponse()
    {
        return $this->texteReponse;
    }

    /**
     * Set idQuestionReponse
     *
     * @param \Esprit\MoocBundle\Entity\Question $idQuestionReponse
     * @return Reponse
     */
    public function setIdQuestionReponse(\Esprit\MoocBundle\Entity\Question $idQuestionReponse = null)
    {
        $this->idQuestionReponse = $idQuestionReponse;

        return $this;
    }

    /**
     * Get idQuestionReponse
     *
     * @return \Esprit\MoocBundle\Entity\Question 
     */
    public function getIdQuestionReponse()
    {
        return $this->idQuestionReponse;
    }
    function getEtatReponse() {
        return $this->etatReponse;
    }

    function setEtatReponse($etatReponse) {
        $this->etatReponse = $etatReponse;
    }


}
