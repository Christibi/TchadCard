<?php

namespace App\Repository;

use App\Entity\CategorieVulnerabilite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieVulnerabilite>
 *
 * @method CategorieVulnerabilite|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieVulnerabilite|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieVulnerabilite[]    findAll()
 * @method CategorieVulnerabilite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieVulnerabiliteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieVulnerabilite::class);
    }

    public function save(CategorieVulnerabilite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CategorieVulnerabilite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CategorieVulnerabilite[] Returns an array of CategorieVulnerabilite objects
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

//    public function findOneBySomeField($value): ?CategorieVulnerabilite
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
