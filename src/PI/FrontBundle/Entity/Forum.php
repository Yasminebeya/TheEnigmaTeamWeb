<?php
/**
 * Created by PhpStorm.
 * User: Yass
 * Date: 02/02/2017
 * Time: 22:28
 */

namespace PI\FrontBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;
/**
 * Class Forum
 * @package PI\FrontBundle\Entity
 */

/**
 * @ORM\Entity
 */

class Forum
{/**
 * @var integer
 *
 * @ORM\Column(name="id_forum", type="integer", nullable=false)
 * @ORM\Id
 * @ORM\GeneratedValue(strategy="IDENTITY")
 */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_forum", type="string", length=200 ,nullable=false)
     */
    private $nomForum;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_sujet", type="integer",nullable=true)
     */
    private $nombreSujet;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombre_vu", type="integer",nullable=true)
     */
    private $nombreVue;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_creation", type="datetime" ,nullable=false)
     */
    private $dateCreation;




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
     * Set nomForum
     *
     * @param string $nomForum
     *
     * @return Forum
     */
    public function setNomForum($nomForum)
    {
        $this->nomForum = $nomForum;

        return $this;
    }

    /**
     * Get nomForum
     *
     * @return string
     */
    public function getNomForum()
    {
        return $this->nomForum;
    }

    /**
     * Set nombreSujet
     *
     * @param integer $nombreSujet
     *
     * @return Forum
     */
    public function setNombreSujet($nombreSujet)
    {
        $this->nombreSujet = $nombreSujet;

        return $this;
    }

    /**
     * Get nombreSujet
     *
     * @return integer
     */
    public function getNombreSujet()
    {
        return $this->nombreSujet;
    }

    /**
     * Set nombreVue
     *
     * @param integer $nombreVue
     *
     * @return Forum
     */
    public function setNombreVue($nombreVue)
    {
        $this->nombreVue = $nombreVue;

        return $this;
    }

    /**
     * Get nombreVue
     *
     * @return integer
     */
    public function getNombreVue()
    {
        return $this->nombreVue;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Forum
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set idDiscipline
     *
     * @param \PI\FrontBundle\Entity\Discipline $idDiscipline
     *
     * @return Forum
     */
    public function setIdDiscipline(\PI\FrontBundle\Entity\Discipline $idDiscipline = null)
    {
        $this->idDiscipline = $idDiscipline;

        return $this;
    }

    /**
     * Get idDiscipline
     *
     * @return \PI\FrontBundle\Entity\Discipline
     */
    public function getIdDiscipline()
    {
        return $this->idDiscipline;
    }
}
