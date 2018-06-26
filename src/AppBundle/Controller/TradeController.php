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

/**
 * Class AddressController
 * @package AppBundle\Controller
 * @Route("/trade")
 */
class TradeController extends Controller
{
    /**
     * @Route("/{id}",name="view_trade",defaults={"id":0})
     */
    public function viewTradeAction(Goods $trade){
        if(!$trade){
            throw new EntityNotFoundException('没有此订单');
        }
        $this->denyAccessUnlessGranted('show',$trade,'你无权查看此订单');

        return $this->render('trade/show.html.twig',[
            'trade' => $trade,
        ]);
    }

    public function createTradeApiAction($data){

    }


}