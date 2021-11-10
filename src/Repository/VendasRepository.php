<?php

namespace App\Repository;

use App\Entity\Vendas;
use App\Entity\Vendedor;
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

    public function buscarVendasDeHoje($diaAtualHoraInicio, $diaAtualHoraFim)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('vendas.valor_comissao, vendas.valor_venda, vendas.data_venda, vendedor.nome')
            ->from(Vendas::class, 'vendas')
            ->innerJoin(Vendedor::class, 'vendedor', 'WITH', 'vendas.vendedor = vendedor.id')
            ->where(
                $qb->expr()->gte('vendas.data_venda', ':data_hora_inicio'),
                $qb->expr()->lte('vendas.data_venda', ':data_hora_fim')
            )
            ->setParameter('data_hora_inicio', $diaAtualHoraInicio)
            ->setParameter('data_hora_fim', $diaAtualHoraFim);

        return $qb->getQuery()->getArrayResult();
    }
}