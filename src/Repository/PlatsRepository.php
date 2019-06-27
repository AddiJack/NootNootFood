<?php

namespace App\Repository;

use App\Entity\Plats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Plats|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plats|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plats[]    findAll()
 * @method Plats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Plats::class);
    }

    /**
    * @return Plats[] Returns an array of Plats objects
    */
    public function findByTag($tag)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.tag = :tag')
            ->setParameter('tag', $tag)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByDesc()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.prix', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByAsc()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.prix', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Plats
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
