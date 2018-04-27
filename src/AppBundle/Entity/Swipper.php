<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Swipper
 *
 * @ORM\Table(name="swipper")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SwipperRepository")
 * @Vich\Uploadable
 */
class Swipper
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
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @Vich\UploadableField(mapping="swipper_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateAt", type="date")
     */
    private $updateAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Swipper
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Swipper
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Swipper
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    public function __construct(){
        $this->setUpdateAt(new \DateTime());
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        if ($image) {
            $this->setUpdateAt(new \DateTime('now')) ;
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }
}

