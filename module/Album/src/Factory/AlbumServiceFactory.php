<?php
/**
 * User: orkin
 * Date: 16/02/2017
 * Time: 15:24
 */
declare(strict_types = 1);


namespace Album\Factory;


use Album\Model\Album;
use Album\Repository\AlbumRepository;
use Album\Service\AlbumService;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class AlbumServiceFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     *
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        /** @var AlbumRepository $albumRepository */
        $albumRepository = $entityManager->getRepository(Album::class);

        return new AlbumService($entityManager, $albumRepository);
    }
}
