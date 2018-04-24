<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Goods
 *
 * @ORM\Table(name="goods")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GoodsRepository")
 */
class Goods
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
     * @ORM\Column(name="tradeNo", type="string", length=255, unique=true)
     */
    private $tradeNo;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @var float
     *
     * @ORM\Column(name="totalAmount", type="float")
     */
    private $totalAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="goodsDetail", type="integer")
     */
    private $goodsDetail;

    /**
     * @var int
     *
     * @ORM\Column(name="userId", type="integer")
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="couponId", type="integer", nullable=true)
     */
    private $couponId;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;


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
     * Set tradeNo
     *
     * @param string $tradeNo
     *
     * @return Goods
     */
    public function setTradeNo($tradeNo)
    {
        $this->tradeNo = $tradeNo;

        return $this;
    }

    /**
     * Get tradeNo
     *
     * @return string
     */
    public function getTradeNo()
    {
        return $this->tradeNo;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Goods
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set totalAmount
     *
     * @param float $totalAmount
     *
     * @return Goods
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * Get totalAmount
     *
     * @return float
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Goods
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
     * Set goodsDetail
     *
     * @param integer $goodsDetail
     *
     * @return Goods
     */
    public function setGoodsDetail($goodsDetail)
    {
        $this->goodsDetail = $goodsDetail;

        return $this;
    }

    /**
     * Get goodsDetail
     *
     * @return int
     */
    public function getGoodsDetail()
    {
        return $this->goodsDetail;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Goods
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Goods
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Goods
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set couponId
     *
     * @param integer $couponId
     *
     * @return Goods
     */
    public function setCouponId($couponId)
    {
        $this->couponId = $couponId;

        return $this;
    }

    /**
     * Get couponId
     *
     * @return int
     */
    public function getCouponId()
    {
        return $this->couponId;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Goods
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }
}

