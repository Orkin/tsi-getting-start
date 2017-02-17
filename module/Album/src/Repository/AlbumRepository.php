<?php
/**
 * User: orkin
 * Date: 16/02/2017
 * Time: 12:15
 */
declare(strict_types = 1);


namespace Album\Repository;


use Album\Model\Album;
use Doctrine\ORM\EntityRepository;

class AlbumRepository extends EntityRepository
{

    /**
     * @param int $id
     *
     * @return Album|null
     */
    public function findOneById(int $id)
    {
        $qb = $this->createQueryBuilder('a')
                   ->andWhere('a.id = :id')
                   ->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
