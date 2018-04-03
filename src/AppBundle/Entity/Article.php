<?php
/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 01.04.18
 * Time: 16:03
 */

namespace AppBundle\Entity;
use AppBundle\Entity\Cat;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
* Category
* @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
* @ORM\Table(name="articles")
//* @ORM\HasLifecycleCallbacks()
*/
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=256)
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $description;


    /**
     * @var DateTime
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var DateTime|null
     * @ORM\Column(name="deleted_at", type="datetime", nullable=TRUE)
     */
    private $deletedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Cat", inversedBy="categories")
     * @ORM\JoinColumn(nullable=true)
     */
    private $cat;

    /**
     * Article constructor.
     * @param $name
     * @param $description
     * @param \AppBundle\Entity\Cat $cat
     */
    public function __construct($name,  $description, Cat $cat){
        $this->name = $name;
        $this->description = $description;
        $this->updatedAt = new DateTime();
        $this->deletedAt = null;
        $this->cat = $cat;
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
     * Set name
     *
     * @param string $name
     *
     * @return Cat
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Cat
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return Cat
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Article
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
     * @return mixed
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * @param \AppBundle\Entity\Cat $cat
     */
    public function setCat(Cat $cat)
    {
        $this->cat = $cat;
    }
}
