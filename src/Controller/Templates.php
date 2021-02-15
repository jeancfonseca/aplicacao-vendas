<?php

namespace App\Controller;

use App\Repository\VendedorRepository;
use App\Services\Vendedor\VendedorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Templates extends AbstractController
{
    private $entityManager;
    private $vendedorRepository;

    public function __construct (EntityManagerInterface $entityManager, VendedorRepository $vendedorRepository)
    {
        $this->entityManager = $entityManager;
        $this->vendedorRepository = $vendedorRepository;
    }

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


    /**
     * @Route("/listar/vendedores", methods={"GET"})
     */
    public function clistarVendedor()
    {
        $vendedorService = new VendedorService($this->entityManager, $this->vendedorRepository);
        $vendedores = $vendedorService->buscarVendedores();

        return $this->render('/Vendedor/listar_vendedores.html.twig', ["vendedores" => $vendedores]);
    }
}