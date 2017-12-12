<?php

namespace Esprit\MoocBundle\Repository;

/**
 * Description of CoursRepository
 *
 * @author souhaib
 */
class ForumRepository extends \Doctrine\ORM\EntityRepository {

    function findForum($nomForum) {
        $req = $this->getEntityManager()->createQuery("select c from EspritMoocBundle:Forum c where c.nomForum LIKE :nomForum")
                ->setParameter('nomForum', '%' . $nomForum . '%');
        return $req->getResult();
    }


}
