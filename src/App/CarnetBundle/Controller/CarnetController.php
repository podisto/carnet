<?php
/**
 * Created by PhpStorm.
 * User: Podisto
 * Date: 19/05/2016
 * Time: 15:09
 */

namespace App\CarnetBundle\Controller;


use App\CarnetBundle\Entity\Contact;
use App\CarnetBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CarnetController extends Controller
{
    public function indexAction() {
        return $this->render('CarnetBundle:Front:index.html.twig');
    }

    public function userContactAction() {
        // get all user's contact
        $user = $this->getUser();
        if(null === $user)
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        $em = $this->getDoctrine()->getManager();
        $contacts = $em->getRepository('CarnetBundle:Contact')->getUserContact($user);

        return $this->render('@Carnet/Front/contacts.html.twig', array('contacts' => $contacts));
    }

    public function addAction(Request $request) {
        $contact = new Contact();
        $form = $this->get('form.factory')->create(new ContactType(), $contact);
        $user = $this->getUser();

        if(null === $user)
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        else {
            if('POST' === $this->get('request')->getMethod()) {
                if($form->handleRequest($request)->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $contact->setUser($user);
                    $em->persist($contact);
                    $em->flush();

                    // show flash message
                    $request->getSession()->getFlashBag()->add('success', 'Contact cree');
                    // redirect to contact details
                    return $this->redirect($this->generateUrl('carnet_detail', array('id' => $contact->getId())));
                }
            }
        }
        return $this->render('@Carnet/Front/add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction(Request $request, Contact $contact) {

    }

    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $contact = $em->getRepository('CarnetBundle:Contact')->find($id);

        return $this->render('@Carnet/Front/details.html.twig', array('contact' => $contact));
    }

    public function deleteAction(Request $request) {

    }
}