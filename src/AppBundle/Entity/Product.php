<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 *
 */
class Product
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User");
     */
    private $provider;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=12)
     */
    private $model;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;

    /**
     * @var integer
     * @ORM\Column(name="sales", type="integer",nullable=true)
     */
    private $sales;

    /**
     * @var string
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    private $image;

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
     * @ORM\Column(type="boolean",name="is_front")
     */
    private $isFront;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category")
     * @ORM\JoinColumn()
     * @ORM\OrderBy({"title":"ASC"})
     */
    private $category;

    /**
     * @var string
     * @ORM\Column(name="article_number", type="string", length=50, nullable=true)
     */
    private $articleNumber;

    /**
     * @var string
     * @ORM\Column(name="market_time", type="string",length=50,nullable=true)
     */
    private $marketTime;

    /**
     * @var string
     * @ORM\Column(name="style", type="string", length=100, nullable=true)
     */
    private $style;

    /**
     * @var string
     *@ORM\Column(name="styles", type="string", length=100, nullable=true)
     */
    private $styles;

    /**
     * @var string
     * @ORM\Column(name="material", type="string", length=255, nullable=true)
     */
    private $material;

    /**
     * @var string
     * @ORM\Column(name="color", type="string", length=100, nullable=true)
     */
    private $color;

    /**
     * @var string
     * @ORM\Column(name="pattern", type="string", length=100, nullable=true)
     */
    private $pattern;

    /**
     * @var string
     * @ORM\Column(name="thick", type="string", length=50, nullable=true)
     */
    private $thick;

    /**
     * @var string
     * @ORM\Column(name="craft", type="string", length=255, nullable=true)
     */
    private $craft;

    /**
     * @var string
     * @ORM\Column(name="coat_length", type="string", length=50, nullable=true)
     */
    private $coatLength;

    /**
     * @var string
     * @ORM\Column(name="sleeve_length", type="string", length=50, nullable=true)
     */
    private $sleeveLength;

    /**
     * @var string
     * @ORM\Column(name="sleeve_style", type="string", length=100, nullable=true)
     */
    private $sleeveStyle;

    /**
     * @var string
     * @ORM\Column(name="collar_style", type="string", length=100, nullable=true)
     */
    private $collarStyle;

    /**
     * @var string
     * @ORM\Column(name="flap", type="string", length=100, nullable=true)
     */
    private $flap;

    /**
     * @var string
     * @ORM\Column(name="forking", type="string", length=100, nullable=true)
     */
    private $forking;

    /**
     * @var string
     * @ORM\Column(name="flap_style", type="string", length=100, nullable=true)
     */
    private $flapStyle;

    /**
     * @var string
     * @ORM\Column(name="pants_length", type="string", length=100, nullable=true)
     */
    private $pantsLength;

    /**
     * @var string
     * @ORM\Column(name="skirt_length", type="string", length=100, nullable=true)
     */
    private $skirtLength;

    /**
     * @var string
     * @ORM\Column(name="skirt_style", type="string", length=100, nullable=true)
     */
    private $skirtStyle;

    /**
     * @var string
     * @ORM\Column(name="product_no", type="string", length=100, nullable=true)
     */
    private $productNo;

    /**
     * @var string
     * @ORM\Column(name="product_type", type="string", length=100, nullable=true)
     */
    private $productType;

    /**
     * @var string
     * @ORM\Column(name="cycle", type="string", length=100, nullable=true)
     */
    private $cycle;

    /**
     * @var float
     * @ORM\Column(name="supply_price", type="float", nullable=true)
     */
    private $supplyPrice;

    /**
     * @var string
     * @ORM\Column(name="size", type="string", length=50, nullable=true)
     */
    private $size;

    /**
     * @var string
     * @ORM\Column(name="label",type="string",length=255,nullable=true)
     */
    private $productLabel;

    /**
     * @var boolean
     * @ORM\Column(name="selling",type="boolean",nullable=true)
     */
    private $selling;


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
     * Set model
     *
     * @param string $model
     *
     * @return Product
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
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
     * Set stock
     *
     * @param integer $stock
     *
     * @return Product
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set sales
     *
     * @param integer $sales
     *
     * @return Product
     */
    public function setSales($sales = 0)
    {
        $this->sales = $sales;

        return $this;
    }

    /**
     * Get sales
     *
     * @return integer
     */
    public function getSales()
    {
        return $this->sales;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Product
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

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function __construct()
    {
        $this->setSales();
        $this->setIsFront();
        $this->updatedAt = new \DateTime('now');
        $this->selling = false;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Product
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Product
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
     * Set isFront
     *
     * @param boolean $isFront
     *
     * @return Product
     */
    public function setIsFront($isFront = true)
    {
        $this->isFront = $isFront;

        return $this;
    }

    /**
     * Get isFront
     *
     * @return boolean
     */
    public function getIsFront()
    {
        return $this->isFront;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * Set articleNumber
     *
     * @param string $articleNumber
     *
     * @return Product
     */
    public function setArticleNumber($articleNumber)
    {
        $this->articleNumber = $articleNumber;

        return $this;
    }

    /**
     * Get articleNumber
     *
     * @return string
     */
    public function getArticleNumber()
    {
        return $this->articleNumber;
    }

    /**
     * Set marketTime
     *
     * @param \DateTime $marketTime
     *
     * @return Product
     */
    public function setMarketTime($marketTime)
    {
        $this->marketTime = $marketTime;

        return $this;
    }

    /**
     * Get marketTime
     *
     * @return string
     */
    public function getMarketTime()
    {
        return $this->marketTime;
    }

    /**
     * Set style
     *
     * @param string $style
     *
     * @return Product
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set styles
     *
     * @param string $styles
     *
     * @return Product
     */
    public function setStyles($styles)
    {
        $this->styles = $styles;

        return $this;
    }

    /**
     * Get styles
     *
     * @return string
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * Set material
     *
     * @param string $material
     *
     * @return Product
     */
    public function setMaterial($material)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material
     *
     * @return string
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Product
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set pattern
     *
     * @param string $pattern
     *
     * @return Product
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;

        return $this;
    }

    /**
     * Get pattern
     *
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * Set thick
     *
     * @param string $thick
     *
     * @return Product
     */
    public function setThick($thick)
    {
        $this->thick = $thick;

        return $this;
    }

    /**
     * Get thick
     *
     * @return string
     */
    public function getThick()
    {
        return $this->thick;
    }

    /**
     * Set craft
     *
     * @param string $craft
     *
     * @return Product
     */
    public function setCraft($craft)
    {
        $this->craft = $craft;

        return $this;
    }

    /**
     * Get craft
     *
     * @return string
     */
    public function getCraft()
    {
        return $this->craft;
    }

    /**
     * Set coatLength
     *
     * @param string $coatLength
     *
     * @return Product
     */
    public function setCoatLength($coatLength)
    {
        $this->coatLength = $coatLength;

        return $this;
    }

    /**
     * Get coatLength
     *
     * @return string
     */
    public function getCoatLength()
    {
        return $this->coatLength;
    }

    /**
     * Set sleeveLength
     *
     * @param string $sleeveLength
     *
     * @return Product
     */
    public function setSleeveLength($sleeveLength)
    {
        $this->sleeveLength = $sleeveLength;

        return $this;
    }

    /**
     * Get sleeveLength
     *
     * @return string
     */
    public function getSleeveLength()
    {
        return $this->sleeveLength;
    }

    /**
     * Set sleeveStyle
     *
     * @param string $sleeveStyle
     *
     * @return Product
     */
    public function setSleeveStyle($sleeveStyle)
    {
        $this->sleeveStyle = $sleeveStyle;

        return $this;
    }

    /**
     * Get sleeveStyle
     *
     * @return string
     */
    public function getSleeveStyle()
    {
        return $this->sleeveStyle;
    }

    /**
     * Set collarStyle
     *
     * @param string $collarStyle
     *
     * @return Product
     */
    public function setCollarStyle($collarStyle)
    {
        $this->collarStyle = $collarStyle;

        return $this;
    }

    /**
     * Get collarStyle
     *
     * @return string
     */
    public function getCollarStyle()
    {
        return $this->collarStyle;
    }

    /**
     * Set flap
     *
     * @param string $flap
     *
     * @return Product
     */
    public function setFlap($flap)
    {
        $this->flap = $flap;

        return $this;
    }

    /**
     * Get flap
     *
     * @return string
     */
    public function getFlap()
    {
        return $this->flap;
    }

    /**
     * Set forking
     *
     * @param string $forking
     *
     * @return Product
     */
    public function setForking($forking)
    {
        $this->forking = $forking;

        return $this;
    }

    /**
     * Get forking
     *
     * @return string
     */
    public function getForking()
    {
        return $this->forking;
    }

    /**
     * Set flapStyle
     *
     * @param string $flapStyle
     *
     * @return Product
     */
    public function setFlapStyle($flapStyle)
    {
        $this->flapStyle = $flapStyle;

        return $this;
    }

    /**
     * Get flapStyle
     *
     * @return string
     */
    public function getFlapStyle()
    {
        return $this->flapStyle;
    }

    /**
     * Set pantsLength
     *
     * @param string $pantsLength
     *
     * @return Product
     */
    public function setPantsLength($pantsLength)
    {
        $this->pantsLength = $pantsLength;

        return $this;
    }

    /**
     * Get pantsLength
     *
     * @return string
     */
    public function getPantsLength()
    {
        return $this->pantsLength;
    }

    /**
     * Set skirtLength
     *
     * @param string $skirtLength
     *
     * @return Product
     */
    public function setSkirtLength($skirtLength)
    {
        $this->skirtLength = $skirtLength;

        return $this;
    }

    /**
     * Get skirtLength
     *
     * @return string
     */
    public function getSkirtLength()
    {
        return $this->skirtLength;
    }

    /**
     * Set skirtStyle
     *
     * @param string $skirtStyle
     *
     * @return Product
     */
    public function setSkirtStyle($skirtStyle)
    {
        $this->skirtStyle = $skirtStyle;

        return $this;
    }

    /**
     * Get skirtStyle
     *
     * @return string
     */
    public function getSkirtStyle()
    {
        return $this->skirtStyle;
    }

    /**
     * Set productNo
     *
     * @param string $productNo
     *
     * @return Product
     */
    public function setProductNo($productNo)
    {
        $this->productNo = $productNo;

        return $this;
    }

    /**
     * Get productNo
     *
     * @return string
     */
    public function getProductNo()
    {
        return $this->productNo;
    }

    /**
     * Set productType
     *
     * @param string $productType
     *
     * @return Product
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;

        return $this;
    }

    /**
     * Get productType
     *
     * @return string
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * Set cycle
     *
     * @param string $cycle
     *
     * @return Product
     */
    public function setCycle($cycle)
    {
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * Get cycle
     *
     * @return string
     */
    public function getCycle()
    {
        return $this->cycle;
    }

    /**
     * Set supplyPrice
     *
     * @param float $supplyPrice
     *
     * @return Product
     */
    public function setSupplyPrice($supplyPrice)
    {
        $this->supplyPrice = $supplyPrice;

        return $this;
    }

    /**
     * Get supplyPrice
     *
     * @return float
     */
    public function getSupplyPrice()
    {
        return $this->supplyPrice;
    }

    /**
     * Set size
     *
     * @param string $size
     *
     * @return Product
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    public function generateTradeNo($num){
        $tradeNo = [];
        if($num > 1){
            for($i = 1; $i<= $num; $i++){
                $no = $this->sales + $i;
                $tradeNo[] = $this->productNo.$no;
            }
        }else{
            $no = $this->sales + $num;
            $tradeNo[] = $this->productNo.$no;
        }
        return $tradeNo;
    }

    /**
     * Set productLabel
     *
     * @param string $productLabel
     *
     * @return Product
     */
    public function setProductLabel($productLabel)
    {
        $this->productLabel = $productLabel;

        return $this;
    }

    /**
     * Get productLabel
     *
     * @return string
     */
    public function getProductLabel()
    {
        return $this->productLabel;
    }

    /**
     * Set selling
     *
     * @param boolean $selling
     *
     * @return Product
     */
    public function setSelling($selling = false)
    {
        $this->selling = $selling;

        return $this;
    }

    /**
     * Get selling
     *
     * @return boolean
     */
    public function getSelling()
    {
        return $this->selling;
    }

    public function setProvider(User $user){
        $this->provider = $user;
        return $this;
    }

    public function getProvider(){
        return $this->provider;
    }


}
