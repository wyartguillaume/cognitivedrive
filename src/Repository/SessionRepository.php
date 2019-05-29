<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Session::class);
    }

    // /**
    //  * @return Session[] Returns an array of Session objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Session
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findSessionVitesse($pseudo){
        $query = $this->createQueryBuilder('s');
        return $query->select('s.vitesseMoyenne', 'AVG(s.vitesseMoyenne) as average')     
                ->leftJoin('App:Patient', 'p', 'WITH', 's.patient = p.id')
                //->addSelect('r')     
                ->andWhere('p.pseudo LIKE :pseudoSearch')
                ->setParameter('pseudoSearch', '%'.$pseudo.'%')
                ->groupBy('s.patient')
                ->getQuery()
                ->getResult();
    }

    public function findSessionSortie($pseudo){
        $query = $this->createQueryBuilder('s');
        return $query->select('s.NbrRencontreRouteGauche, s.NbrRencontreRouteDroite')     
                ->leftJoin('App:Patient', 'p', 'WITH', 's.patient = p.id')
                //->addSelect('r')     
                ->andWhere('p.pseudo LIKE :pseudoSearch')
                ->setParameter('pseudoSearch', '%'.$pseudo.'%')
                ->getQuery()
                ->getResult();
    }
    
    public function findNbrBoutton($pseudo){
        $query = $this->createQueryBuilder('s');
        return $query->select('s.nbrTotaleButtonAcceleration, s.nbrTotaleButtonFrein')     
                ->leftJoin('App:Patient', 'p', 'WITH', 's.patient = p.id')
                //->addSelect('r')     
                ->andWhere('p.pseudo LIKE :pseudoSearch')
                ->setParameter('pseudoSearch', '%'.$pseudo.'%')
                ->getQuery()
                ->getResult();
    }

    public function findNbrToucheObstacle($pseudo){
        $query = $this->createQueryBuilder('s');
        return $query->select('s.nbrTouchePietonsDroit, s.nbrTouchePietonsGauche', 's.NbrAnimalToucheGauche', 's.NbrAnimalToucheDroite')     
                ->leftJoin('App:Patient', 'p', 'WITH', 's.patient = p.id')
                //->addSelect('r')     
                ->andWhere('p.pseudo LIKE :pseudoSearch')
                ->setParameter('pseudoSearch', '%'.$pseudo.'%')
                ->getQuery()
                ->getResult();
    }

    

}
