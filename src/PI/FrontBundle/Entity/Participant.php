<?php
/**
 * Created by PhpStorm.
 * User: Oumaima
 * Date: 17/02/2017
 * Time: 17:16
 */

namespace PI\FrontBundle\Entity;


use Doctrine\ORM\Mapping as ORM ;

/**
 * Class Participant
 * @package PI\FrontBundle\Entity
 */

/**
 * @ORM\Entity(repositoryClass="PI\FrontBundle\Repository\categorie")
 */
class Participant
{

    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;


    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="Evenement")
     * @ORM\JoinColumn(name="idevenement", referencedColumnName="id")
     */
    private $idevenement;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * Set user
     *
     * @param \PI\FrontBundle\Entity\User $user
     *
     * @return Participant
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Set idevenement
     *
     * @param \PI\FrontBundle\Entity\Evenement $idevenement
     *
     * @return Participant
     */
    public function setidEvenement($idevenement)
    {
        $this->idevenement = $idevenement;

    }

    /**
     * Get evenement
     *
     * @return \PI\FrontBundle\Entity\Evenement
     */
    public function getIdevenement()
    {
        return $this->idevenement;
    }

}