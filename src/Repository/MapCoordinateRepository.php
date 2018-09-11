<?php

namespace App\Repository;

use App\Entity\MapCoordinate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MapCoordinate|null find($id, $lockMode = null, $lockVersion = null)
 * @method MapCoordinate|null findOneBy(array $criteria, array $orderBy = null)
 * @method MapCoordinate[]    findAll()
 * @method MapCoordinate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MapCoordinateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MapCoordinate::class);
    }

//    /**
//     * @return MapCoordinate[] Returns an array of MapCoordinate objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MapCoordinate
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
