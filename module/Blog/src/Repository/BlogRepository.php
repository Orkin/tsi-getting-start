<?php
/**
 * User: orkin
 * Date: 16/02/2017
 * Time: 12:15
 */
declare(strict_types = 1);


namespace Blog\Repository;


use Blog\Model\Blog;
use Doctrine\ORM\EntityRepository;

class BlogRepository extends EntityRepository
{

    /**
     * @param int $id
     *
     * @return Blog|null
     */
    public function findOneById(int $id)
    {
        $qb = $this->createQueryBuilder('b')
                   ->andWhere('b.id = :id')
                   ->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $qb = $this->createQueryBuilder('b')
                   ->addSelect('a')
                   ->leftJoin('b.album', 'a');

        return $qb->getQuery()->getResult();
    }
}
