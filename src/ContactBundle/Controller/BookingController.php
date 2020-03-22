<?php

namespace ContactBundle\Controller;

use Beta\B;
use ContactBundle\Entity\Booking;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * Class BookingController
 * @package ContactBundle\Controller
 * @Route("/booking")
 */
class BookingController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="booking_index")
     * @Method("GET")
     */

    public function indexAction(){


        $bookings = $this->getDoctrine()
            ->getRepository(Booking::class)
            ->findAll();

        return $this->render('@Contact/booking/index.html.twig',['bookings' => $bookings]);
    }



    /**
     * @param Booking $booking
     * @return
     * @Route("/{id}", name="booking_show")
     * @Method("GET")
     */

    public function showAction(Booking $booking){

        if (null === $booking)
            throw new ResourceNotFoundException('there is no contact with this slug',404);

        return $this->render('@Contact/booking/show.html.twig',['booking' => $booking]);
    }


    /**
     * @param Booking $booking
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/{id}", name="booking_delete")
     * @Method("DELETE")
     */

    public function deleteAction(Booking $booking){


        if (null === $booking)
            throw new NotFoundResourceException('there is no category with this slug',404);

        $em=$this->getDoctrine()->getManager();
        $em->remove($booking);
        $em->flush();
        return $this->redirectToRoute('booking_index');
    }

}
