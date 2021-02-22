<?php

namespace App\Controller;

use App\Helper\ResponseFactory;
use App\Services\Vendedor\VendedorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VendedorController extends AbstractController
{
    private $entityManager;

    public function __construct (EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/vendedor", methods={"POST"})
     */
    public function novoVendedor(Request $request): Response
    {
        $dados = $request->request->all();

        $vendedorService = new VendedorService($this->entityManager);
        $vendedor = $vendedorService->cadastrarVendedor($dados);

        $responseFactory = new ResponseFactory();

        return $responseFactory->getResponse($vendedor);
    }

    /**
     * @Route("/vendedores", methods={"GET"})
     */
    public function buscarVendedores(): Response
    {
        $vendedorService = new VendedorService($this->entityManager);
        $vendedores = $vendedorService->buscarVendedores();

        $responseFactory = new ResponseFactory();

        return $responseFactory->getResponse($vendedores);
    }

    /**
     * @Route("/vendedor/{id_vendedor}", methods={"GET"})
     */
    public function buscarvendasVendedor(int $id_vendedor): Response
    {
        $vendedorService = new VendedorService($this->entityManager);
        $vendedor = $vendedorService->buscarVendasVendedor($id_vendedor);

        $responseFactory = new ResponseFactory();

        return $responseFactory->getResponse($vendedor);
    }
}