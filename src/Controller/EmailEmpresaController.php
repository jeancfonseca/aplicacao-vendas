<?php

namespace App\Controller;

use App\Repository\EmailEmpresaRepository;
use App\Services\EmailEmpresa\EmailEmpresaService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmailEmpresaController extends AbstractController
{
    private $entityManager;
    private $emailEmpresaRepository;

    public function __construct (EntityManagerInterface $entityManager, EmailEmpresaRepository $emailEmpresaRepository)
    {
        $this->entityManager = $entityManager;
        $this->emailEmpresaRepository = $emailEmpresaRepository;
    }

    /**
     * @Route("/email/empresa", methods={"PUT"})
     */
    public function atualizarEmailEmpresa(Request $request): Response
    {
        $dados = $request->request->all();

        $emailEmpresaService = new EmailEmpresaService($this->entityManager, $this->emailEmpresaRepository);
        $emailEmpresa = $emailEmpresaService->atualizarEmailEmpresa($dados);

        return $this->json($emailEmpresa);
    }
}
