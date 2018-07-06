<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\7\6 0006
 * Time: 14:48
 */

namespace AppBundle\Event;


class TradeEvents
{
    /** @Event("Symfony\Component\EventDispatcher\GenericEvent") */
    const PRE_PAID='app.trade_paid';
    /** @Event("Symfony\Component\EventDispatcher\GenericEvent") */
    const PRE_CREATE='app.trade_create';

}