<?php

namespace ServiceBundle\Controller\Category;

use ServiceBundle\Entity\Category\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class CategoryController
 * @package ServiceBundle\Controller\Category
 * @Route("/service/categories")
 */
class CategoryController extends Controller
{


    /**
     *
     * @Route("/", name="service_category_index")
     *
     * @Method("GET")
     */

    public function indexAction(){


        $categories=$this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('@Service/categories/index.html.twig',['categories' => $categories]);
    }

    /**
     *
     * @Route("/create", name="service_category_create")
     * @return \Symfony\Component\HttpFoundation\Response
     * @Method("GET")
     */
    public function createAction(){

        return $this->render("@Service/categories/create.html.twig");
    }

    /**
     * @Route("/new", name="service_category_new")
     * @param Request $request
     * @Method("POST")
     * @return Response
     */

    public function newAction(Request $request){

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
            $file_name = $imageUploader->uploadImage($file,"uploads/Service/Categories");

            $category->setPhoto($file_name);

            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('service_category_index');
        }else{

            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('service_category_index');
        }
    }


    /**
     * @Route("/edit/{id}", name="service_category_edit")
     * @param Category $category
     * @return  Response
     * @Method("GET")
     */
    public function editAction(Category $category){
        if (null !== $category)
            return $this->render('@Service/categories/edit.html.twig',['category' => $category]);
        else
            throw new  ResourceNotFoundException('No Category',404);

    }

    /**
     * @Route("/update/{id}", name="service_category_update")
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
            $file_name = $imageUploader->uploadImage($file,"uploads/Service/Categories");

            $category->setPhoto($file_name);

            $em->merge($category);
            $em->flush();

            return $this->redirectToRoute('service_category_index');
        }else{

            $em->merge($category);
            $em->flush();
            return $this->redirectToRoute('service_category_index');
        }
    }


    /**
     *
     * @Route("/{id}", name="service_category_show")
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
     * @Route("/delete/{id}", name="service_category_delete")
     * @param Category $category
     * @return Response
     */
    public function deleteAction(Category $category){

        if (null === $category)
            throw new ResourceNotFoundException('No Category With this Id',404);

        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return $this->redirectToRoute("service_category_index");
    }
}
