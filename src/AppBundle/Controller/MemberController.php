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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
            throw $this->createAccessDeniedException('你无权查看此页面内容');
        }
        return $this->render('member/index.html.twig',array(
            'member' => $member,
        ));
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(){
        $user = $this->get('fos_user.user_manager')->createUser();
    }

    /**
     * @Route("/edit/{id}", name="member_edit")
     */
    public function memberEditAction(Request $request,User $member){
        $editform = $this->createForm('AppBundle\Form\Type\MemberType',$member);
        $editform->handleRequest($request);

        if($editform->isValid() && $editform->isSubmitted()){
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('member');
        }


        return $this->render('member/edit.html.twig',array(
            'member' => $member,
            'edit_form' => $editform->createView(),
        ));
    }

}