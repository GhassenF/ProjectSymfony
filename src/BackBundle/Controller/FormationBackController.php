<?php
/**
 * Created by PhpStorm.
 * User: linda
 * Date: 15/04/2019
 * Time: 22:19
 */

namespace BackBundle\Controller;


use AppBundle\Form\FormationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FormationBackController extends Controller
{
    public function listeForAction(){
        $em = $this->getDoctrine()->getManager();

        $formations = $em->getRepository('AppBundle:Formation')->findAll();
        return $this->render('@Back/navigation/listeFor.html.twig', array(
            'formations' => $formations,
        ));

    }
    public function modifierForAction(Request $request)
    {
        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager();
        $formations = $em->getRepository('AppBundle:Formation')->find($id);
        $form = $this->createForm(FormationType::class, $formations);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $date=$request->get('Date');
            $date=date_create(date($date));
            $formations->setDateDebut($date);
            $formations->setDateFin($date);
            $em = $this->getDoctrine()->getManager();
            $em->persist($formations);
            $em->flush();
            return $this->redirectToRoute('listeLinda');
        }
        return $this->render('@Back/navigation/modifierFor.html.twig', array("Form" => $form->createView()));
    }

    public function supprimerForAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $formations = $em->getRepository('AppBundle:Formation')->find($id);
        $em->remove($formations);
        $em->flush();
        return $this->redirectToRoute('listeLinda');
    }


}