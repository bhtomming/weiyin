<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\26 0026
 * Time: 16:12
 */

namespace AppBundle\Controller;



use AppBundle\Entity\Goods;
use Doctrine\ORM\EntityNotFoundException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TradeController extends Controller
{
    /**
     * @Route("/trade/{id}",name="view_trade",defaults={"id":0})
     */
    public function createTradeAction(Goods $trade){
        if(!$trade){
            throw new EntityNotFoundException('没有此订单');
        }

        return $this->render('default/trade_create.html.twig',[
            'trade' => $trade,
        ]);
    }



}