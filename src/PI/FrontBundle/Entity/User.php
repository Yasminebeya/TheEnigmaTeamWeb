<?php
// src/AppBundle/Entity/User.php

namespace PI\FrontBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    protected $user;


    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */

    protected $cin;


    /**
     * @ORM\Column(type="date",nullable=true)
     */
    protected $datenaissance;


    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $num_telephone;

    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    private $poste;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    protected $dateembauche;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $salaire;



    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    protected $departement;




    public function __construct()
    {
        parent::__construct();
        // your own logic
    }



    /**
     * Set cin
     *
     * @param string $cin
     *
     * @return User
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set datenaissance
     *
     * @param \DateTime $datenaissance
     *
     * @return User
     */
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    /**
     * Get datenaissance
     *
     * @return \DateTime
     */
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }

    /**
     * Set numTelephone
     *
     * @param integer $numTelephone
     *
     * @return User
     */
    public function setNumTelephone($numTelephone)
    {
        $this->num_telephone = $numTelephone;

        return $this;
    }

    /**
     * Get numTelephone
     *
     * @return integer
     */
    public function getNumTelephone()
    {
        return $this->num_telephone;
    }

    /**
     * Set poste
     *
     * @param string $poste
     *
     * @return User
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * Get poste
     *
     * @return string
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * Set dateembauche
     *
     * @param \DateTime $dateembauche
     *
     * @return User
     */
    public function setDateembauche($dateembauche)
    {
        $this->dateembauche = $dateembauche;

        return $this;
    }

    /**
     * Get dateembauche
     *
     * @return \DateTime
     */
    public function getDateembauche()
    {
        return $this->dateembauche;
    }

    /**
     * Set salaire
     *
     * @param integer $salaire
     *
     * @return User
     */
    public function setSalaire($salaire)
    {
        $this->salaire = $salaire;

        return $this;
    }

    /**
     * Get salaire
     *
     * @return integer
     */
    public function getSalaire()
    {
        return $this->salaire;
    }

    /**
     * Set departement
     *
     * @param string $departement
     *
     * @return User
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return string
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return User
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }
}
