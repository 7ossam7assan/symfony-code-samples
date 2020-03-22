<?php

namespace PagesBundle\Controller\Pages;

use FOS\RestBundle\Controller\ControllerTrait;
use PagesBundle\Entity\Pages\Pages;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class PagesApiController extends AbstractController
{

    use ControllerTrait;

    /**
     * @Rest\View()
     */

    public function getPagesAction(){
        $pages=$this->getDoctrine()
            ->getRepository(Pages::class)
            ->findAll();

        if (count($pages) > 0)
            return $this->view(["data" => $pages, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => [], 'status' => Response::HTTP_NO_CONTENT]);
    }

    /**
     *
     * @Rest\View()
     *
     * @return
     */

    public function getPageAction($page){

        $page = $this->getDoctrine()->getRepository(Pages::class)->findOneBy(['slug' => $page]);
        if (isset($page) && !empty($page))
            return $this->view(["data" => $page, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => null, 'status' => Response::HTTP_NO_CONTENT]);

    }
}
