<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\10 0010
 * Time: 15:10
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Goods;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class MemberController
 * @package AppBundle\Controller
 * @Route("/member")
 */
class MemberController extends Controller
{
    /**
     * @Route("/", name="member")
     */
    public function indexAction(){
        return $this->redirectToRoute('member_profile',['id'=> $this->getUser()->getId()]);
    }

    /**
     *  @Route("/{id}", name="member_profile")
     */
    public function profileAction(User $member){
        if($this->getUser() != $member){
            return $this->render('member/alc.html.twig');
        }
        return $this->render('member/index.html.twig',array(
            'member' => $member,
        ));
    }

    /**
     * @Route("/trade/list", name="trade_list")
     */
    public function tradeListAction(){
        $em = $this->getDoctrine()->getManager();
        $trades = $em->getRepository(Goods::class)->findBy(array('user'=>$this->getUser()->getId()));
        return $this->render('member/trade_list.html.twig',[
            'trades' => $trades
            ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(){
        $user = $this->get('fos_user.user_manager')->createUser();
    }

}