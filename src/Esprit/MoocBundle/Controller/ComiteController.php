<?php
namespace Esprit\MoocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Description of ComiteController
 *
 * @author kods
 */
class ComiteController extends Controller{
  
    
    public function espaceMembreComiteAction(){
       $user=  $this->getUser();
         return $this->render('EspritMoocBundle:Mooc:espace_membre_comite.html.twig',array('user'=>$user));
    
     }
    
    //partie comite
    
    public function listeDemandeInscriFomrateurAction()
    {
        $em=$this->getDoctrine()->getManager();
        $formateurs=$em->getRepository('EspritMoocBundle:Utilisateur')->findFormateursByEtatAttente();
        return $this->render('EspritMoocBundle:Mooc:liste_demande_inscription_formateur_vue_comite.html.twig',array('formateurs'=>$formateurs));
    }
    
     public function accepterFormateurAction($id){
        
        $em=$this->getDoctrine()->getManager();
        $formateur=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id);
        $formateur->setLocked('0');
        $em->persist($formateur);
        $em->flush();
         return $this->redirect($this->generateUrl('comite_demande_inscr_formateur'));
    
    }
     public function refuserFormateurAction($id){
        
        $em=$this->getDoctrine()->getManager();
        $formateur=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id);
        $em->remove($formateur);
        $em->flush();
        return $this->redirect($this->generateUrl('comite_demande_inscr_formateur'));
    
    }
    
    public function listeCoursAValiderAction(){
        $requete=$this->getDoctrine()
                  ->getEntityManager()
                  ->createQuery('select c from EspritMoocBundle:Cours c where c.etatCours= :etat')
                  ->setParameter('etat', 'en attente');
        $cours=$requete->getResult();
//  var_dump($cours);
         return $this->render('EspritMoocBundle:Mooc:liste_cours_a_valider_vue_comite.html.twig',array('cours'=>$cours));

    }
}
