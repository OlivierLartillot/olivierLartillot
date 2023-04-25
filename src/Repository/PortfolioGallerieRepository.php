<?php

namespace App\Repository;

use App\Entity\PortfolioGallerie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PortfolioGallerie>
 *
 * @method PortfolioGallerie|null find($id, $lockMode = null, $lockVersion = null)
 * @method PortfolioGallerie|null findOneBy(array $criteria, array $orderBy = null)
 * @method PortfolioGallerie[]    findAll()
 * @method PortfolioGallerie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortfolioGallerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PortfolioGallerie::class);
    }

    public function save(PortfolioGallerie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PortfolioGallerie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PortfolioGallerie[] Returns an array of PortfolioGallerie objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PortfolioGallerie
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
