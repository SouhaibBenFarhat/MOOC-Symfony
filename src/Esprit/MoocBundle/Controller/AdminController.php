<?php
namespace Esprit\MoocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminController
 *
 * @author kods
 */
class AdminController  extends Controller{
    
    
     public function espaceAdminAction(){
       $user=  $this->getUser();
         return $this->render('EspritMoocBundle:Mooc:espace_admin.html.twig',array('user'=>$user));
    
     }
    //admin
        public function listeInsEntrepriseAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $entreprises=$em->getRepository('EspritMoocBundle:Utilisateur')->findEntrepriseByEtatAttente();
        $information=$em->getRepository('EspritMoocBundle:InformationEntreprise')->findAll();
         $paginator = $this->get('knp_paginator');
         $pagination = $paginator->paginate($entreprises,$request->query->getInt('page', 1), 9);
        return $this->render('EspritMoocBundle:Mooc:liste_demande_inscription_entreprise.html.twig',array('pagination'=>$pagination,'information'=>$information));
   
      
        }
    
    public function accepterEntrepriseAction(){
        
        $em=$this->getDoctrine()->getManager();
        $req=$this->get('request');
        $id=$req->get('id');
        $entreprise=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id);
        //$entreprise->setEtatUtilisateur('accepter');
       
        $entreprise->setLocked('0');
        $em->persist($entreprise);
        $em->flush();
         return $this->redirect($this->generateUrl('admin_liste_inscri_entreprise'));
    
    }
    
    public function refuserEntrepriseAction(){
        
        $em=$this->getDoctrine()->getManager();
        $req=$this->get('request');
        $id=$req->get('id');
        var_dump($id);
        $entreprise=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id);
        $em->remove($entreprise);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_liste_inscri_entreprise'));
    
    }
    public function listeEntreprisesAction(Request $request)
    {
         $em=$this->getDoctrine()->getManager();
        $entreprises=$em->getRepository('EspritMoocBundle:Utilisateur')->findEntreprises();
        $paginator = $this->get('knp_paginator');
         $pagination = $paginator->paginate($entreprises,$request->query->getInt('page', 1), 9);
        $information=$em->getRepository('EspritMoocBundle:InformationEntreprise')->findAll();
        $id=$this->getUser()->getId();
        $requete=$this->getDoctrine()->getEntityManager()
                  ->createQuery('select i from EspritMoocBundle:InvitationFormateurEntreprise i where  i.idFormateur= :id and i.etat= :etat');
          $requete->setParameter('id', $id);
          $requete->setParameter('etat', 'en attente');
          $invitations=$requete->getResult();
        return $this->render('EspritMoocBundle:Mooc:liste_entreprises_vue_admin.html.twig',array('pagination'=>$pagination,'information'=>$information,'invitations'=>$invitations));
    }
      public function rechercherEntrepriseAction(Request $request){
       
        $req=$this->get('request');
        $em=$this->getDoctrine()->getManager();
        $entreprises=$em->getRepository('EspritMoocBundle:Utilisateur')->findEntreprises();
        $paginator = $this->get('knp_paginator');
         $pagination = $paginator->paginate($entreprises,$request->query->getInt('page', 1), 9);
         if($req->getMethod()=="POST"){
          $nom=$req->get('nom');
          $entreprises=$em->getRepository('EspritMoocBundle:Utilisateur')->findEntreprisesByNom($nom);
           $information=$em->getRepository('EspritMoocBundle:InformationEntreprise')->findAll();
       
          return $this->render('EspritMoocBundle:Mooc:recherche_entreprise.html.twig',array('pagination'=>$pagination,'information'=>$information));
    
         }
     return $this->render("EspritMoocBundle:Mooc:liste_entreprises_vue_admin.html.twig",array('pagination'=>$pagination,'information'=>$information));
        }
            
    
   public function rechercherApprenantAction(Request $request){
       
        $req=$this->get('request');
        $em=$this->getDoctrine()->getManager();
        $apprenants=$em->getRepository('EspritMoocBundle:Utilisateur')->findUserByRole('%"ROLE_APPRENANT"%');
        $paginator = $this->get('knp_paginator');
         $pagination = $paginator->paginate($apprenants,$request->query->getInt('page', 1), 9);
         if($req->getMethod()=="POST"){
          $nom=$req->get('nom');
          $apprenants=$em->getRepository('EspritMoocBundle:Utilisateur')->findApprenantByNom($nom);
        $pagination = $paginator->paginate($apprenants,$request->query->getInt('page', 1), 9);
        return $this->render('EspritMoocBundle:Mooc:recherche_apprenants.html.twig', array('pagination'=>$pagination));
          
    }
      return $this->render('EspritMoocBundle:Mooc:liste_apprenants.html.twig', array('pagination'=>$pagination));
          
    
         }
         
           public function enableEntrepriseAction($id)
    {
         $em=$this->getDoctrine()->getManager();
        $entreprise=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id);
       $entreprise->setEnabled('1');
        $em->persist($entreprise);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_liste_entrprises'));
        }
         public function disableEntrepriseAction($id)
    {
         $em=$this->getDoctrine()->getManager();
        $entreprise=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id);
       $entreprise->setEnabled('0');
        $em->persist($entreprise);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_liste_entrprises'));
        }
    
//     public function supprimerEntrepriseAction($id)
//    {
//         $em=$this->getDoctrine()->getManager();
//        $entreprise=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id);
//       $em->remove($entreprise);
//        $em->flush();
//        return $this->redirect($this->generateUrl('liste_entreprises'));
//        }
//    
     public function listeApprenantAction(Request $request)
    {
          $em=$this->getDoctrine()->getManager();
        $apprenants=$em->getRepository('EspritMoocBundle:Utilisateur')->findUserByRole('%"ROLE_APPRENANT"%');
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $apprenants, /* query NOT result */ $request->query->getInt('page', 1), 9);
        return $this->render('EspritMoocBundle:Mooc:liste_apprenants.html.twig', array('pagination'=>$pagination));
          
       
       // return $this->render('EspritMoocBundle:Mooc:liste_apprenants.html.twig',array('apprenants'=>$apprenants));
    }
//     public function supprimerApprenantAction($id)
//    {
//         $em=$this->getDoctrine()->getManager();
//        $apprenant=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id);
//       $em->remove($apprenant);
//        $em->flush();
//        return $this->redirect($this->generateUrl('admin_liste_apprenant'));
//        }
    
     public function disableApprenantAction($id)
    {
         $em=$this->getDoctrine()->getManager();
        $apprenant=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id);
        $apprenant->setEnabled('0');
        $em->persist($apprenant);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_liste_apprenant'));
        }
    public function enableApprenantAction($id)
    {
         $em=$this->getDoctrine()->getManager();
        $apprenant=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id);
        $apprenant->setEnabled('1');
        $em->persist($apprenant);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_liste_apprenant'));
        }
     public function listeFormateursAction(Request $request)
    {
         $em=$this->getDoctrine()->getManager();
        $formateurs=$em->getRepository('EspritMoocBundle:Utilisateur')->findFormateurs();
        $paginator = $this->get('knp_paginator');
         $information=$em->getRepository('EspritMoocBundle:InformationFormateur')->findAll();
        $pagination = $paginator->paginate($formateurs, /* query NOT result */ $request->query->getInt('page', 1), 9);
        return $this->render('EspritMoocBundle:Mooc:liste_formateurs_vue_admin.html.twig', array('pagination'=>$pagination,'information'=>$information));
         
         }
     public function disableFormateurAction($id)
    {
         $em=$this->getDoctrine()->getManager();
        $formateur=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id);
      $formateur->setEnabled('0');
        $em->persist($formateur);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_liste_formateur'));
        }
        
          public function enableFormateurAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $formateur=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id);
        $formateur->setEnabled('1');
        $em->persist($formateur);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_liste_formateur'));
        }
        
    
     public function rechercherFormateurAction(Request $request){
       
        $req=$this->get('request');
        $em=$this->getDoctrine()->getManager();
         $paginator = $this->get('knp_paginator');
        $formateurs=$em->getRepository('EspritMoocBundle:Utilisateur')->findUserByRole('%"ROLE_FORMATEUR"%');
         $pagination = $paginator->paginate($formateurs, /* query NOT result */ $request->query->getInt('page', 1), 9);
        if($req->getMethod()=="POST"){
          $nom=$req->get('nom');
          $formateurs=$em->getRepository('EspritMoocBundle:Utilisateur')->findFormateurByNom($nom);
           $information=$em->getRepository('EspritMoocBundle:InformationFormateur')->findAll();
       
          $pagination = $paginator->paginate($formateurs, /* query NOT result */ $request->query->getInt('page', 1), 9);
       
           return $this->render('EspritMoocBundle:Mooc:recherche_formateur_vue_admin.html.twig', array('pagination'=>$pagination,'information'=>$information));
         
         }
      return $this->render('EspritMoocBundle:Mooc:liste_formateurs_vue_admin.html.twig', array('pagination'=>$pagination,'information'=>$information));
           }
        
        
//     public function supprimerFormateurAction($id)
//    {
//         $em=$this->getDoctrine()->getManager();
//        $formateur=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id);
//       $em->remove($formateur);
//        $em->flush();
//        return $this->redirect($this->generateUrl('admin_liste_formateur'));
//        }
//        
    
        
       //Ajout membre comite
        
       public function listeMembreComiteAction()
    {
        $em=$this->getDoctrine()->getManager();
        $membres=$em->getRepository('EspritMoocBundle:Utilisateur')->findUserByRole('%"ROLE_MEMBRE_COMITE"%');
       
        return $this->render('EspritMoocBundle:Mooc:liste_membre_comite.html.twig',array('membres'=>$membres));
    }
     public function supprimerMembreComiteAction($id)
    {
         $em=$this->getDoctrine()->getManager();
        $membre=$em->getRepository('EspritMoocBundle:Utilisateur')->findOneById($id);
       $em->remove($membre);
        $em->flush();
        return $this->redirect($this->generateUrl('admin_liste_membre_comite'));
        }
        
         
}
