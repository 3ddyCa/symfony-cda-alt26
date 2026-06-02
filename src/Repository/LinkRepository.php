<?php

namespace App\Repository;

use App\Entity\Link;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Link>
 */
class LinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Link::class);
    }

       /**
        * @return Link[] Returns an array of Link objects
        */
       public function findByField(string $field,string|int $value): array
       {
           return $this->createQueryBuilder('l')
               ->andWhere($field.' = :val')
               ->setParameter('val', $value)
               ->orderBy('l.id', 'ASC')
               ->setMaxResults(10)
               ->getQuery()
               ->getResult()
           ;
       }

        public function findAll(): array
       {
           return $this->createQueryBuilder('l')
               ->getQuery()
               ->getResult()
           ;
       }

       public function findById($value): ?Link
       {
           return $this->createQueryBuilder('l')
               ->andWhere('l.id = :val')
               ->setParameter('val', $value)
               ->getQuery()
               ->getOneOrNullResult()
           ;
       }
}
