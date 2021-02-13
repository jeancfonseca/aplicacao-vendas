<?php

namespace App\Controller;

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

    public function __construct (EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/venda", methods={"POST"})
     */
    public function novaVenda(Request $request): Response
    {
        $dados = json_decode($request->getContent());

        $vendaService = new VendaService($this->entityManager);
        $venda = $vendaService->cadastrarVenda($dados);

        return $this->json($venda);
    }

    /**
     * @Route("/venda/relatorio", methods={"POST"})
     */
    public function enviarEmailRelatorioVendas(MailerInterface $mailer)
    {
        $vendaService = new VendaService($this->entityManager, $mailer);
        $relatorioVendas = $vendaService->enviarEmailRelatorioVendas();

        return $this->json($relatorioVendas);
    }
}
