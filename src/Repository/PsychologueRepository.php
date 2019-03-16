<?php

namespace App\Repository;

use App\Entity\Psychologue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Psychologue|null find($id, $lockMode = null, $lockVersion = null)
 * @method Psychologue|null findOneBy(array $criteria, array $orderBy = null)
 * @method Psychologue[]    findAll()
 * @method Psychologue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PsychologueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Psychologue::class);
    }

    // /**
    //  * @return Psychologue[] Returns an array of Psychologue objects
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
    public function findOneBySomeField($value): ?Psychologue
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
