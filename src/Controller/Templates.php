<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Templates extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function home()
    {
        return $this->render('/Menu/menu.html.twig');
    }
}