<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\4\1 0001
 * Time: 16:07
 */

namespace AppBundle\Form\DataTransFormer;

use AppBundle\Entity\Address;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
class AddressToArrayTransFormer implements DataTransformerInterface
{
   /* protected $manager;

    public function __construct(ObjectManager $manager){
        $this->manager = $manager;
    }*/

    public function transform($collection){
        //把数组集转换成对象
        $address = null;
        $data = null;
        if(!$collection instanceof ArrayCollection){
            return null;
        }

        foreach ($collection as $object){

        if($object == null || is_array($object) || !($object instanceof Address)){
            return null;
        }
        if($object->getIsDefault()){
            $address = $object;
        }

        }
        $address = $collection->last();
        return $address ;

    }

    public function reverseTransform($object)
    {
        //把对象
        if(empty($object)){
            return null;
        }

        return $object;
    }


}