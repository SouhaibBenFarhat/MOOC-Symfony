<?php

namespace Esprit\MoocBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * userphoto
 *
 * @ORM\Table(name="userPhoto")
 * @ORM\Entity
 */
class UserPhoto {

    /**
     * @var integer
     *
     * @ORM\Column(name="id_photo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=500, nullable=false)
     */
    private $path;

    function getId() {
        return $this->id;
    }

    function getPath() {
        return $this->path;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPath($path) {
        $this->path = $path;
    }


}
