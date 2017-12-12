<?php

namespace Esprit\MoocBundle\Controller;

use Esprit\MoocBundle\Entity\QuizzCours;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Esprit\MoocBundle\Form\informationEntrepriseType;
use Esprit\MoocBundle\Form\MailType;
use Esprit\MoocBundle\Entity\Mail;
use Swift_Message;
use Esprit\MoocBundle\Entity\ScoreQuizzFinal;
use Esprit\MoocBundle\Entity\ScoreQuizzCours;
use Esprit\MoocBundle\Entity\UserPhoto;
use Esprit\MoocBundle\Entity\Discussion;
use Esprit\MoocBundle\Entity\ContactMessage;
use Esprit\MoocBundle\Repository\DiscussionRepository;
use Esprit\MoocBundle\Entity\Notification;
use Esprit\MoocBundle\Entity\Discipline;

/**
 * Description of MoocController
 *
 * @author kods
 */
class MoocController extends Controller {

    //home
    public function homeAction() {
//        $addresses=  $formateur = $this->container->get('security.context')->getToken()->getUser()->getEmail();
//
//        
//        $message = \Swift_Message::newInstance()
//                ->setSubject('Validation de quelque chose')
//                ->setFrom(array('elephentworld@gmail.com'=>'Elepehent'))
//                ->setTo($addresses)
//                ->setCharset("utf-8")
//                ->setContentType("text/html")
//                ->setBody($this->renderView("EspritMoocBundle:Default:swiftLayout/mail.html.twig"));
//        $this->get('mailer')->send($message);
        $em = $this->getDoctrine()->getManager();
        $disciplines = $em->getRepository("EspritMoocBundle:Discipline")->findAll();

        return $this->render('EspritMoocBundle:Mooc:home.html.twig', array('disciplines' => $disciplines));
    }

    public function entreprisesAction() {
        return $this->render('EspritMoocBundle:Mooc:entrepriseList.html.twig');
    }

    public function choixInscriptionAction() {
        return $this->render('EspritMoocBundle:Mooc:choix_inscription.html.twig');
    }

    public function inscriptionAction($role) {
        $request = $this->get('request');
        $session = $request->getSession();
        $session->remove('role');
        if ($role == "Apprenant") {
            return $this->redirect($this->generateUrl('fos_user_registration_register', array('role' => $role)));
        }
        if ($role == "Formateur") {
            return $this->redirect($this->generateUrl('fos_user_registration_register', array('role' => $role)));
        }
        if ($role == "Entreprise") {
            return $this->redirect($this->generateUrl('fos_user_registration_register', array('role' => $role)));
        }
    }

    public function confirmationMailAction() {

        return $this->render('EspritMoocBundle:Mooc:mail.html.twig', array());
    }

    public function sendMailAction(Request $request) {

        $to = " ";
        $mail = new Mail();
        $form = $this->createForm(new MailType(), $mail);
        $request->get('request');
        $form->handleRequest($request);
        if ($form->isValid()) {
            $message = Swift_Message::newInstance()
                    ->setSubject($mail->getSujet())
                    ->setFrom($mail->getFrom())
                    ->setTo('elephentworld@gmail.com')
                    ->setBody($mail->getDescription());
            $this->get('mailer')->send($message);

            return $this->render('EspritMoocBundle:Mooc:mail.html.twig', array('to' => $to, 'from' => $mail->getFrom()));
        }
        return $this->redirect($this->generateUrl('my_app_mail_form'));
    }

    public function contactusAction() {
        $mail = new Mail();
        $form = $this->createForm(new MailType(), $mail);
        $request = $this->get('request');
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->sendMailAction('elephentworld@gmail.com', $mail->getFrom(), $mail->getNom(), $mail->getText());
        }
        return $this->render('EspritMoocBundle:Mooc:contactus.html.twig', array('form' => $form->createView()));
    }

    public function afficherHistoriqueAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $visites = $em->getRepository("EspritMoocBundle:Visite")->findBy(array('Apprenant' => $this->getUser()), array('dateVisite' => 'desc'));
        $discipline = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:Discipline")->findAll();
        $formateur = $this->getDoctrine()->getManager()->getRepository("EspritMoocBundle:InformationFormateur")->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($visites, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 21/* limit per page */);
        return $this->render('EspritMoocBundle:Mooc:Cours/CoursHistorique.html.twig', array('pagination' => $pagination, 'disciplines' => $discipline, 'formateurs' => $formateur));
    }

    public function changerPhotoAction() {
        $requet = $this->getRequest();
        if ($requet->getMethod() === "POST") {
            $user = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $photo = $em->getRepository("EspritMoocBundle:UserPhoto")->findOneById($user->getUserPhoto());
            $path = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/userPhoto';
            if (is_object($photo)) {
                $file = $this->getRequest()->files->get('file')->getClientOriginalName();
                $filename = $user->getId() . str_replace(' ', '', $file);
                $this->getRequest()->files->get('file')->move($path, $filename);
                $photo->setPath($filename);
                $em->persist($photo);
                $em->flush();
            } else {
                $photo = new UserPhoto();
                $file = $this->getRequest()->files->get('file')->getClientOriginalName();
                $filename = $user->getId() . str_replace(' ', '', $file);
                $this->getRequest()->files->get('file')->move($path, $filename);
                $photo->setPath($filename);
                $em->persist($photo);
                $user->setUserPhoto($photo);
                $em->persist($user);
                $em->flush();
            }
            if ($user->hasRole('ROLE_FORMATEUR')) {
                return $this->redirectToRoute("fos_user_profile_show");
            }
            if ($user->hasRole('ROLE_APPRENANT')) {
                return $this->redirectToRoute("fos_user_profile_show");
            }
        }
        return $this->redirectToRoute("fos_user_profile_show");
    }

    public function envoyerMessageAction($idDestinataire, $idSujet) {
        $requete = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if ($requete->getMethod() === "POST") {
            $destination = $em->getRepository("EspritMoocBundle:Utilisateur")->findOneById($idDestinataire);
            $titreMessage = $requete->get('titreMessage');
            $contenuMessage = $requete->get('contenuMessage');
            $discussionTab = $em->getRepository("EspritMoocBundle:Discussion")->findDiscussion($user, $destination);
            reset($discussionTab);
            if (is_object(current($discussionTab))) {
                $disc = $em->getRepository("EspritMoocBundle:Discussion")->findOneById(current($discussionTab)->getId());
                $contactMessage = new ContactMessage();
                $notification = new Notification();
                $contactMessage->setContenuMessage($contenuMessage);
                $contactMessage->setDateEnvoi(new \DateTime());
                $contactMessage->setIdUtilisateurDestination($destination);
                $contactMessage->setIdUtilisateurSource($user);
                $contactMessage->setTitreMessage($titreMessage);
                $contactMessage->setIdDiscussion($disc);
                $em->persist($contactMessage);
                $disc->setLastMessage($contactMessage);
                $disc->setNombreMessage($disc->getNombreMessage() + 1);
                $disc->setDateMiseAJour(new \DateTime());
                $em->persist($disc);

                $notification->setDateNotification(new \DateTime());
                $notification->setEtatNotification(0);
                $notification->setIdProprietaireNotification($destination);
                $notification->setIdUtilisateurNotification($this->getUser());
                $notification->setTypeNotification("message");
                $em->persist($notification);
                $em->flush();
                return $this->redirectToRoute('afficher_sujet', array('idSujet' => $idSujet, 'notice' => 'success'));
            } else {

                $newDiscussion = new Discussion();
                $contactMessage = new ContactMessage();
                $newDiscussion->setDateCreation(new \DateTime());
                $newDiscussion->setIdUtilisateurDestination($destination);
                $newDiscussion->setIdUtilisateurSource($user);
                $newDiscussion->setSujetDiscussion($titreMessage);
                $newDiscussion->setNombreMessage(1);
                $contactMessage->setContenuMessage($contenuMessage);
                $contactMessage->setDateEnvoi(new \DateTime());
                $contactMessage->setIdUtilisateurDestination($destination);
                $contactMessage->setIdUtilisateurSource($user);
                $contactMessage->setTitreMessage($titreMessage);
                $contactMessage->setIdDiscussion($newDiscussion);
                $em->persist($contactMessage);
                $newDiscussion->setLastMessage($contactMessage);
                $newDiscussion->setDateMiseAJour(new \DateTime());
                $em->persist($newDiscussion);

                $notification->setDateNotification(new \DateTime());
                $notification->setEtatNotification(0);
                $notification->setIdProprietaireNotification($destination);
                $notification->setIdUtilisateurNotification($this->getUser());
                $notification->setTypeNotifcation("message");
                $em->persist($notification);

                $em->flush();
                return $this->redirectToRoute('afficher_sujet', array('idSujet' => $idSujet, 'notice' => 'success'));
            }

            return $this->redirectToRoute('afficher_sujet', array('idSujet' => $idSujet, 'notice' => 'echec'));
        }
        return $this->redirectToRoute('afficher_sujet', array('idSujet' => $idSujet));
    }

    public function mesDiscussionAction(Request $request) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $discussion = $em->getRepository("EspritMoocBundle:Discussion")->findMesDiscussion($user->getId());
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($discussion, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 20 /* limit per page */);
        return $this->render("EspritMoocBundle:Mooc:mesDiscussion.html.twig", array('discussions' => $pagination));
    }

    public function afficherDiscussionAction(Request $request, $idDiscussion) {

        $em = $this->getDoctrine()->getManager();
        $discussion = $em->getRepository("EspritMoocBundle:Discussion")->findOneById($idDiscussion);
        $messages = $em->getRepository("EspritMoocBundle:ContactMessage")->findBy(array('idDiscussion' => $idDiscussion));
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($messages, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 20 /* limit per page */);
        return $this->render("EspritMoocBundle:Mooc:afficherDiscussion.html.twig", array('messages' => $pagination, 'discussion' => $discussion));
    }

    public function envoyerMessageDiscussionAction($idDestinataire, $idDiscussion) {
        $requete = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        if ($requete->getMethod() === "POST") {
            $destination = $em->getRepository("EspritMoocBundle:Utilisateur")->findOneById($idDestinataire);

            $titreMessage = $requete->get('titreMessage');
            $contenuMessage = $requete->get('contenuMessage');
            $discussionTab = $em->getRepository("EspritMoocBundle:Discussion")->findDiscussion($user, $destination);
            reset($discussionTab);
            if (is_object(current($discussionTab))) {
                $disc = $em->getRepository("EspritMoocBundle:Discussion")->findOneById(current($discussionTab)->getId());
                $contactMessage = new ContactMessage();
                $notification = new Notification();
                $contactMessage->setContenuMessage($contenuMessage);
                $contactMessage->setDateEnvoi(new \DateTime());
                $contactMessage->setIdUtilisateurDestination($destination);
                $contactMessage->setIdUtilisateurSource($user);
                $contactMessage->setTitreMessage($titreMessage);
                $contactMessage->setIdDiscussion($disc);
                $em->persist($contactMessage);
                $disc->setLastMessage($contactMessage);
                $disc->setNombreMessage($disc->getNombreMessage() + 1);
                $disc->setDateMiseAJour(new \DateTime());
                $em->persist($disc);

                $notification->setDateNotification(new \DateTime());
                $notification->setEtatNotification(0);
                $notification->setIdProprietaireNotification($destination);
                $notification->setIdUtilisateurNotification($this->getUser());
                $notification->setTypeNotification("message");
                $em->persist($notification);

                $em->flush();
                return $this->redirectToRoute('afficher_discussion', array('idDiscussion' => $idDiscussion, 'notice' => 'success'));
            } else {
                $newDiscussion = new Discussion();
                $notification = new Notification();
                $contactMessage = new ContactMessage();
                $newDiscussion->setDateCreation(new \DateTime());
                $newDiscussion->setIdUtilisateurDestination($destination);
                $newDiscussion->setIdUtilisateurSource($user);
                $newDiscussion->setSujetDiscussion($titreMessage);
                $newDiscussion->setNombreMessage(1);


                $contactMessage->setContenuMessage($contenuMessage);
                $contactMessage->setDateEnvoi(new \DateTime());
                $contactMessage->setIdUtilisateurDestination($destination);
                $contactMessage->setIdUtilisateurSource($user);
                $contactMessage->setTitreMessage($titreMessage);
                $contactMessage->setIdDiscussion($newDiscussion);
                $em->persist($contactMessage);
                $newDiscussion->setLastMessage($contactMessage);
                $newDiscussion->setDateMiseAJour(new \DateTime());
                $em->persist($newDiscussion);

                $notification->setDateNotification(new \DateTime());
                $notification->setEtatNotification(0);
                $notification->setIdProprietaireNotification($destination);
                $notification->setIdUtilisateurNotification($this->getUser());
                $notification->setTypeNotifcation("message");
                $em->persist($notification);

                $em->flush();
                return $this->redirectToRoute('afficher_discussion', array('idDiscussion' => $idDiscussion, 'notice' => 'success'));
            }
            return $this->redirectToRoute('afficher_discussion', array('idDiscussion' => $idDiscussion, 'notice' => 'echec'));
        }
        return $this->redirectToRoute('afficher_discussion', array('idDiscussion' => $idDiscussion));
    }

    public function ajouterDisciplineAction() {
        $em = $this->getDoctrine()->getManager();
        $requete = $this->getRequest();
        if ($requete->getMethod() == "POST") {
            $logoRepertoire = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/discipline/logo';
            $logo = $this->getRequest()->files->get('logo')->getClientOriginalName();
            $this->getRequest()->files->get('logo')->move($logoRepertoire, $logo);
            $discipline = new Discipline();
            $discipline->setNomDiscipline($requete->get('nomDiscipline'));
            $discipline->setLogo($logo);
            $discipline->setDateCreation(new \DateTime());
            $discipline->setNombreCours(0);
            $discipline->setDescription($requete->get('Description'));
            $em->persist($discipline);
            $em->flush();
            return $this->redirectToRoute('ajouter_forum', array('notice' => 'success'));
        }
        return $this->redirectToRoute('ajouter_forum');
    }

    public function listeDisciplineAction() {
        $em = $this->getDoctrine()->getManager();
        $discipline = $em->getRepository("EspritMoocBundle:Discipline")->findAll();
        return $this->render("EspritMoocBundle:Mooc:Discipline/listDiscipline.html.twig", array('disciplines' => $discipline));
    }

    public function modifierDisciplineAction($idDiscipline) {
        $requete = $this->getRequest();
        if ($requete->getMethod() === "POST") {
            $em = $this->getDoctrine()->getManager();
            $discipline = $em->getRepository("EspritMoocBundle:Discipline")->findOneByIdDiscipline($idDiscipline);


            if (is_object($this->getRequest()->files->get('logo'))) {
                $logoRepertoire = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/discipline/logo';
                $logo = $idDiscipline . $this->getRequest()->files->get('logo')->getClientOriginalName();
                $this->getRequest()->files->get('logo')->move($logoRepertoire, $logo);
                $discipline->setLogo($logo);
            }
            $discipline->setNomDiscipline($requete->get('nomDiscipline'));
            $discipline->setDescription($requete->get('Description'));
            $em->persist($discipline);
            $em->flush();
            return $this->redirectToRoute('list_discipline', array('notice' => 'success'));
        }
        return $this->redirectToRoute('list_discipline');
    }

    public function supprimerDisciplineAction($idDiscipline) {
        $em = $this->getDoctrine()->getManager();
        $discipline = $em->getRepository("EspritMoocBundle:Discipline")->findOneByIdDiscipline($idDiscipline);
        $em->remove($discipline);
        $em->flush();
        return $this->redirectToRoute('list_discipline', array('notice' => 'supp'));
    }

    public function mesParcoursAction() {
        $em = $this->getDoctrine()->getManager();
        $discipline = $em->getRepository("EspritMoocBundle:SuiviDiscipline")->findBy(array('idUtilisateurSuivi' => $this->getUser()), array('dateSuiviDiscipline' => 'desc'));
        $scoreQuizzCours = $em->getRepository("EspritMoocBundle:ScoreQuizzCours")->findBy(array('idApprenantScoreQuizzCours' => $this->getUser()));
        $scoreQuizzChapitre = $em->getRepository("EspritMoocBundle:ScoreQuizzChapitre")->findBy(array('idApprenantScoreQuizzChapitre' => $this->getUser()));
        $progression = $em->getRepository("EspritMoocBundle:Progression")->findBy(array('idUtilisateurProgression' => $this->getUser()));

        return $this->render("EspritMoocBundle:Mooc:parcours/mesParcours.html.twig"
                        , array('disciplines' => $discipline, 'scoreQuizzCours' => $scoreQuizzCours, 'scoreQuizzChapitre' => $scoreQuizzChapitre, 'progressions' => $progression));
    }

}
