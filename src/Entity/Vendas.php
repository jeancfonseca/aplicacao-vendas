<?php

namespace App\Entity;

use App\Repository\VendasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VendasRepository::class)
 */
class Vendas
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vendedor")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vendedor;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data_venda;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $valor_venda;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $valor_comissao;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVendedor(): ?Vendedor
    {
        return $this->vendedor;
    }

    public function setVendedor(?Vendedor $vendedor): self
    {
        $this->vendedor = $vendedor;

        return $this;
    }

    public function getDataVenda(): ?\DateTimeInterface
    {
        return $this->data_venda;
    }

    public function setDataVenda(\DateTimeInterface $data_venda): self
    {
        $this->data_venda = $data_venda;

        return $this;
    }

    public function getValorVenda(): ?float
    {
        return $this->valor_venda;
    }

    public function setValorVenda(float $valor_venda): self
    {
        $this->valor_venda = $valor_venda;

        return $this;
    }

    public function getValorComissao(): ?float
    {
        return $this->valor_comissao;
    }

    public function setValorComissao(float $valor_comissao): self
    {
        $this->valor_comissao = $valor_comissao;

        return $this;
    }
}
