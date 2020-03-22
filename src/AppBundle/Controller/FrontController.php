<?php
/**
 * Created by PhpStorm.
 * User: mallahsoft
 * Date: 12/24/18
 * Time: 10:31 PM
 */

namespace AppBundle\Controller;


use BlogBundle\Entity\Blog\Blog;
use ContactBundle\Entity\Contact;
use ServiceBundle\Entity\Category\Category;
use ServiceBundle\Entity\Service\Service;
use SliderBundle\Entity\Slider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use TeamBundle\Entity\Team;
use TestimonialBundle\Entity\Testimonial;
use WorkTimeBundle\Entity\WorkTime;


class FrontController extends Controller
{


    /**
     * @Route("/contact", name="front_contact")
     */
    public function contact()
    {
        $news = $this->getDoctrine()
            ->getRepository(Blog::class)
            ->getLatestNews();
        $times = $this->getDoctrine()
            ->getRepository(WorkTime::class)
            ->findAll();
        // replace this example code with whatever you need
        return $this->render('front/pages/contact.html.twig',['news' => $news,'times' => $times]);
    }


    /**
     * @Route("/contact/send", name="front_contact_send")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return
     */

    public function contactSend(Request $request , \Swift_Mailer $mailer)
    {

//return "Ff";
//        dump($request->request);die();

        $contact = new Contact();
        $contact->setName($request->request->get('name'));
        $contact->setEmail($request->request->get('email'));
        $contact->setSubject($request->request->get('subject'));
        $contact->setPhone($request->request->get('phone'));
        $contact->setMessage($request->request->get('message'));

        $em =$this->getDoctrine()->getManager();
        $em->persist($contact);
        $em->flush();


        // send email

        $message = (new \Swift_Message('Booking Email'))
            ->setFrom($request->request->get('email'))
            ->setTo('hossamhassan14895@gmail.com.com')
            ->setBody(
                $this->renderView(

                    'front/pages/BookingEmail.html.twig',
                    [
                        'name' => $request->request->get('name'),
                        'email' => $request->request->get('email'),
                        'date' => $request->request->get('date'),
                        'phone' => $request->request->get('phone'),
                        'message' => $request->request->get('message'),
                    ]
                ),
                'text/html'
            );



        $mailer->send($message);
//
//        $news = $this->getDoctrine()
//            ->getRepository(Blog::class)
//            ->getLatestNews();
//        $times = $this->getDoctrine()
//            ->getRepository(WorkTime::class)
//            ->findAll();
        // replace this example code with whatever you need
        return $this->redirectToRoute('front_contact');
    }


    /**
     * @Route("/doctors", name="front_doctors")
     */

    public function frontDoctors()
    {

        $doctors = $this->getDoctrine()
            ->getRepository(Team::class)
            ->findAll();
//        dump($doctors);die();
        $times = $this->getDoctrine()
            ->getRepository(WorkTime::class)
            ->findAll();
        $news = $this->getDoctrine()
            ->getRepository(Blog::class)
            ->getLatestNews();
        return $this->render('front/pages/doctors.html.twig',
            [
                'doctors' => $doctors,
                'news' => $news,
                'times' => $times,
            ]
        );
    }




    /**
     * @Route("/news", name="front_news")
     */
    public function news()
    {



        // replace this example code with whatever you need
        return $this->render('front/pages/news.html.twig');
    }
    /**
     * @param  $slug
     * @Route("/news-detail/{slug}", name="front_news_details")
     * @return
     */

    public function newsDetails($slug)
    {

        $article = $this->getDoctrine()->getRepository(Blog::class)->findOneBy(['slug' => $slug]);
        $news = $this->getDoctrine()
            ->getRepository(Blog::class)
            ->getLatestNews();


        $times = $this->getDoctrine()
            ->getRepository(WorkTime::class)
            ->findAll();
        $categories = $this->getDoctrine()->getRepository(\BlogBundle\Entity\Category\Category::class)->findAll();
//        dump($categories);die();


        // replace this example code with whatever you need
        return $this->render('front/pages/news.html.twig',[
            'article' => $article,
            'news'  => $news,
            'times' => $times,
            'categories' => $categories,
        ]);
    }


}