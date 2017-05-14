<?php
namespace PI\FrontBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;
/**
 * Class Tache
 * @package PI\FrontBundle\Entity
 */

/**
 * *  @ORM\Entity(repositoryClass="PI\FrontBundle\Repository\TacheRepository")
 */
class Tache
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="date",nullable=false)
     */
    protected $datedebut;

    /**
     * @ORM\Column(type="date",nullable=false)
     */
    protected $datefin;

    /**
     * @ORM\Column(type="string",length=255,nullable=false)
     */
    protected $Description;

    /**
     * @ORM\Column(type="string",length=255,nullable=false)
     */
    protected $etat;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    protected $user;





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
     * @return Tache
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
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return Tache
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Tache
     */
    public function setDescription($description)
    {
        $this->Description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }






    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Tache
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
     * @return Tache
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
