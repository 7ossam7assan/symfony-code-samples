<?php

namespace ProjectBundle\Controller\Categories;

use ProjectBundle\Entity\Categories\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Class CategoryController
 * @Route("/category")
 */
class CategoryController extends Controller
{



    /**
     *
     * @Route("/", name="category_index")
     *
     * @Method("GET")
     */

    public function indexAction(){


        $categories=$this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('@Project/categories/index.html.twig',['categories' => $categories]);
    }

    /**
     *
     * @Route("/create", name="category_create")
     * @return \Symfony\Component\HttpFoundation\Response
     * @Method("GET")
     */
    public function createAction(){

        return $this->render("@Project/categories/create.html.twig");
    }

    /**
     * @Route("/new", name="category_new")
     * @param Request $request
     * @Method("POST")
     * @return Response
     */

    public function newAction(Request $request){

//        dump($request->request->all());die();
        $file = $request->files->get('photo');
        $em=$this->getDoctrine()->getManager();

        $category = new Category();
        $category->setTitle($request->request->get('title'));
        $category->setDescription($request->request->get('description'));
        $category->setMetaTitle($request->request->get('meta_title'));
        $category->setMetaDescription($request->request->get('meta_description'));
        $category->setMetaKeywords($request->request->get('meta_keywords'));
        $category->setSlug($request->request->get('slug'));

        if (null !== $file){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Projects/Categories");

            $category->setPhoto($file_name);

            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('category_index');
        }else{

            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('category_index');
        }
    }


    /**
     * @Route("/edit/{id}", name="category_edit")
     * @param Category $category
     * @return  Response
     * @Method("GET")
     */
    public function editAction(Category $category){
        if (null !== $category)
            return $this->render('@Project/categories/edit.html.twig',['category' => $category]);
        else
            throw new  ResourceNotFoundException('No Category','404');

    }

    /**
     * @Route("/update/{id}", name="category_update")
     * @param Category $category
     * @param Request $request
     * @Method("PUT")
     * @return Response
     */
    public function updateAction(Category $category, Request $request){

        $file = $request->files->get('photo');

        $em=$this->getDoctrine()->getManager();


        $category->setTitle($request->request->get('title'));
        $category->setDescription($request->request->get('description'));
        $category->setMetaTitle($request->request->get('meta_title'));
        $category->setMetaDescription($request->request->get('meta_description'));
        $category->setMetaKeywords($request->request->get('meta_keywords'));
        $category->setSlug($request->request->get('slug'));

        if (null !== $file){

            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Projects/Categories");

            $category->setPhoto($file_name);

            $em->merge($category);
            $em->flush();

            return $this->redirectToRoute('category_index');
        }else{

            $em->merge($category);
            $em->flush();
            return $this->redirectToRoute('category_index');
        }
    }


    /**
     *
     * @Route("/{id}", name="category_show")
     * @param Category $category
     * @Method("GET")
     * @return Response
     */

    public function showAction(Category $category){

        if (null === $category)
            throw new NotFoundResourceException("there is no category with this id ",404);

        return $this->render('@Project/categories/show.html.twig',['category' => $category]);

    }

    /**
     *
     * @Route("/delete/{id}", name="category_delete")
     * @param Category $category
     * @return Response
     */
    public function deleteAction(Category $category){

        if (null === $category)
            throw new ResourceNotFoundException('No Category With this Id',404);

        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute("category_index");
    }

}
