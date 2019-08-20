<?php

namespace App\Repository;

use App\Entity\Topic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Topic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Topic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Topic[]    findAll()
 * @method Topic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TopicRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Topic::class);
    }

    // /**
    //  * @return Topic[] Returns an array of Topic objects
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
    public function findOneBySomeField($value): ?Topic
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByCategorie($idCategorie)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql='CALL FindTopicByCategorie(:idCategorie)';

        $stmt=$conn->prepare($sql);

        $stmt->execute(['idCategorie'=>$idCategorie]);

        return $stmt->fetchAll();
    }

    public function findById($idTopic)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql='CALL FindTopicById(:idTopic)';

        $stmt=$conn->prepare($sql);

        $stmt->execute(['idTopic'=>$idTopic]);

        return $stmt->fetch();
    }
}
