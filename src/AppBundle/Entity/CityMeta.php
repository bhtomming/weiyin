<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\23 0023
 * Time: 16:21
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

Abstract  class CityMeta
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=12)
     */
    protected $code;


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
     * Set name
     *
     * @param string $name
     *
     * @return CityMeta
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return CityMeta
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function isGovernment(){
        if('110000' == $this->code || '310000' == $this->code || '500000' == $this->code || '120000' == $this->code){
            return true;
        }
        return false;
    }

}