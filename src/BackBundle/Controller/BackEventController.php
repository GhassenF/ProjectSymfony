<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 13/04/2019
 * Time: 20:52
 */

namespace BackBundle\Controller;

use AppBundle\Form\EventType;
use AppBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

class BackEventController extends Controller
{
    public function addTechEventAction(Request $request){
        $date=$request->get('Date');
        $date=date_create(date($date));
        $Event = new Event();
        $form = $this->createForm(EventType::class, $Event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            /**
             * @var UploadedFile $file
             */
            $file = $Event->getImagepath();

            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );


            } catch (FileException $e) {
                // ... handle exception if something happens during file upload

            }
            $pt = $this->getParameter('images_directory');

            $Event->setImagepath($pt . $fileName);
            $Event->setDate($date);
            $em = $this->getDoctrine()->getManager();
            $em->persist($Event);
            $em->flush();
            $this->addFlash('info', 'Evenement ajoutĂ©');
            return $this->redirectToRoute('navAddBackEvent');
        }

        return $this->render('@Back/Evenement/addadminevent.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    public function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    public function listeEventBackAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $evenements = $em->getRepository('AppBundle:Event')->findAll();

        return $this->render('@Back/Evenement/backlistevent.html.twig', array("evenements" => $evenements));
    }
    public function backDeleteEventAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $Event = $em->getRepository('AppBundle:Event')->find($id);
        $em->remove($Event);
        $em->flush();
        return $this->redirectToRoute('navListBackEvent');
    }

    public function updateBackEventAction(Request $request)
    {
        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager();
        $evenements = $em->getRepository('AppBundle:Event')->find($id);
        $form = $this->createForm(EventType::class, $evenements);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $date=$request->get('Date');
            $date=date_create(date($date));
            /**
             * @var UploadedFile $file
             */
            $file = $evenements->getImagepath();

            $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );


            } catch (FileException $e) {
                // ... handle exception if something happens during file upload

            }
            $pt = $this->getParameter('images_directory');

            $evenements->setImagepath($pt . $fileName);
            $evenements->setDate($date);
            $em = $this->getDoctrine()->getManager();
            $em->persist($evenements);
            $em->flush();
            return $this->redirectToRoute('navListBackEvent');
        }
        return $this->render('@Back/Evenement/updatebackevent.html.twig', array("Form" => $form->createView()));
    }

    public function listePartBackAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $participants = $em->getRepository('AppBundle:Participant')->findAll();

        return $this->render('@Back/Evenement/listepart.html.twig', array("participants" => $participants));
    }
    public function partDeleteAction(Request $request)
    {
        $cin = $request->get('cin');
        $em = $this->getDoctrine()->getManager();
        $Part = $em->getRepository('AppBundle:Participant')->find($cin);
        $em->remove($Part);
        $em->flush();
        return $this->redirectToRoute('navDeletePart');
    }


}