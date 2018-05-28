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
use Symfony\Component\Form\DataTransformerInterface;
class AddressToArrayTransFormer implements DataTransformerInterface
{
   /* protected $manager;

    public function __construct(ObjectManager $manager){
        $this->manager = $manager;
    }*/

   //取数据的时候调用
    public function transform($collection){
        //把数组集转换成对象

        if($collection instanceof Address){

            return $collection;
        }

        //var_dump(get_class($collection));die();
        if($collection instanceof ArrayCollection && $collection->isEmpty() || $collection instanceof PersistentCollection ){
            return null;
        }
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