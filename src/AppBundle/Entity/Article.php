<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\4\26 0026
 * Time: 12:03
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
 abstract class Article
{
     /**
      * @var int
      *
      * @ORM\Column(name="id", type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
      */
     protected $id;

     /**
      * @var string
      *
      * @ORM\Column(name="title", type="string", length=255)
      */
     protected $title;

     /**
      * @var string
      *
      * @ORM\Column(name="image", type="string", length=255, nullable=true)
      */
     protected $image;

     /**
      * @var string
      *
      * @ORM\Column(name="content", type="text")
      */
     protected $content;

     /**
      * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
      * @var File
      */
     private $imageFile;

     /**
      * @ORM\Column(type="datetime")
      * @var \DateTime
      */
     private $updatedAt;


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
      * Set title
      *
      * @param string $title
      *
      * @return Article
      */
     public function setTitle($title)
     {
         $this->title = $title;

         return $this;
     }

     /**
      * Get title
      *
      * @return string
      */
     public function getTitle()
     {
         return $this->title;
     }

     /**
      * Set image
      *
      * @param string $image
      *
      * @return Article
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
      * Set content
      *
      * @param string $content
      *
      * @return Article
      */
     public function setContent($content)
     {
         $this->content = $content;

         return $this;
     }

     /**
      * Get content
      *
      * @return string
      */
     public function getContent()
     {
         return $this->content;
     }

     public function setImageFile(File $image = null)
     {
         $this->imageFile = $image;

         // VERY IMPORTANT:
         // It is required that at least one field changes if you are using Doctrine,
         // otherwise the event listeners won't be called and the file is lost
         if ($image) {
             // if 'updatedAt' is not defined in your entity, use another property
             $this->updatedAt = new \DateTime('now');
         }
     }

     public function getImageFile()
     {
         return $this->imageFile;
     }


 }