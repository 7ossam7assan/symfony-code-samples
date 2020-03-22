<?php

namespace ContactBundle\Controller;

use ContactBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class ContactController
 * @package ContactBundle\Controller
 * @Route("contacts")
 */
class ContactController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="contact_index")
     * @Method("GET")
     */

    public function indexAction(){


        $contacts = $this->getDoctrine()
            ->getRepository(Contact::class)
            ->findAll();

        return $this->render('@Contact/contact/index.html.twig',['contacts' => $contacts]);
    }



    /**
     * @param Contact $contact
     * @return
     * @Route("/{id}", name="contact_show")
     * @Method("GET")
     */

    public function showAction(Contact $contact){

        if (null === $contact)
            throw new ResourceNotFoundException('there is no contact with this slug',404);

        return $this->render('@Contact/contact/show.html.twig',['contact' => $contact]);
    }


    /**
     * @param Contact $contact
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/{id}", name="contact_delete")
     * @Method("DELETE")
     */

    public function deleteAction(Contact $contact){


        if (null === $contact)
            throw new NotFoundResourceException('there is no category with this slug',404);

        $em=$this->getDoctrine()->getManager();
        $em->remove($contact);
        $em->flush();
        return $this->redirectToRoute('contact_index');
    }
}
