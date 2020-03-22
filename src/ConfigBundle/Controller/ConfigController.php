<?php

namespace ConfigBundle\Controller;

use ConfigBundle\Entity\Config;
use ConfigBundle\Entity\ConfigCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ConfigController
 * @package ConfigBundle\Controller
 * @Route("/config")
 */
class ConfigController extends Controller
{


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="config_index")
     * @Method("GET")
     */

    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();



        $configs = $this->getDoctrine()
            ->getRepository(Config::class)
            ->findAll();

        $categories = $this->getDoctrine()->getRepository(ConfigCategory::class)->findAll();


        return $this->render('@Config/Default/index.html.twig',
            [
                "configs" => $configs,
                "categories" => $categories,
            ]
        );
    }


    /**
     * @param Request $request
     * @Route("/conf",name="config_update")
     * @Method("PUT")
     * @return
     */

    public function updateAction(Request $request){
//        $logo_file = $request->files->get('logo');
//        $fav_icon_file = $request->files->get('favicon');
//
//        $em=$this->getDoctrine()->getManager();
//
//        $page->setTitle($request->request->get('title'));
//        $page->setContent($request->request->get('content'));
//        $page->setCategory($category);
//        $page->setMetaTitle($request->request->get('meta_title'));
//        $page->setMetaDescription($request->request->get('meta_description'));
//        $page->setMetaKeywords($request->request->get('meta_keywords'));
//        $page->setSlug($request->request->get('slug'));
//
//        if (null !== $file){
//
//            $imageUploader=$this->get('Helpers.uploadImage');
//            $file_name = $imageUploader->uploadImage($file,"uploads/Pages");
//
//            $page->setPhoto($file_name);
//
//            $em->merge($page);
//            $em->flush();
//
//            return $this->redirectToRoute('pages_index');
//        }else{
//
//            $em->merge($page);
//            $em->flush();
//            return $this->redirectToRoute('pages_index');
//        }

        $em = $this->getDoctrine()->getManager();

        if ($request->files->count() > 0)
        {

            $logo = $request->files->get('logo');
            if (null !== $logo){
                $setting_update = $this->getDoctrine()->getRepository(Config::class)->findOneBy(['variable'=> 'logo']);
                $imageUploader=$this->get('Helpers.uploadImage');
                $file_name = $imageUploader->uploadImage($logo,"uploads/Config");
                $setting_update->setValue($file_name);

                $em->merge($setting_update);
            }
            $favicon = $request->files->get('favicon');
            if (null !== $favicon){
                $setting_update = $this->getDoctrine()->getRepository(Config::class)->findOneBy(['variable'=> 'favicon']);
                $imageUploader=$this->get('Helpers.uploadImage');
                $file_name = $imageUploader->uploadImage($favicon,"uploads/Config");
                $setting_update->setValue($file_name);

                $em->merge($setting_update);
            }
        }
        $r=$request->request->all();
//        dump($r);die();
        foreach ($r as $key => $req){
            if($key !== "_method") {
//            dump($req[$key]);die();

                $setting_update = $this->getDoctrine()->getRepository(Config::class)->findOneBy(['variable'=> $key]);
                if ($setting_update) {
                    $setting_update->setValue($req);
                    $em->persist($setting_update);
                }
            }

        }
        $em->flush();

        return $this->redirectToRoute('config_index');
    }
}
