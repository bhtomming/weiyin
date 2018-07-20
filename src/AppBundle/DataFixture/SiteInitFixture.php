<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/13
 * Time: 14:45
 */

namespace AppBundle\DataFixture;


use AppBundle\Entity\Area;
use AppBundle\Entity\City;
use AppBundle\Entity\Company;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Menu;
use AppBundle\Entity\Province;
use AppBundle\Entity\Region;
use AppBundle\Entity\Settings;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;

class SiteInitFixture extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->initCityData($manager);
        $this->initMenu($manager);
        $this->initSittings($manager);
        $this->initRegion($manager);
        $this->initContact($manager);
        $this->initCompany($manager);
    }

    public function initCityData(ObjectManager $manager){
        $finder = new Finder();
        $finder->files()->in(__DIR__.'/../Resources/data/city');
        $citys = array();
        foreach ($finder as $file){
            //$citys = $file->getContents();
            $citys = json_decode($file->getContents(),true);
        }
        foreach ($citys as $code => $name){
            if(preg_match('/^[\d]{2}0000$/',$code)){
                $province = new Province();
                $province->setCode($code);
                $province->setName($name);
                $manager->persist($province);
            } else if(preg_match('/^[\d]{4}00$/',$code)) {
                $city = new City();
                $city->setCode($code);
                $city->setName($name);
                $manager->persist($city);
            }else{
                $area = new Area();
                $area->setCode($code);
                $area->setName($name);
                $manager->persist($area);
            }

        }
        $manager->flush();
    }

    public function initMenu(ObjectManager $manager){
        $menus = ['主页','服饰','品牌','联系我们','会员'];
        foreach ($menus as $name){
            $menu = new Menu();
            $menu->setName($name);
            $manager->persist($menu);
        }
        $manager->flush();
    }

    public function initSittings(ObjectManager $manager){
        $setting = new Settings();
        $setting->setSiteName('北海未因服饰有限公司');
        $manager->persist($setting);
        $manager->flush();
    }

    public function initRegion(ObjectManager $manager){
        $region = new Region();
        $region->setContent('新店刚开张...');
        $manager->persist($region);
        $manager->flush();
    }

    public function initContact(ObjectManager $manager){
        $contact = new Contact();
        $contact->setContent('敬请期待...');
        $manager->persist($contact);
        $manager->flush();
    }

    public function initCompany(ObjectManager $manager){
        $content = new Company();
        $content->setTitle('未因品牌');
        $content->setContent('品牌服饰正在装修...');
        $manager->persist($content);
        $manager->flush();
    }
}