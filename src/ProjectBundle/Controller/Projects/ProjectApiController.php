<?php

namespace ProjectBundle\Controller\Projects;

use FOS\RestBundle\Controller\ControllerTrait;
use ProjectBundle\Entity\Projects\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class ProjectApiController extends AbstractController
{

    use ControllerTrait;

    /**
     *
     * @Rest\View()
     */
    public function getProjectsAction(){

        $projects=$this->getDoctrine()
            ->getRepository(Project::class)
            ->findAll();

        if (count($projects) > 0)
            return $this->view(["data" => $projects, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => [], 'status' => Response::HTTP_NO_CONTENT]);


    }


    /**
     *
     * @Rest\View()
     * @param Project $project
     * @return
     */

    public function getProjectAction(Project $project){


        if (isset($project) && !empty($project))
            return $this->view(["data" => $project, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => null, 'status' => Response::HTTP_NO_CONTENT]);
    }




}
