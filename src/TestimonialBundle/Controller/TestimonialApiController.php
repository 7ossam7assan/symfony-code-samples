<?php

namespace TestimonialBundle\Controller;

use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use TestimonialBundle\Entity\Testimonial;

class TestimonialApiController extends AbstractController
{
    use ControllerTrait;

    /**
     * @Rest\View()
     *
     */
    public function getTestimonialsAction()
    {

        $testimonials = $this->getDoctrine()
            ->getRepository(Testimonial::class)
            ->findAll();

        if (count($testimonials) > 0)
            return $this->view(["data" => $testimonials, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => [], 'status' => Response::HTTP_NO_CONTENT]);
    }

    /**
     *
     * @ParamConverter("testimonial")
     * @Rest\View()
     */
    public function getTestimonialAction(Testimonial $testimonial)
    {

        if (isset($testimonial) && !empty($testimonial))
            return $this->view(["data" => $testimonial, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => null, 'status' => Response::HTTP_NO_CONTENT]);
      }


}
