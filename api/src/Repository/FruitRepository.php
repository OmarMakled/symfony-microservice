<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Fruit;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class FruitRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fruit::class);
    }

    /**
     * @param Fruit $entity
     * @param bool $flush
     * @return void
     */
    public function save(Fruit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param array $criteria
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getList(array $criteria, int $offset, int $limit = 10): array
    {
        $qb = $this->createQueryBuilder('f')
            ->select(['f.id', 'f.name', 'f.family', 'f.arrange as order', 'f.genus', 'f.nutritions']);

        if (isset($criteria['name'])) {
            $qb->andWhere('f.name = :name')
                ->setParameter('name', $criteria['name']);
        }

        if (isset($criteria['family'])) {
            $qb->andWhere('f.family = :family')
                ->setParameter('family', $criteria['family']);
        }

        return $qb->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult();
    }

    public function listOf(string $field): array
    {
        return $this->createQueryBuilder('f')
           ->select('f.' . $field)
           ->distinct()
           ->getQuery()
           ->getSingleColumnResult();
    }
}
