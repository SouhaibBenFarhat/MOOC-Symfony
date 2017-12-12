<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mail
 *
 * @author Guenaoui Saber
 */

namespace Esprit\MoocBundle\Entity;

class Mail {

    public $nom;
    public $prenom;
    public $tel;
    public $from;
    public $sujet;
    public $Description;
    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getTel() {
        return $this->tel;
    }

    function getFrom() {
        return $this->from;
    }

    function getSujet() {
        return $this->sujet;
    }

    function getDescription() {
        return $this->Description;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setTel($tel) {
        $this->tel = $tel;
    }

    function setFrom($from) {
        $this->from = $from;
    }

    function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    function setDescription($Description) {
        $this->Description = $Description;
    }


}
