<?php

namespace App\Repository;

use App\Entity\ElementDonneeValeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ElementDonneeValeur>
 *
 * @method ElementDonneeValeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method ElementDonneeValeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method ElementDonneeValeur[]    findAll()
 * @method ElementDonneeValeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElementDonneeValeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElementDonneeValeur::class);
    }

    public function save(ElementDonneeValeur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ElementDonneeValeur $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ElementDonneeValeur[] Returns an array of ElementDonneeValeur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ElementDonneeValeur
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
