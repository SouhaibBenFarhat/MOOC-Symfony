<?php

namespace Esprit\MoocBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Esprit\MoocBundle\Entity\Sujet;
use Esprit\MoocBundle\Entity\Forum;
use Esprit\MoocBundle\Entity\Message;
use Esprit\MoocBundle\Repository\ForumRepository;
use Esprit\MoocBundle\Repository\DiscussionRepository;
use Esprit\MoocBundle\Entity\Notification;
use Esprit\MoocBundle\Entity\Aime;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormateurController
 *
 * @author souhaib
 */
class ForumController extends Controller {

    public function nosForumAction(\Symfony\Component\HttpFoundation\Request $request) {
        $em = $this->getDoctrine()->getManager();
        $forum = $em->getRepository("EspritMoocBundle:Forum")->findBy(array(), array('nombreVue' => 'desc'));
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($forum, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */);
        return $this->render("EspritMoocBundle:Mooc:Forum/listForum.html.twig", array('forums' => $pagination));
    }

    public function forumAction($idDiscipline) {
        $em = $this->getDoctrine()->getManager();
        $forum = $em->getRepository("EspritMoocBundle:Forum")->findOneByIdDiscipline($idDiscipline);
        $sujet = $em->getRepository("EspritMoocBundle:Sujet")->findByIdForum($forum);
        $forum->setNombreVue($forum->getNombreVue() + 1);
        $em->persist($forum);
        $em->flush();
        return $this->render("EspritMoocBundle:Mooc:Forum/forum.html.twig", array('forum' => $forum, 'sujets' => $sujet));
    }

    public function sujetAction($idForum) {
        $requete = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $forum = $em->getRepository("EspritMoocBundle:Forum")->findOneById($idForum);
        $idDiscipline = $em->getRepository("EspritMoocBundle:Discipline")->findOneByIdDiscipline($forum->getIdDiscipline());
        if ($requete->getMethod() === "POST") {
            $sujet = new Sujet();
            $titreSujet = $requete->get('titreSujet');
            $sousTitreSujet = $requete->get('sousTitreSujet');
            $descriptionSujet = $requete->get('descriptionSujet');
            $sujet->setDatePublicationSujet(new \DateTime());
            $sujet->setDescriptionSujet($descriptionSujet);
            $sujet->setTitreSujet($titreSujet);
            $sujet->setSousTitreSujet($sousTitreSujet);
            $sujet->setIdApprenant($user);
            $sujet->setIdForum($forum);
            $forum->setNombreSujet($forum->getNombreSujet() + 1);
            $forum->setLastSujet($sujet);
            $em->persist($sujet);
            $em->persist($forum);
            $em->flush();

            return $this->redirectToRoute('forum', array('idDiscipline' => $idDiscipline->getIdDiscipline()));
        }
        return $this->redirectToRoute('forum', array('idDiscipline' => $idDiscipline->getIdDiscipline()));
    }

    public function afficherSujetAction(\Symfony\Component\HttpFoundation\Request $request, $idSujet) {
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository("EspritMoocBundle:Sujet")->findOneById($idSujet);
        $messages = $em->getRepository("EspritMoocBundle:Message")->findByIdSujetMessage($idSujet);
        $aime = $em->getRepository("EspritMoocBundle:Aime")->findBy(array('idUtilisateurAime' => $this->getUser(), 'idSujetAime' => $sujet));
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $messages, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10 /* limit per page */
        );
        return $this->render("EspritMoocBundle:Mooc:Forum/sujet.html.twig", array('sujet' => $sujet, 'messages' => $pagination, 'aime' => $aime));
    }

    public function ajouterMessageAction($idSujet) {
        $requete = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository("EspritMoocBundle:Sujet")->findOneById($idSujet);
        $proprietaire = $em->getRepository("EspritMoocBundle:Utilisateur")->findOneById($sujet->getIdApprenant());

        if ($requete->getMethod() === "POST") {
            $message = new Message();
            $notification = new Notification();
            $contenuMessage = $requete->get('contenuMessage');
            $titreMessage = $requete->get('titreMessage');
            $message->setContenuMessage($contenuMessage);
            $message->setDatePublicationMessage(new \DateTime());
            $message->setIdSujetMessage($sujet);
            $message->setIdUtilisateurMessage($this->getUser());
            $message->setTitreMessage($titreMessage);
            $sujet->setNombreMessage($sujet->getNombreMessage() + 1);
            $sujet->setLastPoster($this->getUser());
            $sujet->setLastPoste($message);
            $notification->setIdUtilisateurNotification($this->getUser());
            $notification->setIdSujetNotification($sujet);
            $notification->setEtatNotification(0);
            $notification->setDateNotification(new \DateTime());
            $notification->setIdProprietaireNotification($proprietaire);
            $em->persist($notification);

            $em->persist($message);

            $em->persist($sujet);
            $em->flush();
            return $this->redirectToRoute('afficher_sujet', array('idSujet' => $idSujet));
        }
        return $this->redirectToRoute('afficher_sujet', array('idSujet' => $idSujet));
    }

    public function mesSujetsAction(\Symfony\Component\HttpFoundation\Request $request) {
        $em = $this->getDoctrine()->getManager();
        $forums = $em->getRepository("EspritMoocBundle:Forum")->findAll();
        $user = $this->getUser();
        $notifications = $em->getRepository("EspritMoocBundle:Notification")->findBy(array('idProprietaireNotification' => $user, 'etatNotification' => 0), array('dateNotification' => 'desc'));

        $sujet = $em->getRepository("EspritMoocBundle:Sujet")->findBy(array('idApprenant' => $user), array('datePublicationSujet' => 'asc'));
        $messages = $em->getRepository("EspritMoocBundle:Message")->findByIdSujetMessage($sujet);
//        var_dump($messages);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($sujet, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 20 /* limit per page */);
        return $this->render("EspritMoocBundle:Mooc:Forum/mes_sujets.html.twig", array('sujets' => $pagination, 'forums' => $forums, 'notifications' => $notifications, 'messages' => $messages));
    }

    public function publierSujetListAction() {
        $requete = $this->getRequest();
        if ($requete->getMethod() === "POST") {
            $sujet = new Sujet();
            $user = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $idForum = $requete->get('idForum');
            $forum = $em->getRepository("EspritMoocBundle:Forum")->findOneById($idForum);
            $titreSujet = $requete->get('titreSujet');
            $sousTitreSujet = $requete->get('sousTitreSujet');
            $descriptionSujet = $requete->get('descriptionSujet');
            $sujet->setDatePublicationSujet(new \DateTime());
            $sujet->setDescriptionSujet($descriptionSujet);
            $sujet->setIdApprenant($user);
            $sujet->setIdForum($forum);
            $sujet->setSousTitreSujet($sousTitreSujet);
            $sujet->setTitreSujet($titreSujet);
            $forum->setNombreSujet($forum->getNombreSujet() + 1);
            $em->persist($sujet);
            $em->persist($forum);
            $em->flush();
            return $this->redirectToRoute('mes_sujets');
        }
        return $this->redirectToRoute('mes_sujets');
    }

    public function chercherForumAction() {
        $requete = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $nomForum = $requete->get('nomForum');
        $forum = $em->getRepository("EspritMoocBundle:Forum")->findForum($nomForum);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($forum, /* query NOT result */ $requete->query->getInt('page', 1)/* page number */, 6/* limit per page */);
        return $this->render('EspritMoocBundle:Mooc:Forum/listForum.html.twig', array('forums' => $pagination));
    }

    public function supprimerSujetAction($idSujet) {
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository("EspritMoocBundle:Sujet")->findOneById($idSujet);
        $forum = $em->getRepository("EspritMoocBundle:Forum")->findOneById($sujet->getIdForum());
        $forum->setNombreSujet($forum->getNombreSujet() - 1);
        $lastSujet = $em->getRepository("EspritMoocBundle:Sujet")->findOneBy(array('idForum' => $forum), array('datePublicationSujet' => 'asc'), 1);
        $forum->setLastSujet($lastSujet);
        $em->persist($forum);
        $em->remove($sujet);
        $em->flush();
        return $this->redirectToRoute('mes_sujets');
    }

    public function supprimerMessageAction($idMessage) {

        $em = $this->getDoctrine()->getManager();
        $message = $em->getRepository("EspritMoocBundle:Message")->findOneById($idMessage);
        $sujet = $em->getRepository("EspritMoocBundle:Sujet")->findOneById($message->getIdSujetMessage());
        $sujet->setNombreMessage($sujet->getNombreMessage() - 1);
        $lastMessageSujet = $em->getRepository("EspritMoocBundle:Message")->findOneBy(array('idSujetMessage' => $sujet), array('datePublicationMessage' => 'asc'), 1);
        $sujet->setLastPoste($lastMessageSujet);
        $idSujet = $sujet->getId();
        $em->persist($sujet);
        $em->remove($message);
        $em->flush();
        return $this->redirectToRoute('afficher_sujet', array('idSujet' => $idSujet));
    }

    public function modifierSujetAction($idSujet) {
        $requete = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository("EspritMoocBundle:Sujet")->findOneById($idSujet);
        $titreSujet = $requete->get('titreSujet');
        $sousTitreSujet = $requete->get('sousTitreSujet');
        $desciptionSujet = $requete->get('contenuSujet');

        $sujet->setTitreSujet($titreSujet);
        $sujet->setSousTitreSujet($sousTitreSujet);
        $sujet->setDescriptionSujet($desciptionSujet);
        $sujet->setEtatSujet(1);
        $sujet->setDateModificationSujet(new \DateTime());
        $em->persist($sujet);
        $em->flush();
        return $this->redirectToRoute('afficher_sujet', array('idSujet' => $idSujet));
    }

    public function modifierMessageAction($idMessage) {
        $requete = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $message = $em->getRepository("EspritMoocBundle:Message")->findOneById($idMessage);
        $sujet = $em->getRepository("EspritMoocBundle:Sujet")->findOneById($message->getIdSujetMessage());
        $titreMessage = $requete->get('titreMessage');
        $contenuMessage = $requete->get('contenuMessage');
        $message->setTitreMessage($titreMessage);
        $message->setContenuMessage($contenuMessage);
        $message->setDateModificationMessage(new \DateTime());
        $em->persist($message);
        $em->flush();
        return $this->redirectToRoute('afficher_sujet', array('idSujet' => $sujet->getId()));
    }

    public function mesInterventionsAction(Request $request) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository("EspritMoocBundle:Message")->findBy(array('idUtilisateurMessage' => $user), array('datePublicationMessage' => 'desc'));
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($messages, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 20 /* limit per page */);
        return $this->render("EspritMoocBundle:Mooc:Forum/mes_interventions.html.twig", array('messages' => $pagination));
    }

    public function mesNotificationsAction() {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $notifications = $this->getDoctrine()->getRepository("EspritMoocBundle:Notification")->findBy(array('idProprietaireNotification' => $user));
        foreach ($notifications as $notif) {
            $notif->setEtatNotification(1);
            $em->persist($notif);
            $em->flush();
        }
        return new JsonResponse(array('name' => "its done"));
    }

    public function likeSujetAction($idSujet) {

        $aime = new Aime();
        $em = $this->getDoctrine()->getManager();
        $sujet = $em->getRepository("EspritMoocBundle:Sujet")->findOneById($idSujet);
        $sujet->setNombreJaime($sujet->getNombreJaime() + 1);
        $aime->setIdSujetAime($sujet);
        $aime->setIdUtilisateurAime($this->getUser());
        $em->persist($aime);
        $em->persist($sujet);
        $em->flush();
        return new JsonResponse(array('name' => "its done"));
    }

    public function ajouterForumAction() {
        $em = $this->getDoctrine()->getManager();
        $requete = $this->getRequest();
        $discipline = $em->getRepository("EspritMoocBundle:Discipline")->findAll();

        if ($requete->getMethod() === "POST") {
            $discipline = $em->getRepository("EspritMoocBundle:Discipline")->findOneByIdDiscipline($requete->get('idDiscipline'));
            $forum = new Forum();
            $forum->setDateCreation(new \DateTime());
            $forum->setIdDiscipline($discipline);
            $forum->setNomForum($requete->get('nomForum'));
            $forum->setNombreSujet(0);
            $forum->setNombreVue(0);
            $em->persist($forum);
            $discipline->setIdForum($forum);
            $em->persist($discipline);
            $em->flush();
            return $this->redirectToRoute('espace_admin');
        }
        return $this->render("EspritMoocBundle:Mooc:Forum/AjouterForum.html.twig", array('disciplines' => $discipline));
    }

    public function modifierForumAction($idForum) {
        $em = $this->getDoctrine()->getManager();
        $requete = $this->getRequest();
        if ($requete->getMethod() === "POST") {
            $forum = $em->getRepository("EspritMoocBundle:Forum")->findOneById($idForum);
            $forum->setIdDiscipline($em->getRepository("EspritMoocBundle:Discipline")->findOneByIdDiscipline($requete->get('disciplineForum')));
            $forum->setnomForum($requete->get('nomForum'));
            $em->persist($forum);
            $em->flush();
            return $this->redirectToRoute('list_discipline', array('notice' => 'success'));
        }
        return $this->redirectToRoute('list_discipline');
    }

    public function supprimerForumAction($idForum) {
        $em = $this->getDoctrine()->getManager();
        $forum = $em->getRepository("EspritMoocBundle:Forum")->findOneById($idForum);
        $em->remove($forum);
        $em->flush();
        return $this->redirectToRoute('list_discipline', array('notice' => 'success'));
    }

}
