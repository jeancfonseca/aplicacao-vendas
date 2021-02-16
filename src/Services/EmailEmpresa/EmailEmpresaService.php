<?php

namespace App\Services\Vendedor;

use App\Repository\EmailEmpresaRepository;
use Doctrine\ORM\EntityManagerInterface;

class EmailEmpresaService
{
    private $entityManager;
    private $emailEmpresaRepository;

    public function __construct (EntityManagerInterface $entityManager, EmailEmpresaRepository $emailEmpresaRepository)
    {
        $this->entityManager = $entityManager;
        $this->emailEmpresaRepository = $emailEmpresaRepository;
    }

    public function atualizarEmailEmpresa($dados)
    {
        $novoEmailEmpresa = $dados['email_empresa'];

        if (!empty($novoEmailEmpresa)){
            $emailEmpresa = $this->emailEmpresaRepository->buscarEmail();

            if (!is_null($emailEmpresa)){
                $emailEmpresa->setEmail($novoEmailEmpresa);

                $this->entityManager->persist($emailEmpresa);
                $this->entityManager->flush();

                $infoEmailEmpresa = [
                    "id"    => $emailEmpresa->getId(),
                    "email" => $emailEmpresa->getEmail()
                ];
            }else{
                $infoEmailEmpresa = ["Erro" => "Email da empresa não encontrado !!!"];
            }
        }else{
            $infoEmailEmpresa = ["Erro" => "Email da empresa é inválido !!!"];
        }

        return $infoEmailEmpresa;
    }
}