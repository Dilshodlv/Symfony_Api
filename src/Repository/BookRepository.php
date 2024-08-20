<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use http\Client\Curl\User;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

        /**
         * @return Book[] Returns an array of Book objects
         */
        public function findByExampleField($userId): array
        {
            return $this->createQueryBuilder('b')
                ->leftJoin('b.category', 'bc')
                ->innerJoin('b.image', 'bi')
                ->join(User::class, 'u')
                ->andWhere('u.id = :val')
                ->setParameter('val', $userId )
                ->orderBy('b.id', 'DESC')
                ->setMaxResults(2)
                ->getQuery()
                ->getResult()
            ;
        }

        public function findOneBookExample($text): ?Book
        {
            return $this->createQueryBuilder('b')
                ->andWhere('b.text like :val')
                ->setParameter('val', '%' . $text . '%')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
}
