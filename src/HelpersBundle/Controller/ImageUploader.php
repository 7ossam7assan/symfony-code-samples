<?php

namespace HelpersBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ImageUploader extends Controller
{


    public function uploadImage($file,$path){

        $ext=$file->guessExtension();
        $name=time().'.'.$ext;
        $file->move($path,$name);
//            $imagineCacheManager = $this->get('liip_imagine.cache.manager');
//            $p=$imagineCacheManager->getBrowserPath($path.'/'.$name, 'team_thumb');

        return $name;
    }


}
