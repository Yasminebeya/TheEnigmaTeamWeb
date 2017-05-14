<?php
namespace PI\FrontBundle\Entity;
use Doctrine\ORM\Mapping as ORM ;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
* Class Publication
 * @package PI\FrontBundle\Entity
*/

/**
 * @ORM\Entity
 */

class Publication {
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(nullable=true)
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**


     * @ORM\Column(type="string",length=255)
     */
    private $text;
    /**


     * @ORM\Column(type="date")
     */
    private $date;
    /**


     * @ORM\Column(type="date")
     */
    private $date1;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     */

    private $user;




    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;

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
        return 'uploads/publications';
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
 * @return mixed
 */
public function getText()
{
    return $this->text;
}/**
 * @param mixed $text
 */
public function setText($text)
{
    $this->text = $text;
}/**
 * @return mixed
 */
public function getUser()
{
    return $this->user;
}/**
 * @param mixed $user
 */
public function setUser($user)
{
    $this->user = $user;
}

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
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

    /**

     * @ORM\Column(type="integer")
     */
    private $jaime;
    /**

     * @ORM\Column(type="integer")
     */
    private $jaimepas;

    /**
     * @return mixed
     */
    public function getJaime()
    {
        return $this->jaime;
    }

    /**
     * @param mixed $jaime
     */
    public function setJaime($jaime)
    {
        $this->jaime = $jaime;
    }

    /**
     * @return mixed
     */
    public function getJaimepas()
    {
        return $this->jaimepas;
    }

    /**
     * @param mixed $jaimepas
     */
    public function setJaimepas($jaimepas)
    {
        $this->jaimepas = $jaimepas;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getDate1()
    {
        return $this->date1;
    }

    /**
     * @param mixed $date1
     */
    public function setDate1($date1)
    {
        $this->date1 = $date1;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    public function __construct()

    {

        $this->jaime = '0';
        $this->jaimepas='0';
        $this->date = new \DateTime();
        $this->date1 = new \DateTime();

    }
}
