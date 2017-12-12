<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application
 *
 * @ORM\Table("application")
 * @ORM\Entity
 */
class Application
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_application", type="string", length=200, nullable=false)
     */
    private $nomApplication;

    /**
     * @var string
     *
     * @ORM\Column(name="description_application", type="text", nullable=false)
     */
    private $descriptionApplication;

      /**
     * @var string
     *
     * @ORM\Column(name="image1", type="text", nullable=false)
     */
    private $image1;

      /**
     * @var string
     *
     * @ORM\Column(name="image2", type="text", nullable=false)
     */
    private $image2;

      /**
     * @var string
     *
     * @ORM\Column(name="image3", type="text", nullable=false)
     */
    private $image3;

      /**
     * @var string
     *
     * @ORM\Column(name="etat", type="text", nullable=false)
     */
    private $etat;

    
    /**
     * @var \Discipline
     *
     * @ORM\ManyToOne(targetEntity="Discipline")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_discipline", referencedColumnName="id_discipline")
     * })
     */
    private $idDiscipline;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_apprenant", referencedColumnName="id")
     * })
     */
    private $idApprenant;
}
