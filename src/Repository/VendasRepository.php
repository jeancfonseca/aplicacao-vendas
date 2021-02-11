<?php

namespace App\Repository;

use App\Entity\Vendas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vendas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vendas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vendas[]    findAll()
 * @method Vendas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VendasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vendas::class);
    }

    // /**
    //  * @return Vendas[] Returns an array of Vendas objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vendas
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
