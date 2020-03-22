<?php

namespace SliderBundle\Controller;


use SliderBundle\Entity\Slider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter as ParamConverter;


/**
 * Slider controller.
 *
 * @Route("slider")
 */
class SliderController extends Controller
{



    /**
     * Lists all slider entities.
     *
     * @Route("/", name="slider_index")
     * @Method("GET")
     */
    public function indexAction()
    {

        $sliders = $this->getDoctrine()
            ->getRepository(Slider::class)
            ->findAll();


        return $this->render('@Slider/index.html.twig', array(
            'sliders' => $sliders,
        ));
    }


    /**
     * @Route("/create" ,name="slider_create")
     * @Method("GET")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(){

        return $this->render('@Slider/create.html.twig');

    }
    /**
     * Creates a new slider entity.
     *
     * @Route("/new", name="slider_new")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {

        $file=$request->files->get('photo');

        if ($file !== null){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Sliders");
            $slider=new  Slider();
            $slider->setTitle($request->request->get('title'));
            $slider->setDescription($request->request->get('description'));
            $slider->setPhoto($file_name);
            $em=$this->getDoctrine()->getManager();
            $em->persist($slider);
            $em->flush();
            return $this->redirectToRoute('slider_create');
        }else{
            $errors[]="file size is to big";
            return $this->redirectToRoute('slider_create');
        }


    }

    /**
     * @Route("/{id}", name="slider_show")
     * @param Slider $slider
     * @return Response
     */
    public function showAction(Slider $slider)
    {

        if ($slider === null){
        throw new NotFoundResourceException();
        }

        return $this->render('@Slider/show.html.twig',['slider' => $slider]);
    }


    /**
     * @Route("/{id}/edit", name="slider_edit")
     * @Method("GET")
     * @ParamConverter("id")
     */
    public function editAction(Request $request,Slider $slider){

//        dump($slider);die();
        return $this->render('@Slider/edit.html.twig',['slider' => $slider]);
    }
    /**
     * Displays a form to edit an existing slider entity.
     *
     * @Route("/{id}/update", name="slider_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request, Slider $slider)
    {

        $slider->setTitle($request->request->get('title'));
        $slider->setDescription($request->request->get('description'));

        $em=$this->getDoctrine()->getManager();
        $file=$request->files->get('photo');


        if ($file !== null){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Sliders");

            $slider->setTitle($request->request->get('title'));
            $slider->setDescription($request->request->get('description'));
            $slider->setPhoto($file_name);
            $em->merge($slider);
            $em->flush();
            return $this->redirectToRoute('slider_edit',['id' => $slider->getId(),]);
        }else{
            $em->merge($slider);
            $em->flush();
            $errors[]="file size is to big";
            return  $this->redirectToRoute('slider_edit',['id' => $slider->getId(), 'errors' => $errors]);

        }

    }

    /**
     * @Route("/{id}/delete", name="slider_delete")
     * @param Slider $slider
     * @return Response
     */
    public function deleteAction(Slider $slider)
    {

        $em=$this->getDoctrine()->getManager();
        $em->remove($slider);
        $em->flush();
        return $this->redirect('/slider/');


    }

}
