<?php
/**
 * Created by PhpStorm.
 * User: mallahsoft
 * Date: 12/25/18
 * Time: 7:44 PM
 */

namespace AppBundle\Service;


use ConfigBundle\Entity\Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ServiceBundle\Entity\Category\Category;
use Symfony\Component\HttpFoundation\Session\Session;


class ConfigHelper extends Controller
{

    public $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function start()
    {
        $this->setCategories();
        $this->setConfig();
    }

    public function setCategories()
    {
        // categories
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        $this->session->set('categories', $categories);
    }


    public function setConfig()
    {
        // config
        $configArry = $this->getDoctrine()
            ->getRepository(Config::class)
            ->findAll();

        $config = [];
        foreach ($configArry as $con) {
            $config[$con->getVariable()] = $con->getValue();
        }

        $this->session->set('config', $config);
    }


    public function getCategories()
    {
        return $this->session->get('categories');
    }

    public function getConfig()
    {
        return $this->session->get('config');
    }


}