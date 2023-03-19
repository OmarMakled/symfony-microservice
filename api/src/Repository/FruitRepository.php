<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Fruit;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class FruitRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 10;

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
     * @param int $offset
     * @param array $criteria
     * @return array|null
     */
    public function getList(int $offset, array $criteria): ?array
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

        return $qb->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult();
    }

    public function listOf(string $field): ?array
    {
        return $this->createQueryBuilder('f')
           ->select('f.' . $field)
           ->distinct()
           ->getQuery()
           ->getResult();
    }
}
