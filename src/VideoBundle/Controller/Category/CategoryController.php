<?php

namespace VideoBundle\Controller\Category;

use VideoBundle\Entity\Video;
use VideoBundle\Entity\VideoCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class CategoryController
 * @package VideoBundle\Controller\Category
 * @Route("/video/categories")
 */
class CategoryController extends Controller
{


    /**
     *
     * @Route("/", name="video_category_index")
     *
     * @Method("GET")
     */

    public function indexAction(){


        $categories=$this->getDoctrine()
            ->getRepository(VideoCategory::class)
            ->findAll();

        return $this->render('@Video/categories/index.html.twig',['categories' => $categories]);
    }

    /**
     *
     * @Route("/create", name="video_category_create")
     * @return \Symfony\Component\HttpFoundation\Response
     * @Method("GET")
     */
    public function createAction(){

        return $this->render("@Video/categories/create.html.twig");
    }

    /**
     * @Route("/new", name="video_category_new")
     * @param Request $request
     * @Method("POST")
     * @return Response
     */

    public function newAction(Request $request){

        $em=$this->getDoctrine()->getManager();

        $category = new VideoCategory();
        $category->setTitle($request->request->get('title'));
        $category->setDescription($request->request->get('description'));

        $em->persist($category);
        $em->flush();
        return $this->redirectToRoute('video_category_index');

    }


    /**
     * @Route("/edit/{id}", name="video_category_edit")
     * @param VideoCategory $category
     * @return  Response
     * @Method("GET")
     */
    public function editAction(VideoCategory $category){
        if (null !== $category)
            return $this->render('@Video/categories/edit.html.twig',['category' => $category]);
        else
            throw new  ResourceNotFoundException('No Category',404);

    }

    /**
     * @Route("/update/{id}", name="video_category_update")
     * @param VideoCategory $category
     * @param Request $request
     * @Method("PUT")
     * @return Response
     */
    public function updateAction(VideoCategory $category, Request $request){


        $em=$this->getDoctrine()->getManager();


        $category->setTitle($request->request->get('title'));
        $category->setDescription($request->request->get('description'));


        $em->merge($category);
        $em->flush();
        return $this->redirectToRoute('video_category_index');

    }


    /**
     *
     * @Route("/{id}", name="video_category_show")
     * @param VideoCategory $category
     * @Method("GET")
     * @return Response
     */

    public function showAction(VideoCategory $category){

        if (null === $category)
            throw new NotFoundResourceException("there is no category with this id ",404);

        return $this->render('@Video/categories/show.html.twig',['category' => $category]);

    }

    /**
     *
     * @Route("/delete/{id}", name="video_category_delete")
     * @param VideoCategory $category
     * @return Response
     */
    public function deleteAction(VideoCategory $category){

        if (null === $category)
            throw new ResourceNotFoundException('No Category With this Id',404);

        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute("video_category_index");
    }
}
