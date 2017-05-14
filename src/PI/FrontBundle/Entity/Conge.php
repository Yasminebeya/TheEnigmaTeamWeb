<?php
/**
 * Created by PhpStorm.
 * User: Yass
 * Date: 02/02/2017
 * Time: 20:51
 */

namespace PI\FrontBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;


/**
 * Class Conge
 * @package PI\FrontBundle\Entity
 */

/**
 * @ORM\Entity
 */

/**

 * @ORM\Entity(repositoryClass="PI\FrontBundle\Repository\CongeRepository")
 */


class Conge
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="date")
     *
     */
    private $datedebut;
    /**
     * @ORM\Column(type="integer")
     */
    private $nbrjours;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $raison;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $TypeConge;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="user" , referencedColumnName="id")
     * })
     */
    private $user;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $etat = "En attente";




    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return Conge
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    /**
     * Get datedebut
     *
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * Set nbrjours
     *
     * @param integer $nbrjours
     *
     * @return Conge
     */
    public function setNbrjours($nbrjours)
    {
        $this->nbrjours = $nbrjours;

        return $this;
    }

    /**
     * Get nbrjours
     *
     * @return integer
     */
    public function getNbrjours()
    {
        return $this->nbrjours;
    }

    /**
     * Set raison
     *
     * @param string $raison
     *
     * @return Conge
     */
    public function setRaison($raison)
    {
        $this->raison = $raison;

        return $this;
    }

    /**
     * Get raison
     *
     * @return string
     */
    public function getRaison()
    {
        return $this->raison;
    }

    /**
     * Set typeConge
     *
     * @param string $typeConge
     *
     * @return Conge
     */
    public function setTypeConge($typeConge)
    {
        $this->TypeConge = $typeConge;

        return $this;
    }

    /**
     * Get typeConge
     *
     * @return string
     */
    public function getTypeConge()
    {
        return $this->TypeConge;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Conge
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set user
     *
     * @param \PI\FrontBundle\Entity\User $user
     *
     * @return Conge
     */
    public function setUser(\PI\FrontBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PI\FrontBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
