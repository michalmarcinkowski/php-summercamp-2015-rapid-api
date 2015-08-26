<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class DefaultController extends FOSRestController
{
    public function homepageAction()
    {
        $view = $this
            ->view()
            ->setData(array('message' => 'Welcome to the Rapid API development with Lionframe workshop!'))
        ;

        return $this->handleView($view);
    }
}
