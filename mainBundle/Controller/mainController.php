<?php

namespace mainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use mainBundle\Entity\contact;
use Symfony\Component\HttpFoundation\Request;

class mainController extends Controller{
    
    public function indexAction(){
        return $this->render('mainBundle::main/accueil.html.twig');
    }
    
    public function parcoursAction(){
        return $this->render('mainBundle::main/parcours.html.twig');
    }
    
    public function contactAction(Request $request){
        $contact = new contact();
        $formBuilder = $this->get('form.factory')->createBuilder('form',$contact);
        $formBuilder
                ->add('email','email',array('required'=>true))
                ->add('message','textarea',array('required'=>true))
                ->add('envoyer','submit');
        $form = $formBuilder->getForm();
        $form->handleRequest($request);
        if($form->isValid()){
            $from = $contact->getEmail();
            $to = "raymond.royglen@gmail.com";
            $message = wordwrap(str_replace("\n", "\n..", $contact->getMessage()));
            $subject = "Demande de contact";
            $headers = 'From: '.$from . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();
            if(mail($to, $subject, $message,$headers)){
                $request->getSession()->getFlashBag()->add('notice', 'Votre message a été envoyé avec succès. Merci de votre attention. Cordialement');
            }
            else{
                $request->getSession()->getFlashBag()->add('alert', 'Désolé, erreur lors de l\'envoi du message');
            }
            return $this->redirect($this->generateUrl('contact'));
        }
        return $this->render('mainBundle::main/contact.html.twig',array('form'=>$form->createView()));
    }
    
    public function  experiencesAction(){
        $listeExperiences = $this->getDoctrine()->getManager()->getRepository('mainBundle:expPro')->findAll();
        return $this->render('mainBundle::main/details/exp_pro.html.twig',array('listeExp'=>$listeExperiences));
    }
    
    public function  certificatsAction(){
        $certificats = $this->getDoctrine()->getManager()->getRepository('mainBundle:certificats')->findAll();
        return $this->render('mainBundle::main/details/certificats.html.twig',array('certificats'=>$certificats));
    }
    
    public function  aptitudesAction($type){
        $aptitudes = $this->getDoctrine()->getManager()->getRepository('mainBundle:aptitudes')->findByType($type);
        return $this->render('mainBundle::main/details/aptitudes.html.twig',array('aptitudes'=>$aptitudes));
    }
    
    public function  formationAction(){
        $formations = $this->getDoctrine()->getManager()->getRepository('mainBundle:formationInitiale')->findAll();
        return $this->render('mainBundle::main/details/formations.html.twig',array('formations'=>$formations));
    }
    
    public function  okAction(){
        return $this->render('mainBundle::main/ok.html.twig');
    }
}