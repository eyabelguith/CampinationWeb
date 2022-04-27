<?php

namespace App\Repository;

use App\Entity\Transporteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Transporteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transporteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transporteur[]    findAll()
 * @method Transporteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransporteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transporteur::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Transporteur $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Transporteur $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Transporteur[] Returns an array of Transporteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Transporteur
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByNom()
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.nom','ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findByCapacite()
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.capacite','DESC')
            
            ->getQuery()
            ->getResult()
            ;
    }
    public function getAllTeamsSortedByDescBudget()     {   
              $q = $this->createQueryBuilder('t')
              ->orderBy('t.budget', 'DESC');     
             return $q->getQuery()->getResult();     }
    public function  showByDispo()
    {
        return $this->createQueryBuilder('t')
            ->where('t.disponibilite LIKE :d')
            ->setParameter('d', 'Oui')
            ->getQuery()
            ->getResult()
        ;
    }
}
