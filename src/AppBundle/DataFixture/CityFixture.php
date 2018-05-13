<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13
 * Time: 14:45
 */

namespace AppBundle\DataFixture;


use AppBundle\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;

class CityFixture extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__.'/../Resources/data/city');
        $citys = array();
        foreach ($finder as $file){
            //$citys = $file->getContents();
            $citys = json_decode($file->getContents(),true);
        }
        foreach ($citys as $code => $name){
            $city = new City();
            $city->setCode($code);
            $city->setName($name);
            $manager->persist($city);
        }
        $manager->flush();
    }
}