<?php

namespace PagesBundle\Controller\Pages;

use PagesBundle\Entity\Categories\Category;
use PagesBundle\Entity\Pages\Pages;
use PagesBundle\Enums\PageActiveTypeEnum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * @Route("/pages")
 */
class PagesController extends Controller
{


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="pages_index")
     * @Method("GET")
     * @return
     */
    public function indexAction(){
        $pages = $this->getDoctrine()
            ->getRepository(Pages::class)
            ->findAll();

        return $this->render('@Pages/pages/index.html.twig',['pages' => $pages]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/create", name="pages_create")
     * @Method("GET")
     * @return
     */

    public function createAction(){


        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render('@Pages/pages/create.html.twig',['categories' => $categories]);
    }


    /**
     * @param Request $request
     *
     * @Route("/new", name="pages_new")
     * @Method("POST")
     * @return Response
     */
    public function newAction(Request $request){

        $file = $request->files->get('photo');
        $em = $this->getDoctrine()->getManager();

        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->find($request->request->get('category'));

        $page = new Pages();
        $page->setTitle($request->request->get('title'));
        $page->setActive(PageActiveTypeEnum::TYPE_NOT_ACTIVE);
        $page->setContent($request->request->get('content'));
        $page->setCategory($category);
        $page->setMetaTitle($request->request->get('meta_title'));
        $page->setMetaDescription($request->request->get('meta_description'));
        $page->setMetaKeywords($request->request->get('meta_keywords'));
        $page->setSlug($request->request->get('slug'));

        if (null !== $file){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Pages");

            $page->setPhoto($file_name);

            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('pages_index');
        }else{

            $em->persist($page);
            $em->flush();
            return $this->redirectToRoute('pages_index');
        }


    }

    /**
     * @param Pages $page
     * @Route("/edit/{slug}", name="pages_edit")
     * @Method("GET")
     * @return Response
     */
    public function editAction(Pages $page){
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('@Pages/pages/edit.html.twig',['page' => $page,'categories' => $categories]);
    }


    /**
     * @param Pages $page
     * @param Request $request
     * @Route("/update/{slug}", name="pages_update")
     * @Method("PUT")
     * @return Response
     */
    public function updateAction(Pages $page,Request $request){


        $file = $request->files->get('photo');

        $em=$this->getDoctrine()->getManager();
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->find($request->request->get('category'));


        $page->setTitle($request->request->get('title'));
        $page->setContent($request->request->get('content'));
        $page->setCategory($category);
        $page->setMetaTitle($request->request->get('meta_title'));
        $page->setMetaDescription($request->request->get('meta_description'));
        $page->setMetaKeywords($request->request->get('meta_keywords'));
        $page->setSlug($request->request->get('slug'));

        if (null !== $file){

            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Pages");

            $page->setPhoto($file_name);

            $em->merge($page);
            $em->flush();

            return $this->redirectToRoute('pages_index');
        }else{

            $em->merge($page);
            $em->flush();
            return $this->redirectToRoute('pages_index');
        }



    }

    /**
     * @param Pages $page
     * @return Response
     * @Route("/{slug}", name="pages_show")
     */
    public function showAction(Pages $page){
        if (null === $page)

        return $this->render('@Pages/pages/show.html.twig',['page' => $page]);
    }

    /**
     * @param Pages $page
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/{slug}", name="pages_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Pages $page){
        if (null === $page)
            throw new ResourceNotFoundException('there is no page with this slug');

        $em=$this->getDoctrine()->getManager();
        $em->remove($page);
        $em->flush();
        return $this->redirectToRoute("pages_index");
    }





}
