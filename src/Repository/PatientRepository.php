<?php
namespace App\Repository;
use App\Entity\Patient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
/**
 * @method Patient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patient[]    findAll()
 * @method Patient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Patient|null findPsychoId($id)
 */
class PatientRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Patient::class);
    }
    // /**
    //  * @return Patient[] Returns an array of Patient objects
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
    public function findOneBySomeField($value): ?Patient
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    
    public function findPsychoId($id){
        $query = $this->createQueryBuilder('p');
        return $query->select('p')     
                ->leftJoin('App:Psychologue', 'r', 'WITH', 'p.psychologue = r.id')
                //->addSelect('r')     
                ->where('r.id='.$id)
                ->getQuery()
                ->getResult();
    }

    public function findPsycho($nom, $prenom){
        $query = $this->createQueryBuilder('p');
        return $query->select('r')     
                ->leftJoin('App:Psychologue', 'r', 'WITH', 'p.psychologue = r.id')
                //->addSelect('r')     
                ->andWhere('r.nom LIKE :nomSearch')
                ->setParameter('nomSearch', '%'.$nom.'%')
                ->andWhere('r.prenom LIKE :prenomSearch')
                ->setParameter('prenomSearch', '%'.$prenom.'%')
                ->getQuery()
                ->getResult();
    }
    

}