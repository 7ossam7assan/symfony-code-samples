<?php

namespace BlogBundle\Controller\Blog;

use BlogBundle\Entity\Blog\Blog;
use BlogBundle\Entity\Category\Category;
use BlogBundle\Enums\BlogTypeEnum;
use BlogBundle\Enums\PageActiveTypeEnum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Class BlogController
 * @package BlogBundle\Controller\Blog
 * @Route("/blog")
 */
class BlogController extends Controller
{




    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="blog_index")
     * @Method("GET")
     */

    public function indexAction(){


        $blogs = $this->getDoctrine()
            ->getRepository(Blog::class)
            ->findAll();

        return $this->render('@Blog/blogs/index.html.twig',['blogs' => $blogs]);
    }



    /**
     * @Route("/create", name="blog_create")
     * @Method("GET")
     */
    public function createAction(){

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        $types=BlogTypeEnum::getAvailableTypes();
        return $this->render('@Blog/blogs/create.html.twig',['categories' => $categories,'types' => $types]);
    }


    /**
     * @param Request $request
     * @Route("/new",  name="blog_new")
     * @Method("GET")
     * @return
     */
    public function newAction(Request $request){


        $file = $request->files->get('photo');
        $em = $this->getDoctrine()->getManager();

        foreach ($request->request->get('categories') as $category)
             $categories[] = $this->getDoctrine()->getRepository(Category::class)->find($category);

        $blog = new Blog();
        $blog->setTitle($request->request->get('title'));
        $blog->setType($request->request->get('type'));
        $blog->setCategories($categories);

        $blog->setDescription($request->request->get('description'));
        $blog->setShortDesc($request->request->get('short_desc'));
        $blog->setNumOfViews($request->request->get('num_of_views'));
        $blog->setTags($request->request->get('tags'));
        $blog->setMetaTitle($request->request->get('meta_title'));
        $blog->setMetaDescription($request->request->get('meta_description'));
        $blog->setMetaKeywords($request->request->get('meta_keywords'));
        $blog->setSlug($request->request->get('slug'));

        if (null !== $file){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Blogs");

            $blog->setPhoto($file_name);

            $em->persist($blog);
            $em->flush();

            return $this->redirectToRoute('blog_index');
        }else{

            $em->persist($blog);
            $em->flush();
            return $this->redirectToRoute('blog_index');
        }


    }


    /**
     * @param Blog $blog
     * @return
     * @Route("/edit/{slug}", name="blog_edit")
     * @Method("GET")
     */

    public function editAction(Blog $blog){

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        $types=BlogTypeEnum::getAvailableTypes();
        return $this->render('@Blog/blogs/edit.html.twig',["blog" => $blog,'categories' => $categories,'types' => $types]);

    }

    /**
     * @param Blog $blog
     * @param Request $request
     * @Route("/update/{slug}", name="blog_update")
     * @Method("PUT")
     * @return Response
     */


    public function updateAction(Blog $blog,Request $request){



        $file = $request->files->get('photo');
        $em = $this->getDoctrine()->getManager();

        foreach ($request->request->get('categories') as $category)
            $categories[] = $this->getDoctrine()->getRepository(Category::class)->find($category);

        $blog->setTitle($request->request->get('title'));
        $blog->setType($request->request->get('type'));
        $blog->setCategories($categories);

        $blog->setDescription($request->request->get('description'));
        $blog->setShortDesc($request->request->get('short_desc'));
        $blog->setNumOfViews($request->request->get('num_of_views'));
        $blog->setTags($request->request->get('tags'));
        $blog->setMetaTitle($request->request->get('meta_title'));
        $blog->setMetaDescription($request->request->get('meta_description'));
        $blog->setMetaKeywords($request->request->get('meta_keywords'));
        $blog->setSlug($request->request->get('slug'));

        if (null !== $file){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Blogs");

            $blog->setPhoto($file_name);

            $em->persist($blog);
            $em->flush();

            return $this->redirectToRoute('blog_index');
        }else{

            $em->persist($blog);
            $em->flush();
            return $this->redirectToRoute('blog_index');
        }


    }

    /**
     * @param Blog $blog
     * @return
     * @Route("/{slug}", name="blog_show")
     * @Method("GET")
     */

    public function showAction(Blog $blog){

        if (null === $blog)
            throw new ResourceNotFoundException('there is no category with this slug',404);

        return $this->render('@Blog/blogs/show.html.twig',['blog' => $blog]);
    }


    /**
     * @param Blog $blog
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/{slug}", name="blog_delete")
     * @Method("DELETE")
     */

    public function deleteAction(Blog $blog){


        if (null === $blog)
            throw new NotFoundResourceException('there is no category with this slug',404);

        $em=$this->getDoctrine()->getManager();
        $em->remove($blog);
        $em->flush();
        return $this->redirectToRoute('blog_index');
    }


}
