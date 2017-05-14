<?php
/**
 * Created by PhpStorm.
 * User: Yass
 * Date: 02/02/2017
 * Time: 22:20
 */

namespace PI\FrontBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;


/**
 * Class InformationEntreprise
 * @package PI\FrontBundle\Entity
 */

/**
 * @ORM\Entity
 */



class InformationEntreprise
{/**
 *
 * @ORM\Column(name="id", type="integer")
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="AUTO")
 */
    private $id;

    /**
     *
     * @ORM\Column(name="specialite", type="string", length=200)

     */
    private $specialite;

    /**
     *
     * @ORM\Column(name="site_web", type="string", length=200)
     */
    private $siteWeb;

    /**
     *
     * @ORM\Column(name="abreviation", type="string", length=10)
     */
    private $abreviation;

    /**
     *
     * @ORM\Column(name="gouvernerat", type="string", length=10)
     */
    private $gouvernerat;

    /**
     *
     * @ORM\Column(name="attestation", type="string", length=200)
     */
    private $attestation;

    /**
     *
     * @ORM\Column(name="filename", type="string", length=200)
     */
    private $filename;

    /**
     *
     * @ORM\Column(name="description", type="string", length=500)
     */
    private $description;

    /**
     *
     * @ORM\Column(name="code_postale", type="integer", length=10)
     */
    private $codePostale;

    /**
     *
     * @ORM\Column(name="type", type="string", length=10, nullable=true)
     */
    private $type;

    /**
     *
     * @ORM\Column(name="adresse", type="string", length=100)
     */
    private $adresse;

    /**
     *
     * @ORM\Column(name="nationnalite", type="string", length=100)
     */
    private $nationnalite;

    /**
     *
     * @ORM\Column(name="numTel", type="integer", length=100)
     */
    private $numTel;

    /**
     *
     * @ORM\Column(name="matriculeFiscal", type="integer", length=100)
     */
    private $matriculeFiscal;




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
     * Set specialite
     *
     * @param string $specialite
     *
     * @return InformationEntreprise
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * Get specialite
     *
     * @return string
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * Set siteWeb
     *
     * @param string $siteWeb
     *
     * @return InformationEntreprise
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }

    /**
     * Set abreviation
     *
     * @param string $abreviation
     *
     * @return InformationEntreprise
     */
    public function setAbreviation($abreviation)
    {
        $this->abreviation = $abreviation;

        return $this;
    }

    /**
     * Get abreviation
     *
     * @return string
     */
    public function getAbreviation()
    {
        return $this->abreviation;
    }

    /**
     * Set gouvernerat
     *
     * @param string $gouvernerat
     *
     * @return InformationEntreprise
     */
    public function setGouvernerat($gouvernerat)
    {
        $this->gouvernerat = $gouvernerat;

        return $this;
    }

    /**
     * Get gouvernerat
     *
     * @return string
     */
    public function getGouvernerat()
    {
        return $this->gouvernerat;
    }

    /**
     * Set attestation
     *
     * @param string $attestation
     *
     * @return InformationEntreprise
     */
    public function setAttestation($attestation)
    {
        $this->attestation = $attestation;

        return $this;
    }

    /**
     * Get attestation
     *
     * @return string
     */
    public function getAttestation()
    {
        return $this->attestation;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return InformationEntreprise
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return InformationEntreprise
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
     * Set codePostale
     *
     * @param integer $codePostale
     *
     * @return InformationEntreprise
     */
    public function setCodePostale($codePostale)
    {
        $this->codePostale = $codePostale;

        return $this;
    }

    /**
     * Get codePostale
     *
     * @return integer
     */
    public function getCodePostale()
    {
        return $this->codePostale;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return InformationEntreprise
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return InformationEntreprise
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set nationnalite
     *
     * @param string $nationnalite
     *
     * @return InformationEntreprise
     */
    public function setNationnalite($nationnalite)
    {
        $this->nationnalite = $nationnalite;

        return $this;
    }

    /**
     * Get nationnalite
     *
     * @return string
     */
    public function getNationnalite()
    {
        return $this->nationnalite;
    }

    /**
     * Set numTel
     *
     * @param integer $numTel
     *
     * @return InformationEntreprise
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;

        return $this;
    }

    /**
     * Get numTel
     *
     * @return integer
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * Set matriculeFiscal
     *
     * @param integer $matriculeFiscal
     *
     * @return InformationEntreprise
     */
    public function setMatriculeFiscal($matriculeFiscal)
    {
        $this->matriculeFiscal = $matriculeFiscal;

        return $this;
    }

    /**
     * Get matriculeFiscal
     *
     * @return integer
     */
    public function getMatriculeFiscal()
    {
        return $this->matriculeFiscal;
    }

    /**
     * Set entreprise
     *
     * @param \PI\FrontBundle\Entity\Utilisateur $entreprise
     *
     * @return InformationEntreprise
     */
    public function setEntreprise(\PI\FrontBundle\Entity\Utilisateur $entreprise = null)
    {
        $this->entreprise = $entreprise;

        return $this;
    }


}
