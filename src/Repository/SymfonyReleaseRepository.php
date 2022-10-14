<?php

namespace App\Repository;

use App\Entity\SymfonyRelease;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SymfonyRelease>
 *
 * @method SymfonyRelease|null find($id, $lockMode = null, $lockVersion = null)
 * @method SymfonyRelease|null findOneBy(array $criteria, array $orderBy = null)
 * @method SymfonyRelease[]    findAll()
 * @method SymfonyRelease[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SymfonyReleaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SymfonyRelease::class);
    }

    public function save(SymfonyRelease $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SymfonyRelease $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
