<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\AttributeOverrides;
use Doctrine\ORM\Mapping\AttributeOverride;
use Doctrine\ORM\Mapping\Column;
use FOS\UserBundle\Model\User as FOSUser;

/**
 *  User
 * @AttributeOverrides({
 *      @AttributeOverride(name="email",
 *          column=@Column(
 *              name     = "email",
 *              nullable = true,
 *          )
 *      ),
 *     @AttributeOverride(name="emailCanonical",
 *         column=@Column(
 *              name = "emailCanonical",
 *              nullable = true,
 *          )
 *     )
 * })
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 *
 */
class User extends FOSUser
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
     * @ORM\Column(name="sex", type="string", nullable=true, length=2)
     */
    private $sex;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=11, unique=true)
     */
    private $phone;

    /**
     * @var Address
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Address",cascade={"persist"})
     * @ORM\JoinTable(name="user_address")
     * @ORM\OrderBy({"id":"ASC"}))
     */
    private $address;



    /**
     * Set sex
     *
     * @param boolean $sex
     *
     * @return User
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
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
     * @param Address $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    public function setRole($roles)
    {
        if(!is_array($roles)){
            $roles = explode(',',$roles);
        }
        parent::setRoles($roles); // TODO: Change the autogenerated stub
    }

    public function getRole()
    {
        $roles =  parent::getRoles();

        return implode(',',$roles);
    }



}

