<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressRepository")
 */
class Address
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     *
     */
    private $user;

    /**
     *@var City
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Province")
     * @ORM\JoinColumn()
     */
    private $province;

    /**
     *@var City
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\City")
     * @ORM\JoinColumn(nullable=true)
     */
    private $city;

    /**
     *@var City
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Area")
     * @ORM\JoinColumn(nullable=true)
     */
    private $area;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;

    /**
     * @var boolean
     * @ORM\Column(name="is_default",type="boolean", nullable=true)
     */
    private $isDefault;


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
     * Set addressStreet
     *
     * @param string $addressStreet
     *
     * @return Address
     */
    public function setStreet($addressStreet)
    {
        $this->street = $addressStreet;

        return $this;
    }

    /**
     * Get addressStreet
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    public function getProvince(){
        return $this->province;
    }

    /**
     * @param City $province
     * @return $this
     */
    public function setProvince($province = null){
        $this->province = $province;
        return $this;
    }

    /**
     * @param City $city
     * @return $this
     */
    public function setCity($city = null)
    {
        $this->city = $city;

        return $this;
    }


    public function getCity()
    {
        return $this->city;
    }


    /**
     * @param City $area
     * @return $this
     */
    public function setArea($area = null)
    {
        $this->area = $area;

        return $this;
    }


    public function getArea()
    {
        return $this->area;
    }

    public function __toString()
    {
        $addr = $this->getProvince() .$this->getCity() .$this->getArea() .$this->street;

        return $addr;
    }

    /**
     * @param User $user
     */
    public function setUser($user){
        $this->user = $user;
        return;
    }

    public function getUser(){
        return $this->user;
    }

    public function setIsDefault($isDefault){
        $this->isDefault = $isDefault;
        return $this;
    }

    public function getIsDefault(){
        return $this->isDefault;
    }
}
