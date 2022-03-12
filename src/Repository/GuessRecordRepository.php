<?php

namespace App\Repository;

use App\Entity\GuessRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GuessRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method GuessRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method GuessRecord[]    findAll()
 * @method GuessRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GuessRecordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GuessRecord::class);
    }

    // /**
    //  * @return GuessRecord[] Returns an array of GuessRecord objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GuessRecord
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
