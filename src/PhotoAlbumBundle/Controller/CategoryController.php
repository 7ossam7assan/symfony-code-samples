<?php

namespace PhotoAlbumBundle\Controller;

use PhotoAlbumBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class CategoryController
 * @package PhotoAlbumBundle\Controller
 * @Route("/photo/categories")
 */
class CategoryController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="photo_category_index")
     * @Method("GET")
     */
    public function indexAction(){

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('@PhotoAlbum/categories/index.html.twig',['categories' => $categories]);
    }


    /**
     * @Route("/create", name="photo_category_create")
     * @Method("GET")
     */
    public function createAction(){

        return $this->render('@PhotoAlbum/categories/create.html.twig');
    }


    /**
     * @param Request $request
     * @Route("/new",  name="photo_category_new")
     * @Method("GET")
     * @return
     */
    public function newAction(Request $request){


        $em=$this->getDoctrine()->getManager();

        $category = new Category();
        $category->setTitle($request->request->get('title'));

        $em->persist($category);
        $em->flush();
        return $this->redirectToRoute('photo_category_index');

    }


    /**
     * @param Category $category
     * @return
     * @Route("/edit/{id}", name="photo_category_edit")
     * @Method("GET")
     */

    public function editAction(Category $category){

        return $this->render('@PhotoAlbum/categories/edit.html.twig',["category" => $category]);

    }

    /**
     * @param Category $category
     * @param Request $request
     * @Route("/update/{id}", name="photo_category_update")
     * @Method("PUT")
     * @return
     */


    public function updateAction(Category $category,Request $request){

        $em=$this->getDoctrine()->getManager();
        $category->setTitle($request->request->get('title'));

        $em->merge($category);
        $em->flush();
        return $this->redirectToRoute('photo_category_index');



    }

    /**
     * @param Category $category
     * @return
     * @Route("/{id}", name="photo_category_show")
     * @Method("GET")
     */

    public function showAction(Category $category){

        if (null === $category)
            throw new ResourceNotFoundException('there is no category with this slug',404);
        return $this->render('@PhotoAlbum/categories/show.html.twig',['category' => $category]);
    }


    /**
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/{id}", name="photo_category_delete")
     * @Method("DELETE")
     */

    public function deleteAction(Category $category){



//         dump($category);die();

        if (null === $category)
            throw new NotFoundResourceException('there is no category with this slug',404);


        $em=$this->getDoctrine()->getManager();

        $em->remove($category);
        $em->flush();
        $em->clear();
        return $this->redirectToRoute('photo_category_index');
    }

}
