<?php

namespace Aris\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ArisAdminBundle:Default:index.html.twig', array('name' => 'aris'));
    }
}
