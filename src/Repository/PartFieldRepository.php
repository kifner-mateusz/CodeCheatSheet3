<?php

namespace App\Repository;

use App\Entity\PartField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PartField|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartField|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartField[]    findAll()
 * @method PartField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartFieldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PartField::class);
    }

    // /**
    //  * @return PartField[] Returns an array of PartField objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PartField
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
