<?php

namespace ServiceBundle\Controller\Category;

use FOS\RestBundle\Controller\ControllerTrait;
use ServiceBundle\Entity\Category\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class CategoryApiController extends AbstractController
{
    use ControllerTrait;

    /**
     * @Rest\View()
     */
    public function getServiceCategoriesAction()
    {


        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        if (count($categories) > 0)
            return $this->view(["data" => $categories, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => [], 'status' => Response::HTTP_NO_CONTENT]);

    }

    /**
     *
     * @param("category")
     * @Rest\View()
     * @return
     */
    public function getServiceCategoryAction(Category $category)
    {

        if (isset($category) && !empty($category))
            return $this->view(["data" => $category, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => null, 'status' => Response::HTTP_NO_CONTENT]);

    }

}
