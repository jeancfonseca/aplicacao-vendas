<?php

namespace App\Controller;

use App\Repository\VendasRepository;
use App\Services\Venda\VendaService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class VendaController extends AbstractController
{
    private $entityManager;
    private $vendasRepository;

    public function __construct (EntityManagerInterface $entityManager, VendasRepository $vendasRepository)
    {
        $this->entityManager = $entityManager;
        $this->vendasRepository = $vendasRepository;
    }

    /**
     * @Route("/venda", methods={"POST"})
     */
    public function novaVenda(Request $request): Response
    {
        $dados = $request->request->all();

        $vendaService = new VendaService($this->entityManager, $this->vendasRepository);
        $venda = $vendaService->cadastrarVenda($dados);

        return $this->json($venda);
    }

    /**
     * @Route("/venda/relatorio", methods={"POST"})
     */
    public function enviarEmailRelatorioVendas(MailerInterface $mailer)
    {
        $vendaService = new VendaService($this->entityManager, $this->vendasRepository, $mailer);
        $vendaService->enviarEmailRelatorioVendas();

        return $this->json([]);
    }
}
