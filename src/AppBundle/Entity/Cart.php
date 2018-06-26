<?php

namespace AppBundle\Entity;

use AppBundle\AppBundle;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cart
 *
 * @ORM\Table(name="cart")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CartRepository")
 */
class Cart
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
     * @var User
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn()
     */
    private $user;

    /**
     * @var Goods[] | ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Goods",cascade={"persist"})
     * @ORM\JoinTable(name="cart_products")
     * @ORM\OrderBy({"id":"ASC"})
     */
    private $products;

    /**
     * @var int
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;


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
     * Set user
     *
     * @param integer $user
     *
     * @return Cart
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set product
     *
     * @param Goods
     *
     * @return Cart
     */
    public function setProducts($product)
    {
        if(!$this->products->contains($product)){
            $this->addProducts($product);
        }
        return $this;
    }

    /**
     * Get product
     *
     * @return Goods[] | ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    public function addProducts($product){
        $this->products->add($product);
    }

    public function removeProducts($product){
        if($this->products->contains($product)){
            $this->products->remove($product);
        }
        return $this;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount){
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(){
        return $this->amount;
    }

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }
}

