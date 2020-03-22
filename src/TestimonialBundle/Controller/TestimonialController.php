<?php

namespace TestimonialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use TestimonialBundle\Entity\Testimonial;

/**
 * Class TestimonialController
 * @package TestimonialBundle\Controller
 * @Route("/testimonial")
 */
class TestimonialController extends Controller
{


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="testimonial_index")
     * @Method("GET")
     */
    public function indexAction(){

        $testimonials = $this->getDoctrine()
            ->getRepository(Testimonial::class)
            ->findAll();

        return $this->render('@Testimonial/index.html.twig',["testimonials" => $testimonials]);
    }


    /**
     *
     * @Route("/create", name="testimonial_create")
     * @Method("GET")
     *
     */
    public function createAction(){

        return $this->render("@Testimonial/create.html.twig");

    }


    /**
     * @param Request $request
     * @Route("/new",name="testimonial_new")
     * @Method("POST")
     * @return Response
     */
    public function newAction(Request $request){


        $file=$request->files->get('customer_photo');
        $em = $this->getDoctrine()->getManager();

        $testimonial = new Testimonial();
        $testimonial->setDescription($request->request->get('description'));
        $testimonial->setCustomerName($request->request->get('customer_name'));
        $testimonial->setCustomerPosition($request->request->get('customer_position'));

        if (null !== $file){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Testimonials");

            $testimonial->setCustomerPhoto($file_name);

            $em->persist($testimonial);
            $em->flush();

            return $this->redirectToRoute('testimonial_index');
        }else{

            $em->persist($testimonial);
            $em->flush();
            return $this->redirectToRoute('testimonial_index');
        }





    }


    /**
     * @Route("/{id}/edit",name="testimonial_edit")
     * @param Testimonial $testimonial
     * @return  Response
     */

    public function editAction(Testimonial $testimonial){

        return $this->render("@Testimonial/edit.html.twig",['testimonial' => $testimonial]);

    }

    /**
     * @param Testimonial $testimonial
     * @param Request $request
     * @Route("/update/{id}",name="testimonial_update")
     * @Method("PUT")
     * @return Response
     */

    public function updateAction(Testimonial $testimonial,Request $request){


        $file = $request->files->get('customer_photo');

        $em=$this->getDoctrine()->getManager();


        $testimonial->setDescription($request->request->get('description'));
        $testimonial->setCustomerName($request->request->get('customer_name'));
        $testimonial->setCustomerPosition($request->request->get('customer_position'));

        if (null !== $file){

            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Testimonials");

            $testimonial->setCustomerPhoto($file_name);

            $em->merge($testimonial);
            $em->flush();

            return $this->redirectToRoute('testimonial_index');
        }else{

            $em->merge($testimonial);
            $em->flush();
            return $this->redirectToRoute('testimonial_index');
        }

    }

    /**
     *
     * @Route("/{id}", name="testimonial_show")
     * @param Testimonial $testimonial
     * @return Response
     *
     */

    public function showAction(Testimonial $testimonial){


        if (null === $testimonial)
            throw new NotFoundResourceException("there is no category with this id ",404);

        return $this->render('@Testimonial/show.html.twig',['testimonial' => $testimonial]);

    }


    /**
     * @param Testimonial $testimonial
     * @Route("/{id}/delete", name="testimonial_delete")
     * @return Response
     */
    public function deleteAction(Testimonial $testimonial){

        if (null === $testimonial)
            throw new NotFoundResourceException("there is no category with this id ",404);

        $em=$this->getDoctrine()->getManager();
        $em->remove($testimonial);
        $em->flush();

        return $this->redirectToRoute("testimonial_index");

    }

}
