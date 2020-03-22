<?php

namespace ProjectBundle\Controller\Categories;

use ProjectBundle\Entity\Categories\Category;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

class CategoryApiController extends AbstractController
{

    use ControllerTrait;

    /**
     * @Rest\View()
     */
    public function getProjectCategoriesAction()
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
     * @ParamConverter("category")
     * @Rest\View()
     */
    public function getProjectCategoryAction(Category $category)
    {

        if (isset($category) && !empty($category))
            return $this->view(["data" => $category, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => null, 'status' => Response::HTTP_NO_CONTENT]);

    }
}
