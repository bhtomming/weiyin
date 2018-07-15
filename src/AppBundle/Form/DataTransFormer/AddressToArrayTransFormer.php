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
use Doctrine\ORM\PersistentCollection;
use function PHPSTORM_META\type;
use Symfony\Component\Form\DataTransformerInterface;
class AddressToArrayTransFormer implements DataTransformerInterface
{


   //取数据的时候调用
    public function transform($collection){

        if($collection instanceof Address){
            return $collection;
        }
        if($collection == null){
            return $collection;
        }

        if(/*$collection instanceof ArrayCollection && */$collection->isEmpty()){
            return null;
        }
        //把数组集转换成对象
        foreach ($collection as $object){
            if($object instanceof Address){
                if($object->getIsDefault()){
                    return $object;
                }
            }
        }

        return $collection->last() ;

    }

    //存数据的时候调用
    public function reverseTransform($object)
    {
        //这里存数据不需要处理

        return $object;
    }


}