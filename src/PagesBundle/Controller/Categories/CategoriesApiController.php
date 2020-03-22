<?php

namespace PagesBundle\Controller\Categories;

use PagesBundle\Entity\Categories\Category;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CategoriesApiController extends AbstractController
{

    use ControllerTrait;



    /**
     *
     * @Rest\View()
     *
     */

    public function pagesCategoriesAction(){


        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();


        if (count($categories) > 0)
            return $this->view(["data" => $categories, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => [], 'status' => Response::HTTP_NO_CONTENT]);

    }

    /**
     * @Rest\View()
     * @param Category $category
     * @return
     */
    public function getPagesCategoryAction(Category $category){

        dump($category);die();
        if (isset($category) && !empty($category))
            return $this->view(["data" => $category, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => null, 'status' => Response::HTTP_NO_CONTENT]);
    }

}
