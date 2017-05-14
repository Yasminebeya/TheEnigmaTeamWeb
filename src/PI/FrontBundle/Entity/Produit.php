<?php
/**
 * Created by PhpStorm.
 * User: Yass
 * Date: 02/02/2017
 * Time: 22:46
 */

namespace PI\FrontBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Class Produit
 * @package PI\FrontBundle\Entity
 */

/**
 * @ORM\Entity
 */



class Produit
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

    private $typeproduit;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Libelle;

    /**
     * @ORM\Column(type="float")
     */

    private $prix;
    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $datedebut;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $datefin;
    /**
     * @ORM\Column(type="string",length=255,)
     */

    private $description;
    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    /**
     * @ORM\Column(type="integer")
     */
    private $rating;


    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/produits';
    }





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
     * Set typeproduit
     *
     * @param string $typeproduit
     *
     * @return Produit
     */
    public function setTypeproduit($typeproduit)
    {
        $this->typeproduit = $typeproduit;

        return $this;
    }

    /**
     * Get typeproduit
     *
     * @return string
     */
    public function getTypeproduit()
    {
        return $this->typeproduit;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Produit
     */
    public function setLibelle($libelle)
    {
        $this->Libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->Libelle;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }



    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Produit
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @return mixed
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param mixed $datedebut
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return mixed
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @param mixed $datefin
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->path = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }
}
