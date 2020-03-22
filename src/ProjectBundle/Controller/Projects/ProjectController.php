<?php

namespace ProjectBundle\Controller\Projects;

use ProjectBundle\Entity\Categories\Category;
use ProjectBundle\Entity\Projects\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class ProjectController
 * @Route("/project")
 */
class ProjectController extends Controller
{


    /**
     * @Route("/",name="project_index")
     * @return \Symfony\Component\HttpFoundation\Response
     * @Method("GET")
     */

    public function indexAction(){

//        dump("Hh");die();
        $projects = $this->getDoctrine()
            ->getRepository(Project::class)
            ->findAll();

        return $this->render("@Project/projects/index.html.twig",['projects' => $projects]);
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/create",name="project_create")
     * @Method("GET")
     *
     */
    public function createAction(){

        $categories=$this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render("@Project/projects/create.html.twig",['categories' => $categories]);
    }

    /**
     * @param Request $request
     * @Route("/new",name="project_new")
     * @return Response
     * @Method("POST")
     */
    public function newAction(Request $request){

        $file = $request->files->get('photo');
        $em = $this->getDoctrine()->getManager();

        $category = $this->getDoctrine()->getRepository(Category::class)->find($request->request->get('category'));

        $project = new Project();
        $project->setTitle($request->request->get('title'));
        $project->setDescription($request->request->get('description'));

        $project->setCategory($category);
        $project->setMetaTitle($request->request->get('meta_title'));
        $project->setMetaDescription($request->request->get('meta_description'));
        $project->setMetaKeywords($request->request->get('meta_keywords'));
        $project->setSlug($request->request->get('slug'));

        if (null !== $file){
            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Projects");

            $project->setPhoto($file_name);

            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('project_index');
        }else{

            $em->persist($project);
            $em->flush();
            return $this->redirectToRoute('project_index');
        }
    }


    /**
     * @param Project $project
     * @return Response
     * @Route("/{id}/edit",name="project_edit")
     * @Method("GET")
     */
    public function editAction(Project $project){

        if (null === $project)
            throw new NotFoundResourceException("Project not found with this id");

        $categories=$this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render("@Project/projects/edit.html.twig",['project' => $project,'categories' => $categories]);

    }


    /**
     * @param Request $request
     * @param Project $project
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/update",name="project_update")
     * @Method("PUT")
     */
    public function updateAction(Request $request,Project $project){

        $file = $request->files->get('photo');

        $em=$this->getDoctrine()->getManager();
        $category = $this->getDoctrine()->getRepository(Category::class)->find($request->request->get('category'));


        $project->setTitle($request->request->get('title'));
        $project->setDescription($request->request->get('description'));


        $project->setCategory($category);
        $project->setMetaTitle($request->request->get('meta_title'));
        $project->setMetaDescription($request->request->get('meta_description'));
        $project->setMetaKeywords($request->request->get('meta_keywords'));
        $project->setSlug($request->request->get('slug'));

        if (null !== $file){

            $imageUploader=$this->get('Helpers.uploadImage');
            $file_name = $imageUploader->uploadImage($file,"uploads/Projects");

            $project->setPhoto($file_name);

            $em->merge($project);
            $em->flush();

            return $this->redirectToRoute('project_index');
        }else{

            $em->merge($project);
            $em->flush();
            return $this->redirectToRoute('project_index');
        }


    }


    /**
     * @param Project $project
     * @return Response
     * @Route("/{id}",name="project_show")
     * @Method("GET")
     */
    public function showAction(Project $project){

        if (null === $project)
            throw new ResourceNotFoundException("project with this id not found",404);

        return $this->render("@Project/projects/show.html.twig",["project" => $project]);

    }

    /**
     * @param Project $project
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/{id}/delete" ,name="project_delete")
     * @Method("GET")
     */

    public function deleteAction(Project $project){

        if (null === $project)
            throw new ResourceNotFoundException("project with this id not found",404);

        $em=$this->getDoctrine()->getManager();
        $em->remove($project);
        $em->flush();
        return $this->redirectToRoute("project_index");
    }

}
