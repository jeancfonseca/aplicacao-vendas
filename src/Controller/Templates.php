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

    /**
     * @Route("/cadastrar/vendedor", methods={"GET"})
     */
    public function cadastrarVendedor()
    {
        return $this->render('/Vendedor/cadastrar_vendedor.html.twig');
    }

    /**
     * @Route("/cadastrar/venda", methods={"GET"})
     */
    public function cadastrarVenda()
    {
        return $this->render('/Venda/cadastrar_venda.html.twig');
    }
}