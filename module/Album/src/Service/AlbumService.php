<?php
/**
 * User: orkin
 * Date: 16/02/2017
 * Time: 14:25
 */
declare(strict_types = 1);


namespace Album\Service;


use Album\Model\Album;
use Album\Repository\AlbumRepository;
use Doctrine\ORM\EntityManager;

class AlbumService implements AlbumServiceInterface
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var AlbumRepository
     */
    private $albumRepository;

    /**
     * AlbumService constructor.
     *
     * @param EntityManager   $entityManager
     * @param AlbumRepository $albumRepository
     */
    public function __construct(EntityManager $entityManager, AlbumRepository $albumRepository)
    {
        $this->entityManager   = $entityManager;
        $this->albumRepository = $albumRepository;
    }

    /**
     * @return Album[]
     */
    public function getAllAlbums()
    {
        return $this->albumRepository->findAll();
    }

    public function create(Album $album): Album
    {
        $this->entityManager->persist($album);
        $this->entityManager->flush($album);

        return $album;
    }

    public function edit(Album $album): Album
    {
        $this->entityManager->flush($album);

        return $album;
    }

    public function delete(Album $album): bool
    {
        try {
            $this->entityManager->remove($album);
            $this->entityManager->flush($album);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param int $id
     *
     * @return Album|null
     */
    public function getAlbumById(int $id)
    {
        return $this->albumRepository->findOneById($id);
    }
}
