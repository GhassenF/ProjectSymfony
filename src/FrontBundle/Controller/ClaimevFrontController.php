<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08/04/2019
 * Time: 18:35
 */

namespace FrontBundle\Controller;

use AppBundle\Entity\Claimevent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;


class ClaimevFrontController extends Controller
{

    /**
     * Creates a new claim entity.
     *
     */
    public function forRecAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $claim = new Claimevent();

        $form = $this->createForm('AppBundle\Form\ClaimeventType', $claim);
        $form->handleRequest($request);
        $claim->setStatut("Untreated");
        $claim->setIdUser($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($claim);
            $em->flush();
            return $this->redirectToRoute('navForRec', array('idclaimev' => $claim->getIdclaimev()));
        }

        return $this->render('@Front/navigation/forRec.html.twig',array(
            'claim' => $claim,
            'form' => $form->createView(),
        ));
    }
}