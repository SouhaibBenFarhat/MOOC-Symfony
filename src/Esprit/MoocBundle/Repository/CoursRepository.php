<?php

namespace Esprit\MoocBundle\Repository;

/**
 * Description of CoursRepository
 *
 * @author souhaib
 */
class CoursRepository extends \Doctrine\ORM\EntityRepository {

    function findCours($titre) {
        $req = $this->getEntityManager()->createQuery("select c from EspritMoocBundle:Cours c where c.titreCours LIKE :titreCours")
                ->setParameter('titreCours', '%' . $titre . '%');
        return $req->getResult();
    }

}
