<?php
/**
 * Created by Drupai.
 * User: 烽行天下
 * Date: 2018\5\26 0026
 * Time: 14:07
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Address;
use AppBundle\Form\Type\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class AddressController
 * @package AppBundle\Controller
 * @Route("/address")
 */
class AddressController extends Controller
{
    /**
     * Creates a new address entity.
     *
     * @Route("/new", name="address_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $address = new Address();
        $form = $this->createForm(AddressType::class, $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();
            $address->setUser($this->getUser());
            $user->setAddress($address);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('member');
        }

        return $this->render('address/new.html.twig', array(
            'address' => $address,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="edit_address")
     * @Method({"GET", "POST"})
     */
    public function editAddressAction(Request $request, Address $address){
        $editForm = $this->createForm('AppBundle\Form\Type\AddressType', $address);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $address = $editForm->getData();
            if($address->getIsDefault()){
                $address->getUser()->setDefaultAddress($address);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('member_profile', array('id' => $address->getUser()->getId()));
        }

        return $this->render('address/edit.html.twig', array(
            'address' => $address,
            'edit_form' => $editForm->createView(),
        ));
    }


    /**
     * Deletes a address entity.
     *
     * @Route("/{id}", name="address_delete")
     *
     */
    public function deleteAction( Address $address)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($address);
        $em->flush();
        return $this->redirectToRoute('member');
    }

}