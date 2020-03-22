<?php

namespace BlogBundle\Controller\Category;

use BlogBundle\Entity\Category\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Class CategoryController
 * @package BlogBundle\Controller\Category
 * @Route("blog/categories")
 */
class CategoryController extends Controller
{


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="blog_category_index")
     * @Method("GET")
     */
    public function indexAction(){

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('@Blog/categories/index.html.twig',['categories' => $categories]);
    }


    /**
     * @Route("/create", name="blog_category_create")
     * @Method("GET")
     */
    public function createAction(){

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render('@Blog/categories/create.html.twig',['categories' => $categories]);
    }


    /**
     * @param Request $request
     * @Route("/new",  name="blog_category_new")
     * @Method("GET")
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

        $parent=$this->getDoctrine()->getRepository(Category::class)->find($request->request->get('parent'));
        $category->setParent($parent);

        if (null !== $file){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Categories");

            $category->setPhoto($file_name);

            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('blog_category_index');
        }else{

            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('blog_category_index');
        }
    }


    /**
     * @param Category $category
     * @return Response
     * @Route("/edit/{slug}", name="blog_category_edit")
     * @Method("GET")
     */

    public function editAction(Category $category){


        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('@Blog/categories/edit.html.twig',["category" => $category,'categories' => $categories]);

    }

    /**
     * @param Category $category
     * @param Request $request
     * @Route("/update/{slug}", name="blog_category_update")
     * @Method("PUT")
     * @return
     */


    public function updateAction(Category $category,Request $request){

        $file = $request->files->get('photo');
        $em=$this->getDoctrine()->getManager();
        $category->setTitle($request->request->get('title'));
        $category->setDescription($request->request->get('description'));
        $category->setMetaTitle($request->request->get('meta_title'));
        $category->setMetaDescription($request->request->get('meta_description'));
        $category->setMetaKeywords($request->request->get('meta_keywords'));
        $category->setSlug($request->request->get('slug'));

        $parent=$this->getDoctrine()->getRepository(Category::class)->find($request->request->get('parent'));
        $category->setParent($parent);

        if (null !== $file){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Blogs/Categories");

            $category->setPhoto($file_name);

            $em->merge($category);
            $em->flush();

            return $this->redirectToRoute('blog_category_index');
        }else{

            $em->merge($category);
            $em->flush();
            return $this->redirectToRoute('blog_category_index');
        }


    }

    /**
     * @param Category $category
     * @return Response
     * @Route("/{slug}", name="blog_category_show")
     * @Method("GET")
     */

    public function showAction(Category $category){

        if (null === $category)
            throw new ResourceNotFoundException('there is no category with this slug',404);
        return $this->render('@Blog/categories/show.html.twig',['category' => $category]);
    }


    /**
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/{slug}", name="blog_category_delete")
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
        return $this->redirectToRoute('blog_category_index');
     }

}
