<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Car>
 *
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function getCars($filtersenergy = null, $filterskm =null, $filtersyear = null, $filterprice = null){
        $query = $this->createQueryBuilder('a');
        if($filtersenergy){
            $query->andWhere('a.energy IN(:energy)')
                ->setParameter(':energy', array_values($filtersenergy));
        }
        if($filtersyear){
            $query->andWhere('a.Year >= :year')
                ->setParameter(':year', $filtersyear);
        }
        if($filterprice){
            $query->andWhere('a.Price <= :price')
                ->setParameter(':price', $filterprice);
        }
        if($filterskm){
            $query->andWhere('a.KM <= :kms')
                ->setParameter(':kms', $filterskm);
        }
        return $query->getQuery()->getResult();
    }

//    /**
//     * @return Car[] Returns an array of Car objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Car
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
