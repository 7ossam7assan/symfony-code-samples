<?php

namespace AppBundle\Controller;

use BlogBundle\Entity\Blog\Blog;
use ConfigBundle\Entity\Config;
use ContactBundle\Entity\Booking;
use PhotoAlbumBundle\Entity\Photo;
use ServiceBundle\Entity\Category\Category;
use ServiceBundle\Entity\Service\Service;
use SliderBundle\Entity\Slider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use TeamBundle\Entity\Team;
use TestimonialBundle\Entity\Testimonial;
use VideoBundle\Entity\Video;
use WorkTimeBundle\Entity\WorkTime;

class DefaultController extends Controller
{
    /**
     * @Route("/admin", name="admin-home-page")
     */
    public function indexAdmin()
    {

        // replace this example code with whatever you need
        return $this->render('base.html.twig');
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexFront()
    {

        $sliders = $this->getDoctrine()
            ->getRepository(Slider::class)
            ->findAll();


        $teams = $this->getDoctrine()
            ->getRepository(Team::class)
            ->findAll();

        $testimonial = $this->getDoctrine()
            ->getRepository(Testimonial::class)
            ->findAll();

        $specialServices = $this->getDoctrine()
            ->getRepository(Service::class)
            ->findBy(['featured' => 1]);

        $times = $this->getDoctrine()
            ->getRepository(WorkTime::class)
            ->findAll();
        $videos = $this->getDoctrine()
            ->getRepository(Video::class)
            ->findAll();
        $news = $this->getDoctrine()
            ->getRepository(Blog::class)
            ->getLatestNews();
        $photos = $this->getDoctrine()
            ->getRepository(Photo::class)
            ->findAll();
        $photosCategories = $this->getDoctrine()
            ->getRepository(\PhotoAlbumBundle\Entity\Category::class)
            ->findAll();
//        dump($configs);die();


        // replace this example code with whatever you need
        return $this->render('front/index.html.twig',
            [
                'sliders' => $sliders,
                'teams' => $teams,
                'testimonials' => $testimonial,
                'specialServices' => $specialServices,
                'times' => $times,
                'videos' => $videos,
                'news' => $news,
                'photos' => $photos,
                'photosCategories' => $photosCategories,
            ]
        );
    }


    /**
     * @Route("/booking/send", name="front_booking_send")
     */
    public function contactSend(Request $request,\Swift_Mailer $mailer)
    {

//return "Ff";
//        dump($request->request);die();

        $booking = new Booking();
        $booking->setName($request->request->get('name'));
        $booking->setEmail($request->request->get('email'));
        $booking->setDate($request->request->get('date'));
        $booking->setPhone($request->request->get('phone'));
        $booking->setMessage($request->request->get('message'));

        $em =$this->getDoctrine()->getManager();
        $em->persist($booking);
        $em->flush();





        return $this->redirectToRoute('homepage');

    }

    /**
     * @Route("/services/{id}", name="front_services")
     */
    public function services($id)
    {

        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->find($id);


        // replace this example code with whatever you need
        return $this->render('front/pages/services.html.twig',
            [
                'category' => $category,
            ]
        );
    }

    /**
     * @Route("/services-detail/{id}", name="front_service_detail")
     */

    public function servicesDetail($id)
    {

        $service = $this->getDoctrine()
            ->getRepository(Service::class)
            ->find($id);

        $services = $this->getDoctrine()->getRepository(Service::class)->findByCategory($service->getCategory()->getId());
        // replace this example code with whatever you need
//        dump($services);die();
        $news = $this->getDoctrine()
            ->getRepository(Blog::class)
            ->getLatestNews();

        $times = $this->getDoctrine()
            ->getRepository(WorkTime::class)
            ->findAll();

        return $this->render('front/pages/service_detail.html.twig',
            [
                'service' => $service,
                'services' => $services,
                'news'   => $news,
                'times'   => $times
            ]
        );
    }


}
