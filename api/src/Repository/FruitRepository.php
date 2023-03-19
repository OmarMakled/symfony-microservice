<?php

namespace App\Repository;

use App\Entity\Fruit;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query;

/**
 * @extends ServiceEntityRepository<Fruit>
 *
 * @method Fruit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fruit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fruit[]    findAll()
 * @method Fruit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FruitRepository extends ServiceEntityRepository
{
    public const PAGINATOR_PER_PAGE = 10;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fruit::class);
    }

    public function save(Fruit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
   
    /**
    * @return Fruit[] Returns an array of Fruit objects
    */
    public function getList(int $offset, array $criteria): ?array
    {
        $qb = $this->createQueryBuilder('f')
            ->select(['f.id', 'f.name', 'f.family', 'f.arrange as order', 'f.genus', 'f.nutritions']);

        if(isset($criteria['name'])){
            $qb->andWhere('f.name = :name')
                ->setParameter('name', $criteria['name']);
        }

        if(isset($criteria['family'])){
            $qb->andWhere('f.family = :family')
                ->setParameter('family', $criteria['family']);
        }

        return $qb->setMaxResults(self::PAGINATOR_PER_PAGE)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult();
    }

        /**
    * @return Fruit[] Returns an array of Fruit objects
    */
    public function getCount(array $criteria): ?array
    {
        $qb = $this->createQueryBuilder('f')
            ->select(['f.id']);

        if(isset($criteria['name'])){
            $qb->andWhere('f.name = :name')
                ->setParameter('name', $criteria['name']);
        }

        if(isset($criteria['family'])){
            $qb->andWhere('f.family = :family')
                ->setParameter('family', $criteria['family']);
        }

        return $qb->getQuery()->getScalarResult();
    }

    public function listOf(string $field): ?array
   {
       return $this->createQueryBuilder('f')
           ->select('f.'.$field)
           ->distinct()
           ->getQuery()
           ->getResult();
   }
}
