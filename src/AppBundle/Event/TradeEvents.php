<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\7\6 0006
 * Time: 14:48
 */

namespace AppBundle\Event;


use AppBundle\Entity\Goods;
use Symfony\Component\EventDispatcher\Event;

class TradeEvents extends Event
{
    /** @Event("Symfony\Component\EventDispatcher\GenericEvent") */
    const PRE_PAID='app.trade_paid';
    /** @Event("Symfony\Component\EventDispatcher\GenericEvent") */
    const PRE_CREATE='app.trade_create';
    protected $goods;

    public function __construct(Goods $goods)
    {
        $this->goods = $goods;
    }

    public function getGoods(){
        return $this->goods;
    }


}