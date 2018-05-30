<?php

namespace AppBundle\Repository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param integer $num
     * @param array $order
     */
    public function findMax($num, $order){
        $query = $this->createQueryBuilder('p')
            ->where('p.isFront = true')
            ->andWhere('p.selling = true')
            ->orderBy('p.'.$order[0],$order[1])
            ->getQuery()
        ;
        return $query->setMaxResults($num)->getResult();
    }
}
