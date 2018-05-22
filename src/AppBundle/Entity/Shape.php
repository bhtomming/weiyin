<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shape
 *
 * @ORM\Table(name="shape")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShapeRepository")
 */
class Shape
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
     * @ORM\Column(name="neckAround", type="string", length=50, nullable=true)
     */
    private $neckAround;

    /**
     * @var string
     *
     * @ORM\Column(name="neckRoot", type="string", length=50, nullable=true)
     */
    private $neckRoot;

    /**
     * @var string
     *
     * @ORM\Column(name="shoulderLength", type="string", length=50, nullable=true)
     */
    private $shoulderLength;

    /**
     * @var string
     *
     * @ORM\Column(name="preShoulderWidth", type="string", length=50, nullable=true)
     */
    private $preShoulderWidth;

    /**
     * @var string
     *
     * @ORM\Column(name="backSchoulderWidth", type="string", length=50, nullable=true)
     */
    private $backSchoulderWidth;

    /**
     * @var string
     *
     * @ORM\Column(name="shoulderWidth", type="string", length=50, nullable=true)
     */
    private $shoulderWidth;

    /**
     * @var string
     *
     * @ORM\Column(name="chestMiddle", type="string", length=50, nullable=true)
     */
    private $chestMiddle;

    /**
     * @var string
     *
     * @ORM\Column(name="chestLower", type="string", length=50, nullable=true)
     */
    private $chestLower;

    /**
     * @var string
     *
     * @ORM\Column(name="breasWidth", type="string", length=50, nullable=true)
     */
    private $breasWidth;

    /**
     * @var string
     *
     * @ORM\Column(name="chestWidth", type="string", length=50, nullable=true)
     */
    private $chestWidth;

    /**
     * @var string
     *
     * @ORM\Column(name="armRoot", type="string", length=50, nullable=true)
     */
    private $armRoot;

    /**
     * @var string
     *
     * @ORM\Column(name="armUp", type="string", length=50, nullable=true)
     */
    private $armUp;

    /**
     * @var string
     *
     * @ORM\Column(name="armMiddle", type="string", length=50, nullable=true)
     */
    private $armMiddle;

    /**
     * @var string
     *
     * @ORM\Column(name="armLower", type="string", length=50, nullable=true)
     */
    private $armLower;

    /**
     * @var string
     *
     * @ORM\Column(name="trunk", type="string", length=50, nullable=true)
     */
    private $trunk;

    /**
     * @var string
     *
     * @ORM\Column(name="armpit", type="string", length=50, nullable=true)
     */
    private $armpit;

    /**
     * @var string
     *
     * @ORM\Column(name="waistLength", type="string", length=50, nullable=true)
     */
    private $waistLength;

    /**
     * @var string
     *
     * @ORM\Column(name="neckToBreast", type="string", length=50, nullable=true)
     */
    private $neckToBreast;

    /**
     * @var string
     *
     * @ORM\Column(name="neckToWaist", type="string", length=50, nullable=true)
     */
    private $neckToWaist;

    /**
     * @var string
     *
     * @ORM\Column(name="shoulderToBreast", type="string", length=50, nullable=true)
     */
    private $shoulderToBreast;

    /**
     * @var string
     *
     * @ORM\Column(name="waistPreLength", type="string", length=50, nullable=true)
     */
    private $waistPreLength;

    /**
     * @var string
     *
     * @ORM\Column(name="chestHeight", type="string", length=50, nullable=true)
     */
    private $chestHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="armLength", type="string", length=50, nullable=true)
     */
    private $armLength;

    /**
     * @var string
     *
     * @ORM\Column(name="armUpLength", type="string", length=50, nullable=true)
     */
    private $armUpLength;

    /**
     * @var string
     *
     * @ORM\Column(name="armLowerLength", type="string", length=50, nullable=true)
     */
    private $armLowerLength;

    /**
     * @var string
     *
     * @ORM\Column(name="neckToWrist", type="string", length=50, nullable=true)
     */
    private $neckToWrist;

    /**
     * @var string
     *
     * @ORM\Column(name="preWaistJoint", type="string", length=50, nullable=true)
     */
    private $preWaistJoint;

    /**
     * @var string
     *
     * @ORM\Column(name="backWaistJoint", type="string", length=50, nullable=true)
     */
    private $backWaistJoint;

    /**
     * @var string
     *
     * @ORM\Column(name="sitToNeck", type="string", length=50, nullable=true)
     */
    private $sitToNeck;

    /**
     * @var bool
     *
     * @ORM\Column(name="humpback", type="boolean", nullable=true)
     */
    private $humpback;

    /**
     * @var bool
     *
     * @ORM\Column(name="shoulderSlash", type="boolean", nullable=true)
     */
    private $shoulderSlash;

    /**
     * @var string
     *
     * @ORM\Column(name="waist", type="string", length=50)
     */
    private $waist;

    /**
     * @var string
     *
     * @ORM\Column(name="abdomen", type="string", length=50)
     */
    private $abdomen;

    /**
     * @var string
     *
     * @ORM\Column(name="hipline", type="string", length=50)
     */
    private $hipline;

    /**
     * @var string
     *
     * @ORM\Column(name="neckToLap", type="string", length=50)
     */
    private $neckToLap;

    /**
     * @var string
     *
     * @ORM\Column(name="neckToKnee", type="string", length=50)
     */
    private $neckToKnee;

    /**
     * @var string
     *
     * @ORM\Column(name="neckHeight", type="string", length=50)
     */
    private $neckHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="waistHeight", type="string", length=50)
     */
    private $waistHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="crotch", type="string", length=50)
     */
    private $crotch;

    /**
     * @var string
     *
     * @ORM\Column(name="waistToHipline", type="string", length=50)
     */
    private $waistToHipline;

    /**
     * @var bool
     *
     * @ORM\Column(name="belly", type="boolean")
     */
    private $belly;

    /**
     * @var string
     *
     * @ORM\Column(name="legRoot", type="string", length=50, nullable=true)
     */
    private $legRoot;

    /**
     * @var string
     *
     * @ORM\Column(name="legMiddle", type="string", length=50, nullable=true)
     */
    private $legMiddle;

    /**
     * @var string
     *
     * @ORM\Column(name="knee", type="string", length=50, nullable=true)
     */
    private $knee;

    /**
     * @var string
     *
     * @ORM\Column(name="kneeLower", type="string", length=50, nullable=true)
     */
    private $kneeLower;

    /**
     * @var string
     *
     * @ORM\Column(name="legBelly", type="string", length=50, nullable=true)
     */
    private $legBelly;

    /**
     * @var string
     *
     * @ORM\Column(name="ankleUp", type="string", length=50, nullable=true)
     */
    private $ankleUp;

    /**
     * @var string
     *
     * @ORM\Column(name="ankle", type="string", length=50, nullable=true)
     */
    private $ankle;

    /**
     * @var string
     *
     * @ORM\Column(name="legOutLength", type="string", length=50, nullable=true)
     */
    private $legOutLength;

    /**
     * @var string
     *
     * @ORM\Column(name="legInLength", type="string", length=50, nullable=true)
     */
    private $legInLength;

    /**
     * @var string
     *
     * @ORM\Column(name="thigh", type="string", length=50, nullable=true)
     */
    private $thigh;

    /**
     * @var string
     *
     * @ORM\Column(name="waistToAnkle", type="string", length=50, nullable=true)
     */
    private $waistToAnkle;

    /**
     * @var string
     *
     * @ORM\Column(name="hipHeight", type="string", length=50, nullable=true)
     */
    private $hipHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="ankleOut", type="string", length=50, nullable=true)
     */
    private $ankleOut;

    /**
     * @var string
     *
     * @ORM\Column(name="perineum", type="string", length=50, nullable=true)
     */
    private $perineum;

    /**
     * @var string
     *
     * @ORM\Column(name="height", type="string", length=50, nullable=true)
     */
    private $height;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=50, nullable=true)
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="remarks", type="string", length=255, nullable=true)
     */
    private $remarks;

    /**
     * @var bool
     *
     * @ORM\Column(name="keep", type="boolean", nullable=true)
     */
    private $keep;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="shape")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


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
     * Set neckAround
     *
     * @param string $neckAround
     *
     * @return Shape
     */
    public function setNeckAround($neckAround)
    {
        $this->neckAround = $neckAround;

        return $this;
    }

    /**
     * Get neckAround
     *
     * @return string
     */
    public function getNeckAround()
    {
        return $this->neckAround;
    }

    /**
     * Set neckRoot
     *
     * @param string $neckRoot
     *
     * @return Shape
     */
    public function setNeckRoot($neckRoot)
    {
        $this->neckRoot = $neckRoot;

        return $this;
    }

    /**
     * Get neckRoot
     *
     * @return string
     */
    public function getNeckRoot()
    {
        return $this->neckRoot;
    }

    /**
     * Set shoulderLength
     *
     * @param string $shoulderLength
     *
     * @return Shape
     */
    public function setShoulderLength($shoulderLength)
    {
        $this->shoulderLength = $shoulderLength;

        return $this;
    }

    /**
     * Get shoulderLength
     *
     * @return string
     */
    public function getShoulderLength()
    {
        return $this->shoulderLength;
    }

    /**
     * Set preShoulderWidth
     *
     * @param string $preShoulderWidth
     *
     * @return Shape
     */
    public function setPreShoulderWidth($preShoulderWidth)
    {
        $this->preShoulderWidth = $preShoulderWidth;

        return $this;
    }

    /**
     * Get preShoulderWidth
     *
     * @return string
     */
    public function getPreShoulderWidth()
    {
        return $this->preShoulderWidth;
    }

    /**
     * Set backSchoulderWidth
     *
     * @param string $backSchoulderWidth
     *
     * @return Shape
     */
    public function setBackSchoulderWidth($backSchoulderWidth)
    {
        $this->backSchoulderWidth = $backSchoulderWidth;

        return $this;
    }

    /**
     * Get backSchoulderWidth
     *
     * @return string
     */
    public function getBackSchoulderWidth()
    {
        return $this->backSchoulderWidth;
    }

    /**
     * Set shoulderWidth
     *
     * @param string $shoulderWidth
     *
     * @return Shape
     */
    public function setShoulderWidth($shoulderWidth)
    {
        $this->shoulderWidth = $shoulderWidth;

        return $this;
    }

    /**
     * Get shoulderWidth
     *
     * @return string
     */
    public function getShoulderWidth()
    {
        return $this->shoulderWidth;
    }

    /**
     * Set chestMiddle
     *
     * @param string $chestMiddle
     *
     * @return Shape
     */
    public function setChestMiddle($chestMiddle)
    {
        $this->chestMiddle = $chestMiddle;

        return $this;
    }

    /**
     * Get chestMiddle
     *
     * @return string
     */
    public function getChestMiddle()
    {
        return $this->chestMiddle;
    }

    /**
     * Set chestLower
     *
     * @param string $chestLower
     *
     * @return Shape
     */
    public function setChestLower($chestLower)
    {
        $this->chestLower = $chestLower;

        return $this;
    }

    /**
     * Get chestLower
     *
     * @return string
     */
    public function getChestLower()
    {
        return $this->chestLower;
    }

    /**
     * Set breasWidth
     *
     * @param string $breasWidth
     *
     * @return Shape
     */
    public function setBreasWidth($breasWidth)
    {
        $this->breasWidth = $breasWidth;

        return $this;
    }

    /**
     * Get breasWidth
     *
     * @return string
     */
    public function getBreasWidth()
    {
        return $this->breasWidth;
    }

    /**
     * Set chestWidth
     *
     * @param string $chestWidth
     *
     * @return Shape
     */
    public function setChestWidth($chestWidth)
    {
        $this->chestWidth = $chestWidth;

        return $this;
    }

    /**
     * Get chestWidth
     *
     * @return string
     */
    public function getChestWidth()
    {
        return $this->chestWidth;
    }

    /**
     * Set armRoot
     *
     * @param string $armRoot
     *
     * @return Shape
     */
    public function setArmRoot($armRoot)
    {
        $this->armRoot = $armRoot;

        return $this;
    }

    /**
     * Get armRoot
     *
     * @return string
     */
    public function getArmRoot()
    {
        return $this->armRoot;
    }

    /**
     * Set armUp
     *
     * @param string $armUp
     *
     * @return Shape
     */
    public function setArmUp($armUp)
    {
        $this->armUp = $armUp;

        return $this;
    }

    /**
     * Get armUp
     *
     * @return string
     */
    public function getArmUp()
    {
        return $this->armUp;
    }

    /**
     * Set armMiddle
     *
     * @param string $armMiddle
     *
     * @return Shape
     */
    public function setArmMiddle($armMiddle)
    {
        $this->armMiddle = $armMiddle;

        return $this;
    }

    /**
     * Get armMiddle
     *
     * @return string
     */
    public function getArmMiddle()
    {
        return $this->armMiddle;
    }

    /**
     * Set armLower
     *
     * @param string $armLower
     *
     * @return Shape
     */
    public function setArmLower($armLower)
    {
        $this->armLower = $armLower;

        return $this;
    }

    /**
     * Get armLower
     *
     * @return string
     */
    public function getArmLower()
    {
        return $this->armLower;
    }

    /**
     * Set trunk
     *
     * @param string $trunk
     *
     * @return Shape
     */
    public function setTrunk($trunk)
    {
        $this->trunk = $trunk;

        return $this;
    }

    /**
     * Get trunk
     *
     * @return string
     */
    public function getTrunk()
    {
        return $this->trunk;
    }

    /**
     * Set armpit
     *
     * @param string $armpit
     *
     * @return Shape
     */
    public function setArmpit($armpit)
    {
        $this->armpit = $armpit;

        return $this;
    }

    /**
     * Get armpit
     *
     * @return string
     */
    public function getArmpit()
    {
        return $this->armpit;
    }

    /**
     * Set waistLength
     *
     * @param string $waistLength
     *
     * @return Shape
     */
    public function setWaistLength($waistLength)
    {
        $this->waistLength = $waistLength;

        return $this;
    }

    /**
     * Get waistLength
     *
     * @return string
     */
    public function getWaistLength()
    {
        return $this->waistLength;
    }

    /**
     * Set neckToBreast
     *
     * @param string $neckToBreast
     *
     * @return Shape
     */
    public function setNeckToBreast($neckToBreast)
    {
        $this->neckToBreast = $neckToBreast;

        return $this;
    }

    /**
     * Get neckToBreast
     *
     * @return string
     */
    public function getNeckToBreast()
    {
        return $this->neckToBreast;
    }

    /**
     * Set neckToWaist
     *
     * @param string $neckToWaist
     *
     * @return Shape
     */
    public function setNeckToWaist($neckToWaist)
    {
        $this->neckToWaist = $neckToWaist;

        return $this;
    }

    /**
     * Get neckToWaist
     *
     * @return string
     */
    public function getNeckToWaist()
    {
        return $this->neckToWaist;
    }

    /**
     * Set shoulderToBreast
     *
     * @param string $shoulderToBreast
     *
     * @return Shape
     */
    public function setShoulderToBreast($shoulderToBreast)
    {
        $this->shoulderToBreast = $shoulderToBreast;

        return $this;
    }

    /**
     * Get shoulderToBreast
     *
     * @return string
     */
    public function getShoulderToBreast()
    {
        return $this->shoulderToBreast;
    }

    /**
     * Set waistPreLength
     *
     * @param string $waistPreLength
     *
     * @return Shape
     */
    public function setWaistPreLength($waistPreLength)
    {
        $this->waistPreLength = $waistPreLength;

        return $this;
    }

    /**
     * Get waistPreLength
     *
     * @return string
     */
    public function getWaistPreLength()
    {
        return $this->waistPreLength;
    }

    /**
     * Set chestHeight
     *
     * @param string $chestHeight
     *
     * @return Shape
     */
    public function setChestHeight($chestHeight)
    {
        $this->chestHeight = $chestHeight;

        return $this;
    }

    /**
     * Get chestHeight
     *
     * @return string
     */
    public function getChestHeight()
    {
        return $this->chestHeight;
    }

    /**
     * Set armLength
     *
     * @param string $armLength
     *
     * @return Shape
     */
    public function setArmLength($armLength)
    {
        $this->armLength = $armLength;

        return $this;
    }

    /**
     * Get armLength
     *
     * @return string
     */
    public function getArmLength()
    {
        return $this->armLength;
    }

    /**
     * Set armUpLength
     *
     * @param string $armUpLength
     *
     * @return Shape
     */
    public function setArmUpLength($armUpLength)
    {
        $this->armUpLength = $armUpLength;

        return $this;
    }

    /**
     * Get armUpLength
     *
     * @return string
     */
    public function getArmUpLength()
    {
        return $this->armUpLength;
    }

    /**
     * Set armLowerLength
     *
     * @param string $armLowerLength
     *
     * @return Shape
     */
    public function setArmLowerLength($armLowerLength)
    {
        $this->armLowerLength = $armLowerLength;

        return $this;
    }

    /**
     * Get armLowerLength
     *
     * @return string
     */
    public function getArmLowerLength()
    {
        return $this->armLowerLength;
    }

    /**
     * Set neckToWrist
     *
     * @param string $neckToWrist
     *
     * @return Shape
     */
    public function setNeckToWrist($neckToWrist)
    {
        $this->neckToWrist = $neckToWrist;

        return $this;
    }

    /**
     * Get neckToWrist
     *
     * @return string
     */
    public function getNeckToWrist()
    {
        return $this->neckToWrist;
    }

    /**
     * Set preWaistJoint
     *
     * @param string $preWaistJoint
     *
     * @return Shape
     */
    public function setPreWaistJoint($preWaistJoint)
    {
        $this->preWaistJoint = $preWaistJoint;

        return $this;
    }

    /**
     * Get preWaistJoint
     *
     * @return string
     */
    public function getPreWaistJoint()
    {
        return $this->preWaistJoint;
    }

    /**
     * Set backWaistJoint
     *
     * @param string $backWaistJoint
     *
     * @return Shape
     */
    public function setBackWaistJoint($backWaistJoint)
    {
        $this->backWaistJoint = $backWaistJoint;

        return $this;
    }

    /**
     * Get backWaistJoint
     *
     * @return string
     */
    public function getBackWaistJoint()
    {
        return $this->backWaistJoint;
    }

    /**
     * Set sitToNeck
     *
     * @param string $sitToNeck
     *
     * @return Shape
     */
    public function setSitToNeck($sitToNeck)
    {
        $this->sitToNeck = $sitToNeck;

        return $this;
    }

    /**
     * Get sitToNeck
     *
     * @return string
     */
    public function getSitToNeck()
    {
        return $this->sitToNeck;
    }

    /**
     * Set humpback
     *
     * @param boolean $humpback
     *
     * @return Shape
     */
    public function setHumpback($humpback)
    {
        $this->humpback = $humpback;

        return $this;
    }

    /**
     * Get humpback
     *
     * @return bool
     */
    public function getHumpback()
    {
        return $this->humpback;
    }

    /**
     * Set shoulderSlash
     *
     * @param boolean $shoulderSlash
     *
     * @return Shape
     */
    public function setShoulderSlash($shoulderSlash)
    {
        $this->shoulderSlash = $shoulderSlash;

        return $this;
    }

    /**
     * Get shoulderSlash
     *
     * @return bool
     */
    public function getShoulderSlash()
    {
        return $this->shoulderSlash;
    }

    /**
     * Set waist
     *
     * @param string $waist
     *
     * @return Shape
     */
    public function setWaist($waist)
    {
        $this->waist = $waist;

        return $this;
    }

    /**
     * Get waist
     *
     * @return string
     */
    public function getWaist()
    {
        return $this->waist;
    }

    /**
     * Set abdomen
     *
     * @param string $abdomen
     *
     * @return Shape
     */
    public function setAbdomen($abdomen)
    {
        $this->abdomen = $abdomen;

        return $this;
    }

    /**
     * Get abdomen
     *
     * @return string
     */
    public function getAbdomen()
    {
        return $this->abdomen;
    }

    /**
     * Set hipline
     *
     * @param string $hipline
     *
     * @return Shape
     */
    public function setHipline($hipline)
    {
        $this->hipline = $hipline;

        return $this;
    }

    /**
     * Get hipline
     *
     * @return string
     */
    public function getHipline()
    {
        return $this->hipline;
    }

    /**
     * Set neckToLap
     *
     * @param string $neckToLap
     *
     * @return Shape
     */
    public function setNeckToLap($neckToLap)
    {
        $this->neckToLap = $neckToLap;

        return $this;
    }

    /**
     * Get neckToLap
     *
     * @return string
     */
    public function getNeckToLap()
    {
        return $this->neckToLap;
    }

    /**
     * Set neckToKnee
     *
     * @param string $neckToKnee
     *
     * @return Shape
     */
    public function setNeckToKnee($neckToKnee)
    {
        $this->neckToKnee = $neckToKnee;

        return $this;
    }

    /**
     * Get neckToKnee
     *
     * @return string
     */
    public function getNeckToKnee()
    {
        return $this->neckToKnee;
    }

    /**
     * Set neckHeight
     *
     * @param string $neckHeight
     *
     * @return Shape
     */
    public function setNeckHeight($neckHeight)
    {
        $this->neckHeight = $neckHeight;

        return $this;
    }

    /**
     * Get neckHeight
     *
     * @return string
     */
    public function getNeckHeight()
    {
        return $this->neckHeight;
    }

    /**
     * Set waistHeight
     *
     * @param string $waistHeight
     *
     * @return Shape
     */
    public function setWaistHeight($waistHeight)
    {
        $this->waistHeight = $waistHeight;

        return $this;
    }

    /**
     * Get waistHeight
     *
     * @return string
     */
    public function getWaistHeight()
    {
        return $this->waistHeight;
    }

    /**
     * Set crotch
     *
     * @param string $crotch
     *
     * @return Shape
     */
    public function setCrotch($crotch)
    {
        $this->crotch = $crotch;

        return $this;
    }

    /**
     * Get crotch
     *
     * @return string
     */
    public function getCrotch()
    {
        return $this->crotch;
    }

    /**
     * Set waistToHipline
     *
     * @param string $waistToHipline
     *
     * @return Shape
     */
    public function setWaistToHipline($waistToHipline)
    {
        $this->waistToHipline = $waistToHipline;

        return $this;
    }

    /**
     * Get waistToHipline
     *
     * @return string
     */
    public function getWaistToHipline()
    {
        return $this->waistToHipline;
    }

    /**
     * Set belly
     *
     * @param boolean $belly
     *
     * @return Shape
     */
    public function setBelly($belly)
    {
        $this->belly = $belly;

        return $this;
    }

    /**
     * Get belly
     *
     * @return bool
     */
    public function getBelly()
    {
        return $this->belly;
    }

    /**
     * Set legRoot
     *
     * @param string $legRoot
     *
     * @return Shape
     */
    public function setLegRoot($legRoot)
    {
        $this->legRoot = $legRoot;

        return $this;
    }

    /**
     * Get legRoot
     *
     * @return string
     */
    public function getLegRoot()
    {
        return $this->legRoot;
    }

    /**
     * Set legMiddle
     *
     * @param string $legMiddle
     *
     * @return Shape
     */
    public function setLegMiddle($legMiddle)
    {
        $this->legMiddle = $legMiddle;

        return $this;
    }

    /**
     * Get legMiddle
     *
     * @return string
     */
    public function getLegMiddle()
    {
        return $this->legMiddle;
    }

    /**
     * Set knee
     *
     * @param string $knee
     *
     * @return Shape
     */
    public function setKnee($knee)
    {
        $this->knee = $knee;

        return $this;
    }

    /**
     * Get knee
     *
     * @return string
     */
    public function getKnee()
    {
        return $this->knee;
    }

    /**
     * Set kneeLower
     *
     * @param string $kneeLower
     *
     * @return Shape
     */
    public function setKneeLower($kneeLower)
    {
        $this->kneeLower = $kneeLower;

        return $this;
    }

    /**
     * Get kneeLower
     *
     * @return string
     */
    public function getKneeLower()
    {
        return $this->kneeLower;
    }

    /**
     * Set legBelly
     *
     * @param string $legBelly
     *
     * @return Shape
     */
    public function setLegBelly($legBelly)
    {
        $this->legBelly = $legBelly;

        return $this;
    }

    /**
     * Get legBelly
     *
     * @return string
     */
    public function getLegBelly()
    {
        return $this->legBelly;
    }

    /**
     * Set ankleUp
     *
     * @param string $ankleUp
     *
     * @return Shape
     */
    public function setAnkleUp($ankleUp)
    {
        $this->ankleUp = $ankleUp;

        return $this;
    }

    /**
     * Get ankleUp
     *
     * @return string
     */
    public function getAnkleUp()
    {
        return $this->ankleUp;
    }

    /**
     * Set ankle
     *
     * @param string $ankle
     *
     * @return Shape
     */
    public function setAnkle($ankle)
    {
        $this->ankle = $ankle;

        return $this;
    }

    /**
     * Get ankle
     *
     * @return string
     */
    public function getAnkle()
    {
        return $this->ankle;
    }

    /**
     * Set legOutLength
     *
     * @param string $legOutLength
     *
     * @return Shape
     */
    public function setLegOutLength($legOutLength)
    {
        $this->legOutLength = $legOutLength;

        return $this;
    }

    /**
     * Get legOutLength
     *
     * @return string
     */
    public function getLegOutLength()
    {
        return $this->legOutLength;
    }

    /**
     * Set legInLength
     *
     * @param string $legInLength
     *
     * @return Shape
     */
    public function setLegInLength($legInLength)
    {
        $this->legInLength = $legInLength;

        return $this;
    }

    /**
     * Get legInLength
     *
     * @return string
     */
    public function getLegInLength()
    {
        return $this->legInLength;
    }

    /**
     * Set thigh
     *
     * @param string $thigh
     *
     * @return Shape
     */
    public function setThigh($thigh)
    {
        $this->thigh = $thigh;

        return $this;
    }

    /**
     * Get thigh
     *
     * @return string
     */
    public function getThigh()
    {
        return $this->thigh;
    }

    /**
     * Set waistToAnkle
     *
     * @param string $waistToAnkle
     *
     * @return Shape
     */
    public function setWaistToAnkle($waistToAnkle)
    {
        $this->waistToAnkle = $waistToAnkle;

        return $this;
    }

    /**
     * Get waistToAnkle
     *
     * @return string
     */
    public function getWaistToAnkle()
    {
        return $this->waistToAnkle;
    }

    /**
     * Set hipHeight
     *
     * @param string $hipHeight
     *
     * @return Shape
     */
    public function setHipHeight($hipHeight)
    {
        $this->hipHeight = $hipHeight;

        return $this;
    }

    /**
     * Get hipHeight
     *
     * @return string
     */
    public function getHipHeight()
    {
        return $this->hipHeight;
    }

    /**
     * Set ankleOut
     *
     * @param string $ankleOut
     *
     * @return Shape
     */
    public function setAnkleOut($ankleOut)
    {
        $this->ankleOut = $ankleOut;

        return $this;
    }

    /**
     * Get ankleOut
     *
     * @return string
     */
    public function getAnkleOut()
    {
        return $this->ankleOut;
    }

    /**
     * Set perineum
     *
     * @param string $perineum
     *
     * @return Shape
     */
    public function setPerineum($perineum)
    {
        $this->perineum = $perineum;

        return $this;
    }

    /**
     * Get perineum
     *
     * @return string
     */
    public function getPerineum()
    {
        return $this->perineum;
    }

    /**
     * Set height
     *
     * @param string $height
     *
     * @return Shape
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return Shape
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set remarks
     *
     * @param string $remarks
     *
     * @return Shape
     */
    public function setRemarks($remarks)
    {
        $this->remarks = $remarks;

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks()
    {
        return $this->remarks;
    }

    /**
     * Set keep
     *
     * @param boolean $keep
     *
     * @return Shape
     */
    public function setKeep($keep)
    {
        $this->keep = $keep;

        return $this;
    }

    /**
     * Get keep
     *
     * @return bool
     */
    public function getKeep()
    {
        return $this->keep;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Shape
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString()
    {
        return '体型数据'.$this->id;
    }
}
