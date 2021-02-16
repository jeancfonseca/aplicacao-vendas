<?php

namespace App\Services\Vendedor;

use App\Entity\Vendedor;
use App\Repository\VendedorRepository;
use Doctrine\ORM\EntityManagerInterface;

class VendedorService
{
    private $entityManager;
    private $vendedorRepository;

    public function __construct (EntityManagerInterface $entityManager, VendedorRepository $vendedorRepository)
    {
        $this->entityManager = $entityManager;
        $this->vendedorRepository = $vendedorRepository;
    }

    public function cadastrarVendedor($dados)
    {
        $nomeVendedor = isset($dados['nome']) ? $dados['nome'] : [];
        $emailVendedor = isset($dados['email']) ? $dados['email'] : [];

        if (!empty($nomeVendedor) && !empty($emailVendedor)){
            $vendedor = new Vendedor();

            $vendedor->setNome($nomeVendedor);
            $vendedor->setEmail($emailVendedor);

            $this->entityManager->persist($vendedor);
            $this->entityManager->flush();

            $infoVendedor = [
                "id"    => $vendedor->getId(),
                "nome"  => $vendedor->getNome(),
                "email" => $vendedor->getEmail()
            ];
        }else{
            $infoVendedor = ["erro" => "Nome ou email do vendedor são inválidos !!!"];
        }

        return $infoVendedor;
    }

    public function buscarVendedores()
    {
        $infoVendedor = [];

        $vendedores = $this->vendedorRepository->findAll();

        foreach ($vendedores as $vendedor){
            $comissaoTotalVendedor = 0;

            $comissoesVendedor = $this->vendedorRepository->buscarComissaoPorIdVendedor($vendedor->getId());

            foreach ($comissoesVendedor as $comissaoVendedor){
                $comissaoTotalVendedor += $comissaoVendedor['valor_comissao'];
            }

            array_push($infoVendedor, [
                "id"       => $vendedor->getId(),
                "nome"     => $vendedor->getNome(),
                "email"    => $vendedor->getEmail(),
                "comissao" => number_format($comissaoTotalVendedor, 2, ',', ' ')
            ]);
        }

        return $infoVendedor;
    }

    public function buscarVendasVendedor($idVendedor)
    {
        $vendedor = $this->vendedorRepository->find($idVendedor);

        if (!is_null($vendedor)){
            $vendas = [];

            $vendasVendedor = $this->vendedorRepository->buscarVendasPorIdVendedor($vendedor->getId());

            foreach ($vendasVendedor as $vendaVendedor){
                array_push($vendas, [
                    "comissao"    => number_format($vendaVendedor['valor_comissao'], 2, ',', ' '),
                    "valor_venda" => number_format($vendaVendedor['valor_venda'], 2, ',', ' '),
                    "data_venda"  => $vendaVendedor['data_venda']->format("d-m-Y H:i:s")
                ]);
            }

            $infoVendasVendedor = [
                "id"     => $vendedor->getId(),
                "nome"   => $vendedor->getNome(),
                "email"  => $vendedor->getEmail(),
                "vendas" => $vendas
            ];
        }else{
            $infoVendasVendedor = ["erro" => "Vendedor não encontrado !!!"];
        }

        return $infoVendasVendedor;
    }

    public function buscarVendedoresCadastroVenda()
    {
        $vendedores = $this->vendedorRepository->buscarVendedores();

        return $vendedores;
    }
}