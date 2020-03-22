<?php

namespace ServiceBundle\Controller\Service;

use ServiceBundle\Entity\Category\Category;
use ServiceBundle\Entity\Service\Service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Class ServiceController
 * @package ServiceBundle\Controller\Service
 * @Route("/service")
 */
class ServiceController extends Controller
{



    /**
     * @Route("/",name="service_index")
     * @return \Symfony\Component\HttpFoundation\Response
     * @Method("GET")
     */

    public function indexAction(){

        $services = $this->getDoctrine()
            ->getRepository(Service::class)
            ->findAll();

        return $this->render("@Service/service/index.html.twig",['services' => $services]);
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/create",name="service_create")
     * @Method("GET")
     *
     */
    public function createAction(){

        $categories=$this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render("@Service/service/create.html.twig",['categories' => $categories]);
    }

    /**
     * @param Request $request
     * @Route("/new",name="service_new")
     * @return Response
     * @Method("POST")
     */
    public function newAction(Request $request){

        $file = $request->files->get('photo');
        $em = $this->getDoctrine()->getManager();

        $category = $this->getDoctrine()->getRepository(Category::class)
            ->find($request->request->get('category'));

        $service = new Service();
        $service->setTitle($request->request->get('title'));
        $service->setDescription($request->request->get('description'));
        $service->setShortDesc($request->request->get('short_desc'));

        $service->setCategory($category);
        $service->setMetaTitle($request->request->get('meta_title'));
        $service->setMetaDescription($request->request->get('meta_description'));
        $service->setMetaKeywords($request->request->get('meta_keywords'));
        $service->setSlug($request->request->get('slug'));
        $service->setFeatured($request->request->get('featured'));


        if (null !== $file){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Service");

            $service->setPhoto($file_name);

            $em->persist($service);
            $em->flush();

            return $this->redirectToRoute('service_index');
        }else{

            $em->persist($service);
            $em->flush();
            return $this->redirectToRoute('service_index');
        }
    }


    /**
     * @param Service $service
     * @return Response
     * @Route("/{slug}/edit",name="service_edit")
     * @Method("GET")
     */
    public function editAction(Service $service){

        if (null === $service)
            throw new NotFoundResourceException("Project not found with this id",404);

        $categories=$this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render("@Service/service/edit.html.twig",['service' => $service,'categories' => $categories]);

    }


    /**
     * @param Request $request
     * @param Service $service
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{slug}/update",name="service_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request,Service $service){

        $file = $request->files->get('photo');

        $em=$this->getDoctrine()->getManager();
        $category = $this->getDoctrine()->getRepository(Category::class)->find($request->request->get('category'));


        $service->setTitle($request->request->get('title'));
        $service->setDescription($request->request->get('description'));
        $service->setShortDesc($request->request->get('short_desc'));


        $service->setCategory($category);
        $service->setMetaTitle($request->request->get('meta_title'));
        $service->setMetaDescription($request->request->get('meta_description'));
        $service->setMetaKeywords($request->request->get('meta_keywords'));
        $service->setSlug($request->request->get('slug'));
        $service->setFeatured($request->request->get('featured'));

        if (null !== $file){

            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Service");

            $service->setPhoto($file_name);

            $em->merge($service);
            $em->flush();

            return $this->redirectToRoute('service_index');
        }else{

            $em->merge($service);
            $em->flush();
            return $this->redirectToRoute('service_index');
        }


    }


    /**
     * @param Service $service
     * @return Response
     * @Route("/{slug}",name="service_show")
     * @Method("GET")
     */
    public function showAction(Service $service){

        if (null === $service)
            throw new ResourceNotFoundException("project with this id not found",404);

        return $this->render("@Service/service/show.html.twig",["service" => $service]);

    }

    /**
     * @param Service $service
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{slug}/delete" ,name="service_delete")
     * @Method("GET")
     */

    public function deleteAction(Service $service){

        if (null === $service)
            throw new ResourceNotFoundException("project with this id not found",404);

        $em=$this->getDoctrine()->getManager();
        $em->remove($service);
        $em->flush();
        return $this->redirectToRoute("service_index");
    }

}
