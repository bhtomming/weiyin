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
     * @ORM\Column(name="neckAround", type="string", length=255, nullable=true)
     */
    private $neckAround;

    /**
     * @var string
     *
     * @ORM\Column(name="neckRoot", type="string", length=255, nullable=true)
     */
    private $neckRoot;

    /**
     * @var string
     *
     * @ORM\Column(name="shoulderLength", type="string", length=255, nullable=true)
     */
    private $shoulderLength;

    /**
     * @var string
     *
     * @ORM\Column(name="preShoulderWidth", type="string", length=255, nullable=true)
     */
    private $preShoulderWidth;

    /**
     * @var string
     *
     * @ORM\Column(name="backSchoulderWidth", type="string", length=255, nullable=true)
     */
    private $backSchoulderWidth;

    /**
     * @var string
     *
     * @ORM\Column(name="shoulderWidth", type="string", length=255, nullable=true)
     */
    private $shoulderWidth;

    /**
     * @var string
     *
     * @ORM\Column(name="chestMiddle", type="string", length=255, nullable=true)
     */
    private $chestMiddle;

    /**
     * @var string
     *
     * @ORM\Column(name="chestLower", type="string", length=255, nullable=true)
     */
    private $chestLower;

    /**
     * @var string
     *
     * @ORM\Column(name="breasWidth", type="string", length=255, nullable=true)
     */
    private $breasWidth;

    /**
     * @var string
     *
     * @ORM\Column(name="chestWidth", type="string", length=255, nullable=true)
     */
    private $chestWidth;

    /**
     * @var string
     *
     * @ORM\Column(name="armRoot", type="string", length=255, nullable=true)
     */
    private $armRoot;

    /**
     * @var string
     *
     * @ORM\Column(name="armUp", type="string", length=255, nullable=true)
     */
    private $armUp;

    /**
     * @var string
     *
     * @ORM\Column(name="armMiddle", type="string", length=255, nullable=true)
     */
    private $armMiddle;

    /**
     * @var string
     *
     * @ORM\Column(name="armLower", type="string", length=255, nullable=true)
     */
    private $armLower;

    /**
     * @var string
     *
     * @ORM\Column(name="trunk", type="string", length=255, nullable=true)
     */
    private $trunk;

    /**
     * @var string
     *
     * @ORM\Column(name="armpit", type="string", length=255, nullable=true)
     */
    private $armpit;

    /**
     * @var string
     *
     * @ORM\Column(name="waistLength", type="string", length=255, nullable=true)
     */
    private $waistLength;

    /**
     * @var string
     *
     * @ORM\Column(name="neckToBreast", type="string", length=255, nullable=true)
     */
    private $neckToBreast;

    /**
     * @var string
     *
     * @ORM\Column(name="neckToWaist", type="string", length=255, nullable=true)
     */
    private $neckToWaist;

    /**
     * @var string
     *
     * @ORM\Column(name="shoulderToBreast", type="string", length=255, nullable=true)
     */
    private $shoulderToBreast;

    /**
     * @var string
     *
     * @ORM\Column(name="waistPreLength", type="string", length=255, nullable=true)
     */
    private $waistPreLength;

    /**
     * @var string
     *
     * @ORM\Column(name="chestHeight", type="string", length=255, nullable=true)
     */
    private $chestHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="armLength", type="string", length=255, nullable=true)
     */
    private $armLength;

    /**
     * @var string
     *
     * @ORM\Column(name="armUpLength", type="string", length=255, nullable=true)
     */
    private $armUpLength;

    /**
     * @var string
     *
     * @ORM\Column(name="armLowerLength", type="string", length=255, nullable=true)
     */
    private $armLowerLength;

    /**
     * @var string
     *
     * @ORM\Column(name="neckToWrist", type="string", length=255, nullable=true)
     */
    private $neckToWrist;

    /**
     * @var string
     *
     * @ORM\Column(name="preWaistJoint", type="string", length=255, nullable=true)
     */
    private $preWaistJoint;

    /**
     * @var string
     *
     * @ORM\Column(name="backWaistJoint", type="string", length=255, nullable=true)
     */
    private $backWaistJoint;

    /**
     * @var string
     *
     * @ORM\Column(name="sitToNeck", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="waist", type="string", length=255)
     */
    private $waist;

    /**
     * @var string
     *
     * @ORM\Column(name="abdomen", type="string", length=255)
     */
    private $abdomen;

    /**
     * @var string
     *
     * @ORM\Column(name="hipline", type="string", length=255)
     */
    private $hipline;

    /**
     * @var string
     *
     * @ORM\Column(name="neckToLap", type="string", length=255)
     */
    private $neckToLap;

    /**
     * @var string
     *
     * @ORM\Column(name="neckToKnee", type="string", length=255)
     */
    private $neckToKnee;

    /**
     * @var string
     *
     * @ORM\Column(name="neckHeight", type="string", length=255)
     */
    private $neckHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="waistHeight", type="string", length=255)
     */
    private $waistHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="crotch", type="string", length=255)
     */
    private $crotch;

    /**
     * @var string
     *
     * @ORM\Column(name="waistToHipline", type="string", length=255)
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
     * @ORM\Column(name="legRoot", type="string", length=255, nullable=true)
     */
    private $legRoot;

    /**
     * @var string
     *
     * @ORM\Column(name="legMiddle", type="string", length=255, nullable=true)
     */
    private $legMiddle;

    /**
     * @var string
     *
     * @ORM\Column(name="knee", type="string", length=255, nullable=true)
     */
    private $knee;

    /**
     * @var string
     *
     * @ORM\Column(name="kneeLower", type="string", length=255, nullable=true)
     */
    private $kneeLower;

    /**
     * @var string
     *
     * @ORM\Column(name="legBelly", type="string", length=255, nullable=true)
     */
    private $legBelly;

    /**
     * @var string
     *
     * @ORM\Column(name="ankleUp", type="string", length=255, nullable=true)
     */
    private $ankleUp;

    /**
     * @var string
     *
     * @ORM\Column(name="ankle", type="string", length=255, nullable=true)
     */
    private $ankle;

    /**
     * @var string
     *
     * @ORM\Column(name="legOutLength", type="string", length=255, nullable=true)
     */
    private $legOutLength;

    /**
     * @var string
     *
     * @ORM\Column(name="legInLength", type="string", length=255, nullable=true)
     */
    private $legInLength;

    /**
     * @var string
     *
     * @ORM\Column(name="thigh", type="string", length=255, nullable=true)
     */
    private $thigh;

    /**
     * @var string
     *
     * @ORM\Column(name="waistToAnkle", type="string", length=255, nullable=true)
     */
    private $waistToAnkle;

    /**
     * @var string
     *
     * @ORM\Column(name="hipHeight", type="string", length=255, nullable=true)
     */
    private $hipHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="ankleOut", type="string", length=255, nullable=true)
     */
    private $ankleOut;

    /**
     * @var string
     *
     * @ORM\Column(name="perineum", type="string", length=255, nullable=true)
     */
    private $perineum;

    /**
     * @var string
     *
     * @ORM\Column(name="height", type="string", length=255, nullable=true)
     */
    private $height;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=255, nullable=true)
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
        $this->neckAround = $this->encrypt($neckAround,$this->id);

        return $this;
    }

    /**
     * Get neckAround
     *
     * @return string
     */
    public function getNeckAround()
    {
        return $this->decrypt($this->neckAround,$this->id);
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
        $this->neckRoot = $this->encrypt($neckRoot,$this->id);

        return $this;
    }

    /**
     * Get neckRoot
     *
     * @return string
     */
    public function getNeckRoot()
    {
        return $this->decrypt($this->neckRoot,$this->id);
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
        $this->shoulderLength = $this->encrypt($shoulderLength,$this->id);

        return $this;
    }

    /**
     * Get shoulderLength
     *
     * @return string
     */
    public function getShoulderLength()
    {
        return $this->decrypt($this->shoulderLength,$this->id);
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
        $this->preShoulderWidth = $this->encrypt($preShoulderWidth,$this->id);

        return $this;
    }

    /**
     * Get preShoulderWidth
     *
     * @return string
     */
    public function getPreShoulderWidth()
    {
        return $this->decrypt($this->preShoulderWidth,$this->id);
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
        $this->backSchoulderWidth = $this->encrypt($backSchoulderWidth,$this->id);

        return $this;
    }

    /**
     * Get backSchoulderWidth
     *
     * @return string
     */
    public function getBackSchoulderWidth()
    {
        return $this->decrypt($this->backSchoulderWidth,$this->id);
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
        $this->shoulderWidth = $this->encrypt($shoulderWidth,$this->id);

        return $this;
    }

    /**
     * Get shoulderWidth
     *
     * @return string
     */
    public function getShoulderWidth()
    {
        return $this->decrypt($this->shoulderWidth,$this->id);
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
        $this->chestMiddle = $this->encrypt($chestMiddle,$this->id);

        return $this;
    }

    /**
     * Get chestMiddle
     *
     * @return string
     */
    public function getChestMiddle()
    {
        return $this->decrypt($this->chestMiddle,$this->id);
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
        $this->chestLower = $this->encrypt($chestLower,$this->id);

        return $this;
    }

    /**
     * Get chestLower
     *
     * @return string
     */
    public function getChestLower()
    {
        return $this->decrypt($this->chestLower,$this->id);
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
        $this->breasWidth = $this->encrypt($breasWidth,$this->id);

        return $this;
    }

    /**
     * Get breasWidth
     *
     * @return string
     */
    public function getBreasWidth()
    {
        return $this->decrypt($this->breasWidth,$this->id);
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
        $this->chestWidth = $this->encrypt($chestWidth,$this->id);

        return $this;
    }

    /**
     * Get chestWidth
     *
     * @return string
     */
    public function getChestWidth()
    {
        return $this->decrypt($this->chestWidth,$this->id);
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
        $this->armRoot = $this->encrypt($armRoot,$this->id);

        return $this;
    }

    /**
     * Get armRoot
     *
     * @return string
     */
    public function getArmRoot()
    {
        return $this->decrypt($this->armRoot,$this->id);
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
        $this->armUp = $this->encrypt($armUp,$this->id);

        return $this;
    }

    /**
     * Get armUp
     *
     * @return string
     */
    public function getArmUp()
    {
        return $this->decrypt($this->armUp,$this->id);
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
        $this->armMiddle = $this->encrypt($armMiddle,$this->id);

        return $this;
    }

    /**
     * Get armMiddle
     *
     * @return string
     */
    public function getArmMiddle()
    {
        return $this->decrypt($this->armMiddle,$this->id);
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
        $this->armLower = $this->encrypt($armLower,$this->id);

        return $this;
    }

    /**
     * Get armLower
     *
     * @return string
     */
    public function getArmLower()
    {
        return $this->decrypt($this->armLower,$this->id);
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
        $this->trunk = $this->encrypt($trunk,$this->id);

        return $this;
    }

    /**
     * Get trunk
     *
     * @return string
     */
    public function getTrunk()
    {
        return $this->decrypt($this->trunk,$this->id);
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
        $this->armpit = $this->encrypt($armpit,$this->id);

        return $this;
    }

    /**
     * Get armpit
     *
     * @return string
     */
    public function getArmpit()
    {
        return $this->decrypt($this->armpit,$this->id);
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
        $this->waistLength = $this->encrypt($waistLength,$this->id);

        return $this;
    }

    /**
     * Get waistLength
     *
     * @return string
     */
    public function getWaistLength()
    {
        return $this->decrypt($this->waistLength,$this->id);
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
        $this->neckToBreast = $this->encrypt($neckToBreast,$this->id);

        return $this;
    }

    /**
     * Get neckToBreast
     *
     * @return string
     */
    public function getNeckToBreast()
    {
        return $this->decrypt($this->neckToBreast,$this->id);
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
        $this->neckToWaist = $this->encrypt($neckToWaist,$this->id);

        return $this;
    }

    /**
     * Get neckToWaist
     *
     * @return string
     */
    public function getNeckToWaist()
    {
        return $this->decrypt($this->neckToWaist,$this->id);
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
        $this->shoulderToBreast = $this->encrypt($shoulderToBreast,$this->id);

        return $this;
    }

    /**
     * Get shoulderToBreast
     *
     * @return string
     */
    public function getShoulderToBreast()
    {
        return $this->decrypt($this->shoulderToBreast,$this->id);
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
        $this->waistPreLength = $this->encrypt($waistPreLength,$this->id);

        return $this;
    }

    /**
     * Get waistPreLength
     *
     * @return string
     */
    public function getWaistPreLength()
    {
        return $this->decrypt($this->waistPreLength,$this->id);
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
        $this->chestHeight = $this->encrypt($chestHeight,$this->id);

        return $this;
    }

    /**
     * Get chestHeight
     *
     * @return string
     */
    public function getChestHeight()
    {
        return $this->decrypt($this->chestHeight,$this->id);
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
        $this->armLength = $this->encrypt($armLength,$this->id);

        return $this;
    }

    /**
     * Get armLength
     *
     * @return string
     */
    public function getArmLength()
    {
        return $this->decrypt($this->armLength,$this->id);
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
        $this->armUpLength = $this->encrypt($armUpLength,$this->id);

        return $this;
    }

    /**
     * Get armUpLength
     *
     * @return string
     */
    public function getArmUpLength()
    {
        return $this->decrypt($this->armUpLength,$this->id);
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
        $this->armLowerLength = $this->encrypt($armLowerLength,$this->id);

        return $this;
    }

    /**
     * Get armLowerLength
     *
     * @return string
     */
    public function getArmLowerLength()
    {
        return $this->decrypt($this->armLowerLength,$this->id);
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
        $this->neckToWrist = $this->encrypt($neckToWrist,$this->id);

        return $this;
    }

    /**
     * Get neckToWrist
     *
     * @return string
     */
    public function getNeckToWrist()
    {
        return $this->decrypt($this->neckToWrist,$this->id);
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
        $this->preWaistJoint = $this->encrypt($preWaistJoint,$this->id);

        return $this;
    }

    /**
     * Get preWaistJoint
     *
     * @return string
     */
    public function getPreWaistJoint()
    {
        return $this->decrypt($this->preWaistJoint,$this->id);
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
        $this->backWaistJoint = $this->encrypt($backWaistJoint,$this->id);

        return $this;
    }

    /**
     * Get backWaistJoint
     *
     * @return string
     */
    public function getBackWaistJoint()
    {
        return $this->decrypt($this->backWaistJoint,$this->id);
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
        $this->sitToNeck = $this->encrypt($sitToNeck,$this->id);

        return $this;
    }

    /**
     * Get sitToNeck
     *
     * @return string
     */
    public function getSitToNeck()
    {
        return $this->decrypt($this->sitToNeck,$this->id);
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
        $this->waist = $this->encrypt($waist,$this->id);

        return $this;
    }

    /**
     * Get waist
     *
     * @return string
     */
    public function getWaist()
    {
        return $this->decrypt($this->waist,$this->id);
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
        $this->abdomen = $this->encrypt($abdomen,$this->id);

        return $this;
    }

    /**
     * Get abdomen
     *
     * @return string
     */
    public function getAbdomen()
    {
        return $this->decrypt($this->abdomen,$this->id);
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
        $this->hipline = $this->encrypt($hipline,$this->id);

        return $this;
    }

    /**
     * Get hipline
     *
     * @return string
     */
    public function getHipline()
    {
        return $this->decrypt($this->hipline,$this->id);
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
        $this->neckToLap = $this->encrypt($neckToLap,$this->id);

        return $this;
    }

    /**
     * Get neckToLap
     *
     * @return string
     */
    public function getNeckToLap()
    {
        return $this->decrypt($this->neckToLap,$this->id);
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
        $this->neckToKnee = $this->encrypt($neckToKnee,$this->id);

        return $this;
    }

    /**
     * Get neckToKnee
     *
     * @return string
     */
    public function getNeckToKnee()
    {
        return $this->decrypt($this->neckToKnee,$this->id);
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
        $this->neckHeight = $this->encrypt($neckHeight,$this->id);

        return $this;
    }

    /**
     * Get neckHeight
     *
     * @return string
     */
    public function getNeckHeight()
    {
        return $this->decrypt($this->neckHeight,$this->id);
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
        $this->waistHeight = $this->encrypt($waistHeight,$this->id);

        return $this;
    }

    /**
     * Get waistHeight
     *
     * @return string
     */
    public function getWaistHeight()
    {
        return $this->decrypt($this->waistHeight,$this->id);
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
        $this->crotch = $this->encrypt($crotch,$this->id);

        return $this;
    }

    /**
     * Get crotch
     *
     * @return string
     */
    public function getCrotch()
    {
        return $this->decrypt($this->crotch,$this->id);
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
        $this->waistToHipline = $this->encrypt($waistToHipline,$this->id);

        return $this;
    }

    /**
     * Get waistToHipline
     *
     * @return string
     */
    public function getWaistToHipline()
    {
        return $this->decrypt($this->waistToHipline,$this->id);
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
        $this->legRoot = $this->encrypt($legRoot,$this->id);

        return $this;
    }

    /**
     * Get legRoot
     *
     * @return string
     */
    public function getLegRoot()
    {
        return $this->decrypt($this->legRoot,$this->id);
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
        $this->legMiddle = $this->encrypt($legMiddle,$this->id);

        return $this;
    }

    /**
     * Get legMiddle
     *
     * @return string
     */
    public function getLegMiddle()
    {
        return $this->decrypt($this->legMiddle,$this->id);
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
        $this->knee = $this->encrypt($knee,$this->id);

        return $this;
    }

    /**
     * Get knee
     *
     * @return string
     */
    public function getKnee()
    {
        return $this->decrypt($this->knee,$this->id);
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
        $this->kneeLower = $this->encrypt($kneeLower,$this->id);

        return $this;
    }

    /**
     * Get kneeLower
     *
     * @return string
     */
    public function getKneeLower()
    {
        return $this->decrypt($this->kneeLower,$this->id);
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
        $this->legBelly = $this->encrypt($legBelly,$this->id);

        return $this;
    }

    /**
     * Get legBelly
     *
     * @return string
     */
    public function getLegBelly()
    {
        return $this->decrypt($this->legBelly,$this->id);
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
        $this->ankleUp = $this->encrypt($ankleUp,$this->id);

        return $this;
    }

    /**
     * Get ankleUp
     *
     * @return string
     */
    public function getAnkleUp()
    {
        return $this->decrypt($this->ankleUp,$this->id);
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
        $this->ankle = $this->encrypt($ankle,$this->id);

        return $this;
    }

    /**
     * Get ankle
     *
     * @return string
     */
    public function getAnkle()
    {
        return $this->decrypt($this->ankle,$this->id);
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
        $this->legOutLength = $this->encrypt($legOutLength,$this->id);

        return $this;
    }

    /**
     * Get legOutLength
     *
     * @return string
     */
    public function getLegOutLength()
    {
        return $this->decrypt($this->legOutLength,$this->id);
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
        $this->legInLength = $this->encrypt($legInLength,$this->id);

        return $this;
    }

    /**
     * Get legInLength
     *
     * @return string
     */
    public function getLegInLength()
    {
        return $this->decrypt($this->legInLength,$this->id);
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
        $this->thigh = $this->encrypt($thigh,$this->id);

        return $this;
    }

    /**
     * Get thigh
     *
     * @return string
     */
    public function getThigh()
    {
        return $this->decrypt($this->thigh,$this->id);
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
        $this->waistToAnkle = $this->encrypt($waistToAnkle,$this->id);

        return $this;
    }

    /**
     * Get waistToAnkle
     *
     * @return string
     */
    public function getWaistToAnkle()
    {
        return $this->decrypt($this->waistToAnkle,$this->id);
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
        $this->hipHeight = $this->encrypt($hipHeight,$this->id);

        return $this;
    }

    /**
     * Get hipHeight
     *
     * @return string
     */
    public function getHipHeight()
    {
        return $this->decrypt($this->hipHeight,$this->id);
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
        $this->ankleOut = $this->encrypt($ankleOut,$this->id);

        return $this;
    }

    /**
     * Get ankleOut
     *
     * @return string
     */
    public function getAnkleOut()
    {
        return $this->decrypt($this->ankleOut,$this->id);
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
        $this->perineum = $this->encrypt($perineum,$this->id);

        return $this;
    }

    /**
     * Get perineum
     *
     * @return string
     */
    public function getPerineum()
    {
        return $this->decrypt($this->perineum,$this->id);
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
        $this->height = $this->encrypt($height,$this->id);

        return $this;
    }

    /**
     * Get height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->decrypt($this->height,$this->id);
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
        $this->weight = $this->encrypt($weight,$this->id);

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->decrypt($this->weight,$this->id);
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
        $this->remarks = $this->encrypt($remarks,$this->id);

        return $this;
    }

    /**
     * Get remarks
     *
     * @return string
     */
    public function getRemarks()
    {
        return $this->decrypt($this->remarks,$this->id);
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
        return $this->user->getUsername().'的体型数据';
    }

    public function encrypt($data, $key)
    {
        $key    =   md5($key);
        $x      =   0;
        $len    =   strlen($data);
        $l      =   strlen($key);
        $char = '';
        $str = '';
        for ($i = 0; $i < $len; $i++)
        {
            if ($x == $l)
            {
                $x = 0;
            }
            $char .= $key{$x};
            $x++;
        }
        for ($i = 0; $i < $len; $i++)
        {
            $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
        }
        return base64_encode($str);
    }

    public function decrypt($data, $key)
    {
        $key = md5($key);
        $x = 0;
        $data = base64_decode($data);
        $len = strlen($data);
        $l = strlen($key);
        $char = '';
        $str = '';
        for ($i = 0; $i < $len; $i++)
        {
            if ($x == $l)
            {
                $x = 0;
            }
            $char .= substr($key, $x, 1);
            $x++;
        }
        for ($i = 0; $i < $len; $i++)
        {
            if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))
            {
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            }
            else
            {
                $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }
        return $str;
    }
}
