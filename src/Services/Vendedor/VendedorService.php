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
        $nomeVendedor = $dados->nome;
        $emailVendedor = $dados->email;

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
            $infoVendedor = ["Erro" => "Nome ou email do vendedor são inválidos !!!"];
        }

        return $infoVendedor;
    }

    public function buscarVendedores()
    {
        $infoVendedor = [];

        $vendedores = $this->vendedorRepository->findAll();

        foreach ($vendedores as $vendedor){



            array_push($infoVendedor, [
                "id"    => $vendedor->getId(),
                "nome"  => $vendedor->getNome(),
                "email" => $vendedor->getEmail()
            ]);
        }

        return $infoVendedor;
    }
}