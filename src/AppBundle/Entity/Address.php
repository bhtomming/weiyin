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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User")
     */
    private $owner;

    /**
     *@var City
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\City")
     *@ORM\JoinColumn()
     */
    private $province;

    /**
     *@var City
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\City")
     * @ORM\JoinColumn()
     */
    private $city;

    /**
     *@var City
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\City")
     * @ORM\JoinColumn()
     */
    private $area;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255)
     */
    private $street;


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
     * @param User $owner
     *
     * @return Address
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
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
        $addr = null === $this->province ? ' ': $this->province->getName().$this->city->getName().$this->area->getName().$this->street;
        return $addr;
    }
}
