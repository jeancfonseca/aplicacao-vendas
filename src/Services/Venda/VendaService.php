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
}