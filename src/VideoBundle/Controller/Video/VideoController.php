<?php

namespace VideoBundle\Controller\Video;

use ServiceBundle\Entity\Category\Category;
use ServiceBundle\Entity\Service\Service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use VideoBundle\Entity\Video;
use VideoBundle\Entity\VideoCategory;

/**
 * Class VideoController
 * @package VideoBundle\Controller\Video
 * @Route("/video")
 */
class VideoController extends Controller
{



    /**
     * @Route("/",name="video_index")
     * @return \Symfony\Component\HttpFoundation\Response
     * @Method("GET")
     */

    public function indexAction(){

//        dump("Hh");die();
        $videos = $this->getDoctrine()
            ->getRepository(Video::class)
            ->findAll();

        return $this->render("@Video/video/index.html.twig",['videos' => $videos]);
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/create",name="video_create")
     * @Method("GET")
     *
     */
    public function createAction(){

        $categories=$this->getDoctrine()
            ->getRepository(VideoCategory::class)
            ->findAll();

        return $this->render("@Video/video/create.html.twig",['categories' => $categories]);
    }

    /**
     * @param Request $request
     * @Route("/new",name="video_new")
     * @return Response
     * @Method("POST")
     */
    public function newAction(Request $request){

        $file = $request->files->get('photo');
        $em = $this->getDoctrine()->getManager();

        $category = $this->getDoctrine()->getRepository(VideoCategory::class)
            ->find($request->request->get('category'));

        $video = new Video();
        $video->setTitle($request->request->get('title'));
        $video->setDescription($request->request->get('description'));
        $video->setLink($request->request->get('link'));
        $video->setTags($request->request->get('tags'));
        $video->setCategory($category);

        $em->persist($video);
        $em->flush();
        return $this->redirectToRoute('video_index');

    }


    /**
     * @param Video $video
     * @return Response
     * @Route("/{id}/edit",name="video_edit")
     * @Method("GET")
     */
    public function editAction(Video $video){

        if (null === $video)
            throw new NotFoundResourceException("Video not found with this id",404);

        $categories=$this->getDoctrine()
            ->getRepository(VideoCategory::class)
            ->findAll();

        return $this->render("@Video/video/edit.html.twig",['video' => $video,'categories' => $categories]);

    }


    /**
     * @param Request $request
     * @param Video $video
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/update",name="video_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request,Video $video){

        $file = $request->files->get('photo');

        $em=$this->getDoctrine()->getManager();
        $category = $this->getDoctrine()->getRepository(VideoCategory::class)->find($request->request->get('category'));


        $video->setTitle($request->request->get('title'));
        $video->setDescription($request->request->get('description'));
        $video->setTags($request->request->get('tags'));
        $video->setLink($request->request->get('link'));
        $video->setCategory($category);


        $em->merge($video);
        $em->flush();
        return $this->redirectToRoute('video_index');



    }


    /**
     * @param Video $video
     * @return Response
     * @Route("/{id}",name="video_show")
     * @Method("GET")
     */
    public function showAction(Video $video){

        if (null === $video)
            throw new ResourceNotFoundException("video with this id not found",404);

        return $this->render("@Video/video/show.html.twig",["video" => $video]);

    }

    /**
     * @param Video $video
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/delete" ,name="video_delete")
     * @Method("GET")
     */

    public function deleteAction(Video $video){

        if (null === $video)
            throw new ResourceNotFoundException("video with this id not found",404);

        $em=$this->getDoctrine()->getManager();
        $em->remove($video);
        $em->flush();
        return $this->redirectToRoute("video_index");
    }

}
