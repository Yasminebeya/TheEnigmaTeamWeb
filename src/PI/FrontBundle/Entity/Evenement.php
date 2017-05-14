<?php
/**
 * Created by PhpStorm.
 * User: smart_tech_plus
 * Date: 02/02/2017
 * Time: 21:03
 */

namespace PI\FrontBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;
use Symfony\Component\HttpFoundation\File\File;


/**
 *
 */

/**
 * @ORM\Entity(repositoryClass="PI\FrontBundle\Repository\categorie")
 */
class Evenement
{

    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private $image;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @ORM\Column(type="string",length=255, nullable=true)
     */
    private $lieu;

    /**
     * @return mixed
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    /**
     * @param mixed $pourcentage
     */
    public function setPourcentage($pourcentage)
    {
        $this->pourcentage = $pourcentage;
    }

    /**
     * @return mixed
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * @param mixed $flag
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;
    }



    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $flag="0";


    /**
    * @ORM\Column(type="integer", nullable=true)
    */
    private $pourcentage;


    /**
     * @ORM\Column(type="integer")
     */
    private $nbrelimite;

    /**
     * @return mixed
     */
    public function getNbrparticipants()
    {
        return $this->nbrparticipants;
    }

    /**
     * @param mixed $nbrparticipants
     */
    public function setNbrparticipants($nbrparticipants)
    {
        $this->nbrparticipants = $nbrparticipants;
    }


    /**
     * @ORM\Column(type="integer" ,nullable=true)
     */
    private $nbrparticipants;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $categorie;



    /**
     * @ORM\Column(type="date")
     */
    private $datedebut;

    /**
     * @ORM\Column(type="date")
     */
    private $datefin;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="string", length=255,nullable=true)
     */
    private $lat;
    /**
     * @var string
     *
     * @ORM\Column(name="lon", type="string", length=255,nullable=true)
     */
    private $lon;



    /**
     *
     *
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;






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
     * Set nom
     *
     * @param string $nom
     *
     * @return Evenement
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Evenement
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set
     *
     * @param integer $nbrelimite
     *
     * @return Evenement
     */
    public function setNbrelimite($nbrelimite)
    {
        $this->nbrelimite = $nbrelimite;

        return $this;
    }

    /**
     * Get nbrelimite
     *
     * @return integer
     */
    public function getNbrelimite()
    {
        return $this->nbrelimite;
    }


    /**
     * Set datedebut
     *
     * @param \DateTime $datedebut
     *
     * @return Evenement
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
     * @return Evenement
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
     * @return Evenement
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set lat
     *
     * @param string $lat
     *
     * @return Evenement
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lon
     *
     * @param string $lon
     *
     * @return Evenement
     */
    public function setLon($lon)
    {
        $this->lon = $lon;

        return $this;
    }

    /**
     * Get lon
     *
     * @return string
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * Set user
     *
     * @param \PI\FrontBundle\Entity\User $user
     *
     * @return Evenement
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
