<?php

namespace Esprit\MoocBundle\Repository;

/**
 * Description of DiscussionRepository
 *
 * @author souhaib
 */
class DiscussionRepository extends \Doctrine\ORM\EntityRepository {

    function findDiscussion($idUser, $idDestination) {


        $requete = $this->getEntityManager()->createQuery('select d from EspritMoocBundle:Discussion d where (d.idUtilisateurSource= :param1 and d.idUtilisateurDestination=:param2) or (d.idUtilisateurSource= :param2 and d.idUtilisateurDestination= :param1)');
        $requete->setParameter('param1', $idUser);
        $requete->setParameter('param2', $idDestination);

        return $requete->getResult();
    }

    function findMesDiscussion($idUser) {


        $requete = $this->getEntityManager()->createQuery('select d from EspritMoocBundle:Discussion d where d.idUtilisateurSource= :param1 or d.idUtilisateurDestination= :param1 ORDER BY d.dateMiseAJour desc');
        $requete->setParameter('param1', $idUser);
        return $requete->getResult();
    }

}
