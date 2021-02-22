<?php

namespace App\Services\EmailEmpresa;

use App\Entity\EmailEmpresa;
use Doctrine\ORM\EntityManagerInterface;

class EmailEmpresaService
{
    private $entityManager;

    public function __construct (EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function atualizarEmailEmpresa($dados)
    {
        $novoEmailEmpresa = isset($dados['email_empresa']) ? $dados['email_empresa'] : [];

        if (!empty($novoEmailEmpresa)){
            $emailEmpresa = $this->entityManager->getRepository(EmailEmpresa::class)->buscarEmail();

            if (!is_null($emailEmpresa)){
                $emailEmpresa->setEmail($novoEmailEmpresa);

                $this->entityManager->persist($emailEmpresa);
                $this->entityManager->flush();

                $infoEmailEmpresa = [
                    "id"    => $emailEmpresa->getId(),
                    "email" => $emailEmpresa->getEmail()
                ];
            }else{
                $infoEmailEmpresa = ["erro" => "Email da empresa não encontrado !!!"];
            }
        }else{
            $infoEmailEmpresa = ["erro" => "Email da empresa é inválido !!!"];
        }

        return $infoEmailEmpresa;
    }
}