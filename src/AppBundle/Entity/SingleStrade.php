<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * SingleStrade
 *
 * @ORM\Table(name="single_strade")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SingleStradeRepository")
 */
class SingleStrade
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
     * @var array
     * @ORM\Column(type="array",name="trade_no")
     */
    private $tradeNo;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product")
     * @ORM\JoinColumn()
     */
    private $product;

    /**
     * @var float
     *
     * @ORM\Column(name="number", type="float")
     */
    private $number;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
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
     * Set product
     *
     * @param Product $product
     *
     * @return SingleStrade
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }



    /**
     * Set number
     *
     * @param float $number
     *
     * @return SingleStrade
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return float
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return SingleStrade
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    public function __construct(){
    }





    /**
     * Set tradeNo
     *
     * @param string[]
     *
     * @return SingleStrade
     */
    public function setTradeNo($tradeNos)
    {
        $this->tradeNo = array();
        foreach ($tradeNos as $tradeNo){
            if(!in_array($tradeNo,$this->tradeNo,true)){
                $this->tradeNo[] = $tradeNo;
            }
        }
        //var_dump($this->tradeNo);die();
        return $this;
    }


    /**
     * Get tradeNo
     *
     * @return string[]
     */
    public function getTradeNo()
    {
        return $this->tradeNo;
    }
}
