<?php

namespace PagesBundle\Controller\Categories;


use PagesBundle\Entity\Categories\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Class CategoriesController
 * @Route("/pages/categories")
 */
class CategoriesController extends Controller
{


    /**
     * @Route("/",name="pages_category_index")
     * @Method("GET")
     */

    public function indexAction(){

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render('@Pages/categories/index.html.twig',['categories' => $categories]);
    }


    /**
     *
     * @Route("/create", name="pages_category_create")
     * @Method("GET")
     */
    public function createAction(){


        return $this->render('@Pages/categories/create.html.twig');
    }


    /**
     * @param Request $request
     * @Route("/new", name="pages_category_new")
     * @Method("POST")
     *
     *
     */
    public function newAction(Request $request){


        $em=$this->getDoctrine()->getManager();

        $category = new Category();
        $category->setTitle($request->request->get('title'));
        $category->setDescription($request->request->get('description'));
        $category->setMetaTitle($request->request->get('meta_title'));
        $category->setMetaDescription($request->request->get('meta_description'));
        $category->setMetaKeywords($request->request->get('meta_keywords'));
        $em->persist($category);
        $em->flush();
        return $this->redirectToRoute('pages_category_index');

    }


    /**
     * @param Category $category
     * @Route("/edit/{id}", name="pages_category_edit")
     * @Method("GET")
     * @return  Response
     */
    public function editAction(Category $category){

        return $this->render('@Pages/categories/edit.html.twig',['category' => $category]);

    }


    /**
     * @param Category $category
     * @Route("/update/{id}", name="pages_category_update")
     * @Method("PUT")
     * @return Response
     */


    public function updateAction(Category $category, Request $request){


        $category->setTitle($request->request->get('title'));
        $category->setDescription($request->request->get('description'));
        $category->setMetaTitle($request->request->get('meta_title'));
        $category->setMetaDescription($request->request->get('meta_description'));
        $category->setMetaKeywords($request->request->get('meta_keywords'));


        $em=$this->getDoctrine()->getManager();
        $em->merge($category);
        $em->flush();
        return $this->redirectToRoute('pages_category_index');




    }


    /**
     * @param Category $category
     *
     * @Route("/{id}", name="pages_category_show")
     * @Method("GET")
     * @return Response
     */

    public function show(Category $category){

        return $this->render('@Pages/categories/show.html.twig',['category' => $category]);

    }

    /**
     *
     * @Route("/delete/{id}", name="pages_category_delete")
     * @param Category $category
     * @return  Response
     */
    public function deleteAction(Category $category){


        if (null === $category)
            throw new NotFoundResourceException("there is no category with this id ",404);

        $em= $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();
        return $this->redirectToRoute("pages_category_index");


    }

}
