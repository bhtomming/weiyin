<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Settings
 *
 * @ORM\Table(name="settings")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SettingsRepository")
 */
class Settings
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
     * @ORM\Column(name="siteName", type="string", length=200)
     */
    private $siteName;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=30, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="beian", type="string", length=20, nullable=true)
     */
    private $beian;

    /**
     * @var string
     *
     * @ORM\Column(name="copyRight", type="string", length=150, nullable=true)
     */
    private $copyRight;


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
     * Set siteName
     *
     * @param string $siteName
     *
     * @return Settings
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;

        return $this;
    }

    /**
     * Get siteName
     *
     * @return string
     */
    public function getSiteName()
    {
        return $this->siteName;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Settings
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Settings
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
     * Set address
     *
     * @param string $address
     *
     * @return Settings
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
     * Set beian
     *
     * @param string $beian
     *
     * @return Settings
     */
    public function setBeian($beian)
    {
        $this->beian = $beian;

        return $this;
    }

    /**
     * Get beian
     *
     * @return string
     */
    public function getBeian()
    {
        return $this->beian;
    }

    /**
     * Set copyRight
     *
     * @param string $copyRight
     *
     * @return Settings
     */
    public function setCopyRight($copyRight)
    {
        $this->copyRight = $copyRight;

        return $this;
    }

    /**
     * Get copyRight
     *
     * @return string
     */
    public function getCopyRight()
    {
        return $this->copyRight;
    }
}

