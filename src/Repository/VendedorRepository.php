<?php

namespace App\Repository;

use App\Entity\Vendas;
use App\Entity\Vendedor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Types\Type;
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
            ->setParameter('id_vendedor', $idVendedor, Type::INTEGER);

        return $qb->getQuery()->getArrayResult();
    }
}