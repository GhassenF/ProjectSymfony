<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 12/04/2019
 * Time: 00:17
 */

namespace FrontBundle\Controller;


use AppBundle\Entity\Actualite;
use AppBundle\Entity\Likes;
use AppBundle\Form\ActualiteType;
use AppBundle\Form\LikesType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ActualitefrontController extends Controller
{
public function affichagedesactualiteAction(){
    //affichaaaaaage 1
    if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) ) {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
    }
    else{
        return $this->redirectToRoute('fos_user_security_login');
    }

    $userrole = '%"ROLE_ADMIN"%';
    $em = $this->getDoctrine()->getManager();
    $actualitee = $em->getRepository('AppBundle:Actualite')->affichetodayactualite($userrole);

    //affiichaaage 2 :
    $categorielist = $em ->getRepository('AppBundle:Category')->listname();
    $categorieevent = "Evénement";
    $categoriearticle = "Article" ;
    $categorieformation ="Formation";

    $em = $this->getDoctrine()->getManager();
    $actparcategorieevent = $em->getRepository(Actualite::class)->affichageparcategory($categorieevent);
    $em = $this->getDoctrine()->getManager();
    $actparcategoriearticle = $em->getRepository(Actualite::class)->affichageparcategory($categoriearticle);
    $em = $this->getDoctrine()->getManager();
    $actparcategorieformation = $em->getRepository(Actualite::class)->affichageparcategory($categorieformation);


    return $this->render('@Front/Actualite/Mainaffichageactualite.html.twig', array(
        "Actualite" => $actualitee,
        "categorieaffichage" => $actparcategorieevent,
        "articleaffichage" => $actparcategoriearticle,
         "formationaffichage" => $actparcategorieformation

    ));
}
public function consulteractualiteinfrontAction($id , Request $request){
    //affichage de top 5 par nombre de like
    $em = $this ->getDoctrine()->getManager();
    $fiveactualite = $em ->getRepository(Actualite::class)->mostliked();






    $isliked = "";
    $reponse= "";
    $em = $this->getDoctrine()->getManager();
    $actualitee = $em->getRepository(Actualite::class)->actualitebyid($id);

    //var_dump($fiveactualite);

    $actid = $request ->get('id');
    $act = $em ->getRepository(Actualite::class)->find($actid);
    $user = $this->get('security.token_storage')->getToken()->getUser();
    //Nobre de like
    $nbrelikecount = $em ->getRepository(Likes::class)->countlikes($actid);

    //Ajout d'une like et l'integration avec Affichage consulter
    $like = new Likes();
    $like->setIdactualite($act);
    $like->setIduser($user);
    //test si déja aimée
    $isliked = $em->getRepository(Likes::class)->likejustonetime($act,$user);


    $form=$this->createForm(LikesType::class,$like);
    $form=$form->handleRequest($request);



    if($form->isValid() && $form->isSubmitted()  && empty($isliked))
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($like);
        $em->flush();
        $nbrelikecountafterflash = $em ->getRepository(Likes::class)->countlikes($actid);

        $act -> setNbrelike($nbrelikecountafterflash);
        $em->persist($act);
        $em->flush();
        return $this->redirect($request->getUri());
    }elseif (!empty($isliked)){
        $reponse="déja aimé";

    }




    return $this->render('@Front/Actualite/actualitefrontconsult.html.twig',Array(
        'Actualite' => $actualitee,
        'form'=>$form->createView(),
        'reponselike' => $reponse ,
        'fivemostliked' =>$fiveactualite

    ));

}
public function testreviewAction(){
    return $this->render('@Front/Actualite/testreview.html.twig');
}
public function affichagepareventAction(){
    $categorienom = "Evénement";

    $em = $this->getDoctrine()->getManager();
    $actualitee = $em->getRepository(Actualite::class)->affichageparcategory($categorienom);
    return $this->render('@Front/Actualite/Mainaffichageactualite.html.twig',Array(
        'Actualitee' => $actualitee
    ));
}
public function ajoutactualitefrontAction(Request $request){
    if( $this->container->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) ) {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
    }
    else{
        return $this->redirectToRoute('fos_user_security_login');
    }

    $actualitee=new Actualite();

    $actualitee ->setUser($user);
    $actualitee ->setDate(new \DateTime('now'));
    $actualitee->setArchivestatut(1);
    $form=$this->createForm(ActualiteType::class,$actualitee);
    $form=$form->handleRequest($request);
    if($form->isValid() && $form->isSubmitted())
    {
        $em = $this->getDoctrine()->getManager();

        $file = $actualitee->getPictures();
        $filename= md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->getParameter('photos_directory'), $filename);
        $actualitee->setPictures($filename);


        //$em=$this->getDoctrine()->getManager();
        //base de donner
        $em->persist($actualitee);
        $em->flush();
        return $this->redirectToRoute('actualitefrontaffichage');

    }

    return $this->render('@Front/Actualite/Ajoutactualiteetab.html.twig', array(
        'form'=>$form->createView()



    ));



}
public function affichageetabcoAction()
{
    $em = $this->getDoctrine()->getManager();

    $user = $this->get('security.token_storage')->getToken()->getUser();
    $user_id = $user->getId();
    $actualitee = $em->getRepository('AppBundle:Actualite')->affactbyadmin($user_id);
    return $this->render('@Front/Actualite/listactualiteEtab.html.twig', array(
        'actualiteetab' => $actualitee));
}
public function modifieractetabAction($id,Request $request){
    $em = $this->getDoctrine()->getManager();
    $actualitee = $em->getRepository(Actualite::class)->find($id);
    $form = $this->createForm(ActualiteType::class, $actualitee);
    $form = $form->handleRequest($request);
    if ($form->isValid() && $form->isSubmitted()) {
        $em = $this->getDoctrine()->getManager();

        $file = $actualitee->getPictures();
        $filename= md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($this->getParameter('photos_directory'), $filename);
        $actualitee->setPictures($filename);



        $em->flush();

        return $this->redirectToRoute('actualiteajouterparetab');
    }


    return $this->render('@Front/Actualite/modifactualiteetab.html.twig', array(
        'form' => $form->createView()
    ));
}
public function suppactetabAction($id){
    $em=$this->getDoctrine()->getManager();
    $actualiteetab=$em->getRepository(Actualite::class)->find($id);
    $em->remove($actualiteetab);
    $em->flush();
    return $this->redirectToRoute('actualiteajouterparetab');
}


}