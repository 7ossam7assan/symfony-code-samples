<?php

namespace PhotoAlbumBundle\Controller;

use PhotoAlbumBundle\Entity\Category;
use PhotoAlbumBundle\Entity\Photo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use  Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class PhotoController
 * @package PhotoAlbumBundle\Controller
 * @Route("/photo")
 */
class PhotoController extends Controller
{


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="photo_index")
     * @Method("GET")
     */

    public function indexAction(){


        $photos = $this->getDoctrine()
            ->getRepository(Photo::class)
            ->findAll();

        return $this->render('@PhotoAlbum/photos/index.html.twig',['photos' => $photos]);
    }



    /**
     * @Route("/create", name="photo_create")
     * @Method("GET")
     */
    public function createAction(){

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render('@PhotoAlbum/photos/create.html.twig',['categories' => $categories]);
    }


    /**
     * @param Request $request
     * @Route("/new",  name="photo_new")
     * @Method("GET")
     * @return
     */
    public function newAction(Request $request){


        $file = $request->files->get('photo');
        $em = $this->getDoctrine()->getManager();

        $category = $this->getDoctrine()->getRepository(Category::class)->find($request->request->get('category'));

        $photo = new Photo();
        $photo->setTitle($request->request->get('title'));
        $photo->setCategory($category);
        if (null !== $file){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Photos");

            $photo->setPhoto($file_name);

            $em->persist($photo);
            $em->flush();

            return $this->redirectToRoute('photo_index');
        }else{

            $em->persist($photo);
            $em->flush();
            return $this->redirectToRoute('photo_index');
        }


    }


    /**
     * @param Photo $photo
     * @return
     * @Route("/edit/{id}", name="photo_edit")
     * @Method("GET")
     */

    public function editAction(Photo $photo){

        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('@PhotoAlbum/photos/edit.html.twig',["photo" => $photo,'categories' => $categories]);

    }

    /**
     * @param Photo $photo
     * @param Request $request
     * @Route("/update/{id}", name="photo_update")
     * @Method("PUT")
     * @return Response
     */


    public function updateAction(Photo $photo,Request $request){



        $file = $request->files->get('photo');
        $em = $this->getDoctrine()->getManager();
            $category= $this->getDoctrine()
                ->getRepository(Category::class)
                ->find($request->request->get('category'));

        $photo->setTitle($request->request->get('title'));
        $photo->setCategory($category);

        if (null !== $file){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Photos");

            $photo->setPhoto($file_name);

            $em->persist($photo);
            $em->flush();

            return $this->redirectToRoute('photo_index');
        }else{

            $em->persist($photo);
            $em->flush();
            return $this->redirectToRoute('photo_index');
        }


    }

    /**
     * @param Photo $photo
     * @return
     * @Route("/{id}", name="photo_show")
     * @Method("GET")
     */

    public function showAction(Photo $photo){

        if (null === $photo)
            throw new ResourceNotFoundException('there is no category with this slug',404);

        return $this->render('@PhotoAlbum/photos/show.html.twig',['photo' => $photo]);
    }


    /**
     * @param Photo $photo
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete/{id}", name="photo_delete")
     * @Method("DELETE")
     */

    public function deleteAction(Photo $photo){


        if (null === $photo)
            throw new NotFoundResourceException('there is no category with this slug',404);

        $em=$this->getDoctrine()->getManager();
        $em->remove($photo);
        $em->flush();
        return $this->redirectToRoute('photo_index');
    }

}
