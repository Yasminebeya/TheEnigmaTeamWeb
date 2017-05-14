<?php
/**
 * Created by PhpStorm.
 * User: smart
 * Date: 13/02/2017
 * Time: 22:39
 */

namespace PI\FrontBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;
/**
 * Class Message
 * @package PI\FrontBundle\Entity
 */

/**
 * *  @ORM\Entity(repositoryClass="PI\FrontBundle\Repository\TacheRepository")
 */

class Message
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string",length=255,nullable=false)
     */
    protected $objet;

    /**
     * @ORM\Column(type="string",length=255,nullable=false)
     */
    protected $text;

    /**
     * @ORM\Column(type="string",length=255,nullable=false)
     */
    protected $nomUser;


    /**
     * @ORM\Column(type="date",nullable=false)
     */
    protected $datedenvoye;



    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $employe;



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
     * Set objet
     *
     * @param string $objet
     *
     * @return Message
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Message
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }



    /**
     * Set employe
     *
     * @param \PI\FrontBundle\Entity\User $employe
     *
     * @return Message
     */
    public function setEmploye(\PI\FrontBundle\Entity\User $employe = null)
    {
        $this->employe = $employe;

        return $this;
    }

    /**
     * Get employe
     *
     * @return \PI\FrontBundle\Entity\User
     */
    public function getEmploye()
    {
        return $this->employe;
    }

    /**
     * Set nomUser
     *
     * @param string $nomUser
     *
     * @return Message
     */
    public function setNomUser($nomUser)
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    /**
     * Get nomUser
     *
     * @return string
     */
    public function getNomUser()
    {
        return $this->nomUser;
    }

    /**
     * Set datedenvoye
     *
     * @param \DateTime $datedenvoye
     *
     * @return Message
     */
    public function setDatedenvoye($datedenvoye)
    {
        $this->datedenvoye = $datedenvoye;

        return $this;
    }

    /**
     * Get datedenvoye
     *
     * @return \DateTime
     */
    public function getDatedenvoye()
    {
        return $this->datedenvoye;
    }
}
