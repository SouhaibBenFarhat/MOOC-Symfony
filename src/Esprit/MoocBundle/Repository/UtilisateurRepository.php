<?php

namespace Esprit\MoocBundle\Repository;


/**
 * Description of UtilisateurRepository
 *
 * @author kods
 */
class UtilisateurRepository extends \Doctrine\ORM\EntityRepository{
    
    
    
    //partie Admin
    
    function findUserByRole($role){
       $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT u FROM EspritMoocBundle:Utilisateur u WHERE u.roles LIKE :role and u.locked= :locked'
                        )->setParameter('role', $role)
                         ->setParameter('locked', '0');

        return $query->getResult();
    }
    
     function findEntrepriseByEtatAttente(){
        $requete=$this->getEntityManager()->createQuery('select e from EspritMoocBundle:Utilisateur e where e.roles LIKE :role and e.locked= :locked');
        $requete->setParameter('role','%"ROLE_ENTREPRISE"%');
        $requete->setParameter('locked','1');
        
        return $requete->getResult();
    }
   
    
    function findEntreprises(){
        $requete=$this->getEntityManager()->createQuery('select e from EspritMoocBundle:Utilisateur e where e.roles LIKE :role and e.locked= :locked');
        $requete->setParameter('role','%"ROLE_ENTREPRISE"%');
        $requete->setParameter('locked','0');
        
        return $requete->getResult();
    }
    
    function findApprenantByNom($nom){
        $requete=$this->getEntityManager()->createQuery('select a from EspritMoocBundle:Utilisateur a where a.roles LIKE :role and a.username LIKE :username');
        $requete->setParameter('role','%"ROLE_APPRENANT"%');
        $requete->setParameter('username','%'.$nom.'%');
        
        return $requete->getResult();
    }
    
    function findFormateurByCritere($critere){
        $requete=$this->getEntityManager()->createQuery('select f from EspritMoocBundle:Utilisateur f where f.roles LIKE :role and (e.username LIKE :critere or f.specialite LIKE :critere and f.locked= :locked');
        $requete->setParameter('role','%"ROLE_FORMATEUR"%');
        $requete->setParameter('locked','0');
        $requete->setParameter('critere','%'.$critere.'%');
        
        return $requete->getResult();
    }
    
     function findEntreprisesByNom($nom){
        $requete=$this->getEntityManager()->createQuery('select e from EspritMoocBundle:Utilisateur e where e.roles LIKE :role and e.username LIKE :nom and e.locked= :locked');
        $requete->setParameter('role','%"ROLE_ENTREPRISE"%');
        $requete->setParameter('locked','0');
        $requete->setParameter('nom','%'.$nom.'%');
        
        return $requete->getResult();
    }
    
    function findMembreComiteByNom($nom){
        $requete=$this->getEntityManager()->createQuery('select m from EspritMoocBundle:Utilisateur m where m.roles LIKE :role and m.username LIKE :nom');
        $requete->setParameter('type','%"ROLE_COMITE"%');
        $requete->setParameter('nom','%'.$nom.'%');
        
        return $requete->getResult();
    }
    
    function findFormateurs(){
        $requete=$this->getEntityManager()->createQuery('select f from EspritMoocBundle:Utilisateur f where f.roles LIKE :role and f.locked= :locked');
        $requete->setParameter('role','%"ROLE_FORMATEUR"%');
        
        $requete->setParameter('locked','0');
        
        return $requete->getResult();
    }
     function findFormateurByNom($nom){
        $requete=$this->getEntityManager()->createQuery('select f from EspritMoocBundle:Utilisateur f where f.roles LIKE :role and f.username LIKE :nom and f.locked= :locked');
        $requete->setParameter('role','%"ROLE_FORMATEUR"%');
        $requete->setParameter('locked','0');
        $requete->setParameter('nom','%'.$nom.'%');
        
        return $requete->getResult();
    }
    function findMesFormateurByNom($id,$nom){
        $requete=$this->getEntityManager()->createQuery('select f from EspritMoocBundle:Utilisateur f where f.roles LIKE :role and f.username LIKE :nom and f.locked= :locked and f.idEntrepriseUtlisateur= :idEntreprise');
        $requete->setParameter('role','%"ROLE_FORMATEUR"%');
        $requete->setParameter('locked','0');
        $requete->setParameter('nom','%'.$nom.'%');
        $requete->setParameter('idEntreprise',$id);
        return $requete->getResult();
    }
     //concerned by memebre_comite
     function findFormateursByEtatAttente(){
        $requete=$this->getEntityManager()->createQuery('select f from EspritMoocBundle:Utilisateur f where f.roles LIKE :role and f.locked= :locked');
        $requete->setParameter('role','%"ROLE_FORMATEUR"%');
        $requete->setParameter('locked','1');
        
        return $requete->getResult();
    }
    
    //partie Entreprise
    
    function findFormateursByEntreprise($id){
        $requete=$this->getEntityManager()->createQuery('select f from EspritMoocBundle:Utilisateur f where f.roles LIKE :role and f.idEntrepriseUtlisateur= :id');
        $requete->setParameter('role','%"ROLE_FORMATEUR"%');
        $requete->setParameter('id',$id);
        return $requete->getResult();
    }
    
      function findAutreFormateursByEntreprise($id){
        $requete=$this->getEntityManager()->createQuery('select f from EspritMoocBundle:Utilisateur f where f.idEntrepriseUtlisateur != :id or f.idEntrepriseUtlisateur is NULL and f.locked= :locked and f.roles LIKE :role');
        $requete->setParameter('role','%"ROLE_FORMATEUR"%');
        $requete->setParameter('locked','0');
        $requete->setParameter('id',$id);    
        
        return $requete->getResult();
    }
    
    
}
