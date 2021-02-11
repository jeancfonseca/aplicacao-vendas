<?php

namespace App\Services\Venda;

use App\Entity\Vendas;
use App\Entity\Vendedor;
use Doctrine\ORM\EntityManagerInterface;

class VendaService
{
    private $entityManager;

    public function __construct (EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function cadastrarVenda($dados)
    {
        $idVendedor = $dados->id_vendedor;
        $valorVenda = $dados->valor_venda;

        if (!empty($idVendedor) && !empty($valorVenda)){

            $valorComissao = ($valorVenda / 100 * 8.5);

            $vendedorReferencia = $this->entityManager->getReference(Vendedor::class, $idVendedor);

            $venda = new Vendas();

            $venda->setVendedor($vendedorReferencia);
            $venda->setDataVenda(new \DateTime());
            $venda->setValorVenda($valorVenda);
            $venda->setValorComissao($valorComissao);

            $this->entityManager->persist($venda);
            $this->entityManager->flush();

            $infoVenda = [
                "id"    => $vendedorReferencia->getId(),
                "nome"  => $vendedorReferencia->getNome(),
                "email" => $vendedorReferencia->getEmail(),
                "comissao"    => $venda->getValorComissao(),
                "Valor_venda" => $venda->getValorVenda(),
                "data_venda"  => $venda->getDataVenda()->format("d-m-Y H:i:s")
            ];
        }else{
            $infoVenda = ["Erro" => "Vendedor ou valor da venda são inválidos !!!"];
        }

        return $infoVenda;
    }
}