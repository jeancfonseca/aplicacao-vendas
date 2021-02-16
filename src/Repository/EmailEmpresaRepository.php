<?php

namespace App\Repository;

use App\Entity\EmailEmpresa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmailEmpresa|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmailEmpresa|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmailEmpresa[]    findAll()
 * @method EmailEmpresa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmailEmpresaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmailEmpresa::class);
    }

    public function buscarEmail()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('ee')
            ->from(EmailEmpresa::class, 'ee');

        return $qb->getQuery()->getOneOrNullResult();
    }
}