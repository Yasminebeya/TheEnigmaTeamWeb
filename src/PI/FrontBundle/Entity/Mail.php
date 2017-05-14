<?php
namespace PI\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


class Mail
{
    public $nom;
    public $prenom;
    public $email;
    public $text;

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getEmail() {
        return $this->email;
    }

    function getText() {
        return $this->text;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }



    function setEmail($email) {
        $this->email = $email;
    }

    function setSujet($text) {
        $this->text = $text;
    }


}
