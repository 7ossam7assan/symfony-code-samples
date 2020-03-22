<?php

namespace TeamBundle\Controller;

use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use TeamBundle\Entity\Team;

class TeamApiController extends AbstractController
{
    use ControllerTrait;


    /**
     *
     * @Rest\View()
     */

    public function getTeamsAction(){

        $teams = $this->getDoctrine()
            ->getRepository(Team::class)
            ->findAll();

        if (count($teams) > 0)
            return $this->view(["data" => $teams, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => [], 'status' => Response::HTTP_NO_CONTENT]);

    }

    /**
     *
     * @Rest\View()
     *
     */

    public function getTeamAction($team){

        $team = $this->getDoctrine()
            ->getRepository(Team::class)
            ->findOneBy(['slug' => $team]);

        if (isset($team) && !empty($team))
            return $this->view(["data" => $team, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => null, 'status' => Response::HTTP_NO_CONTENT]);
    }

}
