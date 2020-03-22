<?php

namespace TeamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use TeamBundle\Entity\Team;

/**
 * Class TeamController
 * @package TeamBundle\Controller
 * @Route("/team")
 */
class TeamController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="team_index")
     * @Method("GET")
     */
    public function indexAction(){

        $teams = $this->getDoctrine()
            ->getRepository(Team::class)
            ->findAll();
        return $this->render('@Team/index.html.twig',['teams' => $teams]);
    }


    /**
     *
     * @Route("/create", name="team_create")
     * @Method("GET")
     */

    public function createAction(){

        return $this->render('@Team/create.html.twig');

    }

    /**
     * @param Request $request
     * @Route("/new", name="team_new")
     * @Method("POST")
     */

    public function newAction(Request $request){


        $file = $request->files->get('photo');
        $em = $this->getDoctrine()->getManager();

        $team = new Team();
        $team->setTitle($request->request->get('title'));
        $team->setJobTitle($request->request->get('job_title'));
        $team->setEmail($request->request->get('email'));
        $team->setPhone($request->request->get('phone'));
        $team->setPlace($request->request->get('place'));
        $team->setSlug($request->request->get('slug'));
        $team->setDescription($request->request->get('description'));

        $team->setFbLink($request->request->get('fb-link'));
        $team->setTwitterLink($request->request->get('twitter-link'));
        $team->setInstagramLink($request->request->get('instagram-link'));
        $team->setYoutubeLink($request->request->get('youtube-link'));
        $team->setSkypeLink($request->request->get('skype-link'));

        $team->setMetaTitle($request->request->get('meta_title'));
        $team->setMetaDescription($request->request->get('meta_description'));
        $team->setMetaKeywords($request->request->get('meta_keywords'));


        if (null !== $file){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Teams");

            $team->setPhoto($file_name);

            $em->persist($team);
            $em->flush();

            return $this->redirectToRoute('team_index');
        }else{

            $em->persist($team);
            $em->flush();
            return $this->redirectToRoute('team_index');
        }

    }

    /**
     * @param Team $team
     * @Route("/edit/{slug}", name="team_edit")
     * @Method("GET")
     * @return
     */
    public function editAction(Team $team){


        if (null ==  $team)
            throw new ResourceNotFoundException('There is no team with this slug',404);
        return $this->render('@Team/edit.html.twig',['team' => $team]);

    }

    /**
     * @param Team $team
     * @param Request $request
     * @Route("/update/{slug}", name="team_update")
     * @Method("PUT")
     * @return
     */
    public function updateAction(Team $team, Request $request){
        $file = $request->files->get('photo');
        $em = $this->getDoctrine()->getManager();


        $team->setTitle($request->request->get('title'));
        $team->setJobTitle($request->request->get('job_title'));
        $team->setEmail($request->request->get('email'));
        $team->setPhone($request->request->get('phone'));
        $team->setPlace($request->request->get('place'));
        $team->setSlug($request->request->get('slug'));
        $team->setDescription($request->request->get('description'));

        $team->setFbLink($request->request->get('fb-link'));
        $team->setTwitterLink($request->request->get('twitter-link'));
        $team->setInstagramLink($request->request->get('instagram-link'));
        $team->setYoutubeLink($request->request->get('youtube-link'));
        $team->setSkypeLink($request->request->get('skype-link'));

        $team->setMetaTitle($request->request->get('meta_title'));
        $team->setMetaDescription($request->request->get('meta_description'));
        $team->setMetaKeywords($request->request->get('meta_keywords'));


        if (null !== $file){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Teams");

            $team->setPhoto($file_name);

            $em->persist($team);
            $em->flush();

            return $this->redirectToRoute('team_index');
        }else{

            $em->persist($team);
            $em->flush();
            return $this->redirectToRoute('team_index');
        }


    }

    /**
     * @param Team $team
     * @Route("/{slug}", name="team_show")
     * @Method("GET")
     * @return
     */


    public function showAction(Team $team){


        if (null == $team)
            throw new ResourceNotFoundException('there is no team with this slug',404);

        return $this->render('@Team/show.html.twig',['team' => $team]);

    }

    /**
     * @param Team $team
     * @Route("/delete/{slug}",name="team_delete")
     * @Method("DELETE")
     * @return
     */
    public function deleteAction(Team $team){

        if (null == $team)
            throw new ResourceNotFoundException('There is no team with this slug',404);

        $em= $this->getDoctrine()->getManager();
        $em->remove($team);
        $em->flush();

        return $this->redirectToRoute('team_index');

    }



}
