<?php

namespace SliderBundle\Controller;

use FOS\RestBundle\Controller\ControllerTrait;
use SliderBundle\Entity\Slider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

class SliderApiController extends AbstractController
{

    use ControllerTrait;
    /**
     * @Rest\View()
     */

    public function getSlidersAction(){
        $sliderRepo=$this->getDoctrine()->getRepository(Slider::class);

        $sliders=$sliderRepo->findAll();
        if (count($sliders) > 0)
            return $this->view(["data" => $sliders, 'status' => Response::HTTP_OK]);
        else
            return $this->view(['data' => $sliders,'status' => Response::HTTP_NO_CONTENT]);

    }

    /**
     * @param Slider|null $slider
     * @return \FOS\RestBundle\View\View
     * @Rest\View()
     */

    public function getSliderAction(?Slider $slider){

        if (null == $slider){

            return $this->view(["data" => $slider,'status' => Response::HTTP_NO_CONTENT]);
        }

        return $this->view(["data" => $slider,'status' => Response::HTTP_OK]);
    }



    /**
     * @Rest\View()
     * @ParamConverter("slider", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     */
    public function postSliderAction(Slider $slider){

            $em = $this->getDoctrine()->getManager();
            try{
                $em->persist($slider);
                $em->flush();
                return $this->view(["data" => "done", "status" => Response::HTTP_OK]);
            }catch (\Exception $e) {

                return $this->view(["error" => $e->getMessage(),"status" => Response::HTTP_INTERNAL_SERVER_ERROR]);

            }
    }

    /**
     * @param  $sliderId
     * @return \FOS\RestBundle\View\View
     * @Rest\NoRoute()
     */

    public function deleteSliderAction($sliderId){


        $sliderRepo=$this->getDoctrine()->getRepository(Slider::class);
        $slider=$sliderRepo->find($sliderId);
        if (null == $slider){

            return $this->view(["error" => "there is no slider with this id" , "status" => Response::HTTP_INTERNAL_SERVER_ERROR]);
        }

        $em=$this->getDoctrine()->getManager();
        $em->remove($slider);
        $em->flush();
        return $this->view(["data" => " deleted Successfully","status" => Response::HTTP_OK]);
    }



    /**
     * @Rest\NoRoute()
     * @ParamConverter("modified_slider", converter="fos_rest.request_body")
     * @Rest\View()
     */

    public function patchSliderAction(Slider $slider,Slider $modified_slider){
//        dump($request);die();


        if (null == $slider)
            return $this->view(["error" => "no slider with this id","status" => Response::HTTP_INTERNAL_SERVER_ERROR]);

        $merger=$this->get('Api.EntityMerger');
        $merger->merge($slider,$modified_slider);
        $em=$this->getDoctrine()->getManager();
        $em->persist($slider);
        $em->flush();
        return $this->view(["data" => "done", "status" => Response::HTTP_OK]);
    }

}
