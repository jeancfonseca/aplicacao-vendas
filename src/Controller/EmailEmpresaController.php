<?php

namespace App\Controller;

use App\Helper\ResponseFactory;
use App\Services\EmailEmpresa\EmailEmpresaService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmailEmpresaController extends AbstractController
{
    private $entityManager;

    public function __construct (EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/email/empresa", methods={"PUT"})
     */
    public function atualizarEmailEmpresa(Request $request): Response
    {
        $dados = $request->request->all();

        $emailEmpresaService = new EmailEmpresaService($this->entityManager);
        $emailEmpresa = $emailEmpresaService->atualizarEmailEmpresa($dados);

        $responseFactory = new ResponseFactory();

        return $responseFactory->getResponse($emailEmpresa);
    }
}
