<?php

namespace ServiceBundle\Controller\Service;

use FOS\RestBundle\Controller\ControllerTrait;
use ServiceBundle\Entity\Service\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class ServiceApiController extends AbstractController
{

    use ControllerTrait;
    /**
     *
     * @Rest\View()
     */
    public function getServicesAction(){

        $services=$this->getDoctrine()
            ->getRepository(Service::class)
            ->findAll();

        if (count($services) > 0)
            return $this->view(["data" => $services, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => [], 'status' => Response::HTTP_NO_CONTENT]);


    }


    /**
     *
     * @Rest\View()
     * @param string $service
     * @return
     */

    public function getServiceAction($service){


        $service =  $this->getDoctrine()
            ->getRepository(Service::class)
            ->findOneBy(['id' => $service]);


        if (isset($service) && !empty($service))
            return $this->view(["data" => $service, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => null, 'status' => Response::HTTP_NO_CONTENT]);
    }


}
