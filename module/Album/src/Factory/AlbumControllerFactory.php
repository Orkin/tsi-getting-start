<?php
/**
 * User: orkin
 * Date: 13/02/2017
 * Time: 17:23
 */
declare(strict_types = 1);


namespace Album\Factory;


use Album\Controller\AlbumController;
use Album\Model\AlbumTable;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class AlbumControllerFactory implements FactoryInterface
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
        /** @var AlbumTable $albumTable */
        $albumTable = $container->get(AlbumTable::class);

        return new AlbumController($albumTable);
    }
}
