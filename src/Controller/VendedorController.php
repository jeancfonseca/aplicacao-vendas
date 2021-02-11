<?php

namespace App\Controller;

use App\Repository\VendedorRepository;
use App\Services\Vendedor\VendedorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VendedorController extends AbstractController
{
    private $entityManager;
    private $vendedorRepository;

    public function __construct (EntityManagerInterface $entityManager, VendedorRepository $vendedorRepository)
    {
        $this->entityManager = $entityManager;
        $this->vendedorRepository = $vendedorRepository;
    }

    /**
     * @Route("/vendedor", methods={"POST"})
     */
    public function novoVendedor(Request $request): Response
    {
        $dados = json_decode($request->getContent());

        $vendedorService = new VendedorService($this->entityManager, $this->vendedorRepository);
        $vendedor = $vendedorService->cadastrarVendedor($dados);

        return $this->json($vendedor);
    }

    /**
     * @Route("/vendedores", methods={"GET"})
     */
    public function buscarVendedores(): Response
    {
        $vendedorService = new VendedorService($this->entityManager, $this->vendedorRepository);
        $vendedores = $vendedorService->buscarVendedores();

        return $this->json($vendedores);
    }
}
