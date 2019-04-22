<?php
/**
 * Created by PhpStorm.
 * User: linda
 * Date: 09/04/2019
 * Time: 12:26
 */

namespace FrontBundle\Controller;


use AppBundle\Entity\Formation;
use AppBundle\Entity\Participantformation;
use AppBundle\Form\FormationType;


use AppBundle\Form\PartForType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class FormationFrontController extends Controller

{
    public function forRobAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $formations = $em->getRepository('AppBundle:Formation')->findAll();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $formations,
            $request->query->getInt('page',1),
            $request->query->getInt('page',6)
        );

        return $this->render('@Front/navigation/forRob.html.twig', array(
            'formations' => $result,
        ));

    }


    public function addForAction(Request $request){

        $Formation = new Formation();

        $form = $this->createForm(FormationType::class,$Formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            //echo 'suite au clic sur le submit';

            $Formation->setUserId($this->getUser()->getId());
            $em= $this->getDoctrine()->getManager();
            $em->persist($Formation);
            $em->flush();
            return $this->redirectToRoute('navForRob');
        }
        return $this->render('@Front/navigation/ajoutFor.html.twig',
            array("form"=>$form->createView()));
    }
    public function ModifierForAction(Request $request,$id){

        $em= $this->getDoctrine()->getManager();
        $Formation= $em->getRepository('AppBundle:Formation')->find($id);

        $form=$this->createForm( FormationType::class,$Formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $em= $this->getDoctrine()->getManager();
            $em->persist($Formation);
            $em->flush();

            return $this->redirectToRoute('navForRob');
        }
        return $this->render('@Front/navigation/ModifierFor.html.twig',
            array("form"=>$form->createView()));

    }
    public function supprimerForAction(Request $request , $id){

        $em = $this->getDoctrine()->getManager();
        $Formation = $em->getRepository('AppBundle:Formation')->find($id);
        $em->remove($Formation);
        $em->flush();//pour confirmer la supression
        return $this->redirectToRoute('navForRob');
    }
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST')) {
            $titre = $request->get('titre');
            $formations = $em->getRepository('AppBundle:Formation')
                ->findBy(array(
                    "titre" => $titre
                ));
            return $this->render('@Front/navigation/searchFor.html.twig',
                array("formations" => $formations));
        }
    }

    public function profileAction(Request $request)
    {

        $partForm = new Participantformation();

        $form = $this->createForm(PartForType::class,$partForm);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $partForm->setNom($this->getUser()->getUsername());
            $partForm->setMail($this->getUser()->getEmail());

            $em= $this->getDoctrine()->getManager();
            $em->persist($partForm);
            $em->flush();
            return $this->redirectToRoute('navForRob');
        }

        return $this->render('@Front/Default/profile.html.twig',
            array(
                "form"=>$form->createView()
            ));
    }
    public function participerForAction(Request $request)
    {

        $partFor = new Participantformation();

        $form = $this->createForm(PartForType::class,$partFor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            // $partFor->setUserId($this->getUser()->getId());

            $em= $this->getDoctrine()->getManager();
            $em->persist($partFor);
            $em->flush();
            return $this->redirectToRoute('navForRob');
        }
        return $this->render('@Front/navigation/partFor.html.twig',
            array("form"=>$form->createView()));
    }

}