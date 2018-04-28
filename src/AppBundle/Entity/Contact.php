<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactRepository")
 */
class Contact
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
     * @ORM\Column(name="tel", type="string", length=15, nullable=true)
     */
    private $tel;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=15, nullable=true)
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(name="company_name", type="string", length=255)
     */
    private $companyName;

    /**
     * @var string
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(name="qq", type="string", length=15, nullable=true)
     */
    private $qq;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="weibo", type="string", length=200, nullable=true)
     */
    private $weibo;

    /**
     * @var string
     * @ORM\Column(name="wechat", type="string", length=50, nullable=true)
     */
    private $wechat;


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
     * Set tel
     *
     * @param string $tel
     *
     * @return Contact
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Contact
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     *
     * @return Contact
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Contact
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set qq
     *
     * @param string $qq
     *
     * @return Contact
     */
    public function setQq($qq)
    {
        $this->qq = $qq;

        return $this;
    }

    /**
     * Get qq
     *
     * @return string
     */
    public function getQq()
    {
        return $this->qq;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set weibo
     *
     * @param string $weibo
     *
     * @return Contact
     */
    public function setWeibo($weibo)
    {
        $this->weibo = $weibo;

        return $this;
    }

    /**
     * Get weibo
     *
     * @return string
     */
    public function getWeibo()
    {
        return $this->weibo;
    }

    /**
     * Set wechat
     *
     * @param string $wechat
     *
     * @return Contact
     */
    public function setWechat($wechat)
    {
        $this->wechat = $wechat;

        return $this;
    }

    /**
     * Get wechat
     *
     * @return string
     */
    public function getWechat()
    {
        return $this->wechat;
    }
}
