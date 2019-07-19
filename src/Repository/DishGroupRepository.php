<?php

namespace App\Repository;

use App\Entity\DishGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DishGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method DishGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method DishGroup[]    findAll()
 * @method DishGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DishGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DishGroup::class);
    }

    // /**
    //  * @return DishGroup[] Returns an array of DishGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DishGroup
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
