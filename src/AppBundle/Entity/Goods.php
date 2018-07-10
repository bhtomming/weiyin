<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Goods
 *
 * @ORM\Table(name="goods")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GoodsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Goods
{
    const UNPAID = 0;
    const PAID = 1;
    const SEND_OUT = 2;
    const RETURN_BACK = 3;
    const CLOSED = 4;


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
     * @ORM\Column(name="tradeNo", type="string", length=50, unique=true)
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
     * @var SingleStrade[] | ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\SingleStrade" ,cascade={"persist"})
     * @ORM\JoinTable(name="goods_SingleStrade")
     * @ORM\OrderBy({"id":"ASC"})
     */
    private $goodsDetail;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn()
     */
    private $user;

    /**
     * @var User
     *  @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable = true)
     *
     */
    private $giveTo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

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
     * @var boolean
     * @ORM\Column(name="admin_read", type="boolean")
     */
    private $adminRead;

    /**
     * @var boolean
     * @ORM\Column(name="provider_read",type="boolean")
     */
    private $providerRead;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var boolean
     * @ORM\Column(name="invoice",type="boolean",nullable=true)
     */
    private $invoice;

    /**
     * @var string
     * @ORM\Column(name="pay_no",type="string",length=255,nullable=true)
     */
    private $payNo;


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
     * @param SingleStrade $goodsDetail
     *
     * @return Goods
     */
    public function setGoodsDetail($goodsDetail)
    {
        $this->addGoodsDetail($goodsDetail);

        return $this;
    }

    /**
     * Get goodsDetail
     *
     * @return SingleStrade[] | ArrayCollection
     */
    public function getGoodsDetail()
    {
        return $this->goodsDetail;
    }

    public function addGoodsDetail($goodsDetail){
        if(!$this->goodsDetail->contains($goodsDetail)){
            $this->goodsDetail[] = $goodsDetail;
        }

    }

    public function removeGoodsDetail($goodsDetail){
        if($this->goodsDetail->contains($goodsDetail)){
            $this->goodsDetail->remove($goodsDetail);
        }
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return Goods
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Goods
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        if ($this->updatedAt == null){
            $this->setUpdatedAt($createdAt);
        }

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


    public function __construct()
    {
        $this->setTradeNo('WYDD'.date('YmdHis').rand(1,9999));
        $this->setCreatedAt(new \DateTime('now'));
        $this->goodsDetail = new ArrayCollection();
        $this->setStatus($this::UNPAID);
        $this->setAdminRead();
        $this->setProviderRead();
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Goods
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
     * Set giveTo
     *
     * @param \AppBundle\Entity\User $giveTo
     *
     * @return Goods
     */
    public function setGiveTo(\AppBundle\Entity\User $giveTo = null)
    {
        $this->giveTo = $giveTo;

        return $this;
    }

    /**
     * Get giveTo
     *
     * @return \AppBundle\Entity\User
     */
    public function getGiveTo()
    {
        return $this->giveTo;
    }

    /*public function getAddress(){
        if($this->getGiveTo()){
            return $this->getGiveTo()->getDefaultAddress();
        }
        return $this->getUser()->getDefaultAddress();
    }*/

    public function setAdminRead($read = false){
        $this->adminRead = $read;
        return $this;
    }

    public function getAdminRead(){
        return $this->adminRead;
    }

    public function setProviderRead($read = false){
        $this->providerRead = $read;
        return $this;
    }

    public function getProviderRead(){
        return $this->providerRead;
    }


    public function setAddress($address){
        $this->address = $address;

        return $this;
    }

    public function getAddress(){
        return $this->address;

    }


    /**
     * Set invoice
     *
     * @param boolean $invoice
     *
     * @return Goods
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Get invoice
     *
     * @return boolean
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * Set payNo
     *
     * @param string $payNo
     *
     * @return Goods
     */
    public function setPayNo($payNo)
    {
        $this->payNo = $payNo;

        return $this;
    }

    /**
     * Get payNo
     *
     * @return string
     */
    public function getPayNo()
    {
        return $this->payNo;
    }

    /**
     * @ORM\PostLoad
     * @ORM\PreUpdate
     */
    public function checkStatus(){
        if($this->status == self::UNPAID){
            $date =  $this->createdAt->add(new \DateInterval('P1D'))->format('Y-m-d');
            $testTime = new \DateTime($date.' 03:00');
            $nowTime = new \DateTime('now');
            $interval = $nowTime->diff($testTime);
            if( '-' == $interval->format('%R')){
                $this->setStatus(self::CLOSED);
            }
        }
        return $this;
    }

}
