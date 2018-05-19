<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\4\1 0001
 * Time: 16:07
 */

namespace AppBundle\Form\DataTransFormer;

use AppBundle\Entity\Address;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
class CityToAddressTransFormer implements DataTransformerInterface
{
    protected $manager;

    public function __construct(ObjectManager $manager){
        $this->manager = $manager;
    }

    public function transform($object){
        //把对象转换成字符串
        if($object == null){
            return null;
        }
        $data['province'] =$object->getProvince();
        $data['city'] = $object->getCity();
        $data['area'] = $object->getArea();
        $data['street'] = $object->getStreet();
        return $object == null ? null : $data;

    }

    public function reverseTransform($arr)
    {
        //把数组转换成对象
        if(empty($arr)){
            return null;
        }
        $address = new Address();
        $address->setProvince($arr['province']);
        $address->setCity($arr['city']);
        $address->setArea($arr['area']);
        $address->setStreet($arr['street']);

        return $address;
    }
}