<?php

namespace WorkTimeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use WorkTimeBundle\Entity\WorkTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class WorkTimeController
 * @package WorkTimeBundle\Controller
 * Route("/work-time")
 */
class WorkTimeController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="time_index")
     * @Method("GET")
     */
    public function indexAction(){

        $times = $this->getDoctrine()
            ->getRepository(WorkTime::class)
            ->findAll();
        return $this->render('@WorkTime/index.html.twig',['times' => $times]);
    }


    /**
     *
     * @Route("/create", name="time_create")
     * @Method("GET")
     */

    public function createAction(){

        return $this->render('@WorkTime/create.html.twig');

    }

    /**
     * @param Request $request
     * @Route("/new", name="time_new")
     * @Method("POST")
     * @return
     */

    public function newAction(Request $request){


        $em = $this->getDoctrine()->getManager();

        $time = new WorkTime();
        $time->setDayName($request->request->get('day_name'));
        $time->setTimeFrom($request->request->get('time_from'));
        $time->setTimeTo($request->request->get('time_to'));

        $em->persist($time);
        $em->flush();
        return $this->redirectToRoute('time_index');


    }

    /**
     * @param WorkTime $time
     * @Route("/edit/{id}", name="time_edit")
     * @Method("GET")
     * @return
     */
    public function editAction(WorkTime $time){


        if (null ==  $time)
            throw new ResourceNotFoundException('There is no team with this slug',404);
        return $this->render('@WorkTime/edit.html.twig',['time' => $time]);

    }

    /**
     * @param WorkTime $time
     * @param Request $request
     * @Route("/update/{id}", name="time_update")
     * @Method("PUT")
     * @return
     */
    public function updateAction(WorkTime $time, Request $request){

        $em = $this->getDoctrine()->getManager();
        $time->setDayName($request->request->get('day_name'));
        $time->setTimeFrom($request->request->get('time_from'));
        $time->setTimeTo($request->request->get('time_to'));
        $em->persist($time);
        $em->flush();
        return $this->redirectToRoute('time_index');

    }

    /**
     * @param WorkTime $time
     * @Route("/{id}", name="time_show")
     * @Method("GET")
     * @return
     */


    public function showAction(WorkTime $time){


        if (null == $time)
            throw new ResourceNotFoundException('there is no team with this slug',404);

        return $this->render('@WorkTime/show.html.twig',['time' => $time]);

    }

    /**
     * @param WorkTime $time
     * @Route("/delete/{id}",name="time_delete")
     * @Method("DELETE")
     * @return
     */
    public function deleteAction(WorkTime $time){

        if (null == $time)
            throw new ResourceNotFoundException('There is no team with this slug',404);

        $em= $this->getDoctrine()->getManager();
        $em->remove($time);
        $em->flush();

        return $this->redirectToRoute('time_index');

    }


}
