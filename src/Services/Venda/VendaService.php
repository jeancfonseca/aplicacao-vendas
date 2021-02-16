<?php

namespace App\Services\Venda;

use App\Entity\Vendas;
use App\Entity\Vendedor;
use App\Repository\VendasRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class VendaService
{
    private $entityManager;
    private $vendasRepository;
    private $mailer;

    public function __construct (EntityManagerInterface $entityManager, VendasRepository $vendasRepository, MailerInterface $mailer = null)
    {
        $this->entityManager = $entityManager;
        $this->vendasRepository = $vendasRepository;
        $this->mailer = $mailer;
    }

    public function cadastrarVenda($dados)
    {
        $idVendedor = $dados['id_vendedor'];
        $valorVenda = $dados['valor_venda'];

        if (!empty($idVendedor) && !empty($valorVenda)){

            $vendedorRepository = $this->entityManager->getRepository(Vendedor::class);
            $vendedor = $vendedorRepository->find($idVendedor);

            if (!is_null($vendedor)){
                $valorComissao = ($valorVenda / 100 * 8.5);

                $venda = new Vendas();

                $venda->setVendedor($vendedor);
                $venda->setDataVenda(new \DateTime());
                $venda->setValorVenda($valorVenda);
                $venda->setValorComissao($valorComissao);

                $this->entityManager->persist($venda);
                $this->entityManager->flush();

                $infoVenda = [
                    "id"    => $vendedor->getId(),
                    "nome"  => $vendedor->getNome(),
                    "email" => $vendedor->getEmail(),
                    "comissao"    => $venda->getValorComissao(),
                    "Valor_venda" => $venda->getValorVenda(),
                    "data_venda"  => $venda->getDataVenda()->format("d-m-Y H:i:s")
                ];
            }else{
                $infoVenda = ["Erro" => "Vendedor não encontrado !!!"];
            }
        }else{
            $infoVenda = ["Erro" => "Vendedor ou valor da venda são inválidos !!!"];
        }

        return $infoVenda;
    }

    public function enviarEmailRelatorioVendas()
    {
        $vendasFormatadoHtml = $this->vendasDoDia();

        $email = (new Email())
            ->from('aplicacaovendas@gmail.com')
            ->to('jean.fonseca94@hotmail.com')
            ->subject('Relatório de Vendas')
            ->html($vendasFormatadoHtml);

        $this->mailer->send($email);
    }

    private function vendasDoDia()
    {
        $diaHoraInicio = new \DateTime();
        $diaHoraInicio->setTime(00,00,00);

        $diaHoraFim = new \DateTime();
        $diaHoraFim->setTime(23,59,59);

        $vendasDoDia = $this->vendasRepository->buscarVendasDeHoje($diaHoraInicio, $diaHoraFim);

        $emailHtml = $this->tratarVendasDoDia($vendasDoDia);

        return $emailHtml;
    }

    private function tratarVendasDoDia($vendasDoDia)
    {
        $diaAtual = new \DateTime();
        $corpoTabelaVendas = '';

        $quantidadeVendas = 0;
        $totalVendas = 0;
        $totalComissao = 0;

        foreach ($vendasDoDia as $vendaDoDia){
            $quantidadeVendas ++;
            $totalVendas += $vendaDoDia['valor_venda'];
            $totalComissao += $vendaDoDia['valor_comissao'];

            $linhaTabea = '<tr><td>' . $vendaDoDia['nome'] . '</td><td>' . $vendaDoDia['valor_venda'] .
                '</td><td>' . $vendaDoDia['valor_comissao'] .'</td><td>' . $vendaDoDia['data_venda']->format("H:i:s") .'</td></tr>';

            $corpoTabelaVendas = $corpoTabelaVendas . $linhaTabea;
        }

        $emailHtml = '<p>Hoje dia <b>' . $diaAtual->format("d-m-Y") . '</b> foram efetuadas ' . $quantidadeVendas .
                     ' vendas com um total de R$ ' . number_format($totalVendas, 2, ',', ' ') . '.</p>
                     <table><tr><th>Vendedor</th><th>Valor da venda (em R$)</th><th>Valor da Comissão (em R$)</th><th>Hora da Venda</th></tr>' . $corpoTabelaVendas .
                     '<tr><td><b>Total</b></td><td>' . number_format($totalVendas, 2, ',', ' ') . '</td><td>' . number_format($totalComissao, 2, ',', ' ') .'</td><td> - </td></tr></table>
                     <style>table, td, th {border: 1px solid black; text-align: center;}</style>';

        return $emailHtml;
    }
}