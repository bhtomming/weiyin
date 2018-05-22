<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\AttributeOverrides;
use Doctrine\ORM\Mapping\AttributeOverride;
use Doctrine\ORM\Mapping\Column;
use FOS\UserBundle\Model\User as FOSUser;
use Symfony\Component\Validator\Constraints\Date;

/**
 *  User
 * @AttributeOverrides({
 *      @AttributeOverride(name="email",
 *          column=@Column(
 *              name = "email",
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
     * @ORM\Column(name="phone", type="string", length=11, nullable=true, unique=true)
     */
    private $phone;

    /**
     * @var Address
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Address",cascade={"persist"})
     */
    private $address;

    /**
     * @var Date
     * @ORM\Column(name="birthday", nullable=true, type="date")
     */
    private $birthday;

    /**
     * @var User[] | ArrayCollection
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User",inversedBy="users",cascade={"persist"})
     * @ORM\JoinTable(name="user_friends")
     */
    private $friends;

    /**
     * @var Shape[] | ArrayCollection
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Shape", cascade={"persist"})
     * @ORM\JoinTable(name="user_shape")
     */
    private $shape;



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




    public function setBirthday(\DateTime $birthday){
        $this->birthday = $birthday;
        return $this;
    }

    public function getBirthday(){
        return $this->birthday;
    }

    public function __construct(){
        $this->friends = new ArrayCollection();
        $this->shape = new ArrayCollection();
        parent::__construct();
    }

    public function addFriends(User $friend){
        if($this->shape->contains($friend)){
            return $this;
        }
        $this->friends[] = $friend;
        return $this;
    }

    public function removeFriends(User $friend){
        $this->friends->remove($friend);
        return $this;
    }

    public function setFriends(User $friend){
        $this->addFriends($friend);
        return $this;
    }

    public function getFriends(){
        return $this->friends;
    }

    public function addShape(Shape $shape){
        if($this->shape->contains($shape)){
            return $this;
        }
        $this->shape[] = $shape;
        return $this;
    }

    public function setShape(Shape $shape){
        $this->addShape($shape);
        return $this;
    }

    public function getShape(){
        return $this->shape;
    }

}

