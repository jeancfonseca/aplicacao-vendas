<?php

namespace App\Repository;

use App\Entity\Vendas;
use App\Entity\Vendedor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vendedor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vendedor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vendedor[]    findAll()
 * @method Vendedor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendedorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vendedor::class);
    }

    public function buscarComissaoPorIdVendedor($idVendedor)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('v.valor_comissao')
            ->from(Vendas::class, 'v')
            ->where(
                $qb->expr()->eq('v.vendedor', ':id_vendedor')
            )
            ->setParameter('id_vendedor', $idVendedor);

        return $qb->getQuery()->getArrayResult();
    }

    public function buscarVendasPorIdVendedor($idVendedor)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('v.valor_comissao, v.valor_venda, v.data_venda')
            ->from(Vendas::class, 'v')
            ->where(
                $qb->expr()->eq('v.vendedor', ':id_vendedor')
            )
            ->setParameter('id_vendedor', $idVendedor);

        return $qb->getQuery()->getArrayResult();
    }

    public function buscarVendedores()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('v.id, v.nome')
            ->from(Vendedor::class, 'v');

        return $qb->getQuery()->getArrayResult();
    }
}