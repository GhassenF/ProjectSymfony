<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09/04/2019
 * Time: 02:27
 */

namespace BackBundle\Controller;

use AppBundle\Entity\Claimevent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BackBundle\Repository\ClaimRepository;
use UserBundle\Entity\User;


class ClaimevBackController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $claims = $em->getRepository('AppBundle:Claimevent')->findAll();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $claims,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',5)
        );

        return $this->render('@Back/ClaimBack/claimAdmin.html.twig', array(
            'claims' => $result,
        )); $em = $this->getDoctrine()->getManager();

        $claims = $em->getRepository('AppBundle:Claimevent')->findAll();

        return $this->render('@Back/ClaimBack/claimAdmin.html.twig', array(
            'claims' => $result,
        ));
    }



    public function sortAction(Request $request,$sort)
    {
        $entityManager = $this->getDoctrine()->getManager();

        if ($sort=='ASC'){
            $query = $entityManager->createQuery(
                'SELECT c
    FROM AppBundle:Claimevent c
    ORDER BY c.claimdate ASC'
            );
        }else {
            $query = $entityManager->createQuery(
                'SELECT c
    FROM AppBundle:Claimevent c
    ORDER BY c.claimdate DESC'
            );
        }


        $claims = $query->getResult();

        ////////////////////////////////////

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $claims,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',5)
        );
        //////////////////////////////

        return $this->render('@Back/ClaimBack/claimAdmin.html.twig', array(
            'claims' => $result,
        ));
    }


    /**
     * Creates a form to delete a claim entity.
     *
     * @param Claimevent $claim The claim entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Claimevent $claim)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('claim_delete', array('idclaim' => $claim->getIdclaimev())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function deleteAction(Request $request, Claimevent $claim)
    {
        $form = $this->createDeleteForm($claim);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($claim);
            $em->flush();
        }

        return $this->redirectToRoute('claim_index');
    }

    public function showAction(Claimevent $claim)
    {

        $deleteForm = $this->createDeleteForm($claim);

        return $this->render('@Back/ClaimBack/show.html.twig', array(
            'claim' => $claim,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function approveAction($idclaimev)
    {

        $em=$this->getDoctrine()->getManager();
        $claim=$em->getRepository('AppBundle:Claimevent')->find($idclaimev);
        $claim->setStatut('Approved');
        $em->persist($claim);
        $em->flush();



        return $this->redirectToRoute('claim_index');

        return $this->render('@Back/ClaimBack/index.html.twig', array(
            'claim' => $claim
        ));
    }
    public function ignoreAction($idclaimev)
    {

        $em=$this->getDoctrine()->getManager();
        $claim=$em->getRepository('AppBundle:Claimevent')->find($idclaimev);
        $claim->setStatut('Unapproved');
        $em->persist($claim);
        $em->flush();



        return $this->redirectToRoute('claim_index');
        return $this->render('@Back/ClaimBack/index.html.twig', array(
            'claim' => $claim
        ));
    }

    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $Claim =  $em->getRepository('AppBundle:Claimevent')->findEntitiesByString($requestString);
        if(!$Claim) {
            $result['Claim']['error'] = "Post Not found 😞 ";
        } else {
            $result['Claim'] = $this->getRealEntities($Claim);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($Claim){
        foreach ($Claim as $Claim){
            $realEntities[$Claim->getIdclaimev()] = $Claim->getObject();
        }
        return $realEntities;
    }

    public function blockAction($idclaimev)
    {

        $em=$this->getDoctrine()->getManager();
        $claim=$em->getRepository('AppBundle:Claimevent')->find($idclaimev);
        $claim->setStatut('Bloqué');
        $em->persist($claim);
        $user = $claim->getIdUser();
        $em=$this->getDoctrine()->getManager();
        $ut=$em->getRepository('UserBundle:User')->find($user);


        $ut->setEnabled(0);
        $em->persist($ut);
        $em->flush();

        return $this->redirectToRoute('claim_index');

        return $this->render('@Back/ClaimBack/index.html.twig', array(
            'claim' => $claim
        ));
    }


    public function deblockAction($idclaimev)
    {

        $em=$this->getDoctrine()->getManager();
        $claim=$em->getRepository('AppBundle:Claimevent')->find($idclaimev);
        $claim->setStatut('debloqué');
        $em->persist($claim);
        $user = $claim->getIdUser();
        $em=$this->getDoctrine()->getManager();
        $ut=$em->getRepository('UserBundle:User')->find($user);


        $ut->setEnabled(1);
        $em->persist($ut);
        $em->flush();

        return $this->redirectToRoute('claim_index');

        return $this->render('@Back/ClaimBack/index.html.twig', array(
            'claim' => $claim
        ));
    }

}