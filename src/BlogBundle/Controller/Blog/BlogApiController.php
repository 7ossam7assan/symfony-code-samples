<?php

namespace BlogBundle\Controller\Blog;

use BlogBundle\Entity\Blog\Blog;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Tests\Fixtures\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;

class BlogApiController extends AbstractController
{

    use ControllerTrait;

    /**
     *
     * @Rest\View()
     */

    public function getBlogsAction(){

        $blogs=$this->getDoctrine()
            ->getRepository(Blog::class)
            ->findAll();

//        dump($blogs);die();

        if (count($blogs) > 0)
            return $this->view(["data" => $blogs, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => [], 'status' => Response::HTTP_NO_CONTENT]);


    }
    /**
     * @param string $blog
     * @return \FOS\RestBundle\View\View
     * @QueryParam(name="slug", description="slug of the overview.")
     * @Rest\View()
     */

    public function getBlogAction($blog){


        $blog=$this->getDoctrine()->getRepository(Blog::class)->findOneBy(['id' => $blog]);

        if (null == $blog){



            return $this->view(["data" => $blog,'status' => Response::HTTP_NO_CONTENT]);
        }

        return $this->view(["data" => $blog,'status' => Response::HTTP_OK]);
    }



}
