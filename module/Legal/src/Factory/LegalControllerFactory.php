<?php
/**
 * User: orkin
 * Date: 15/02/2017
 * Time: 16:45
 */
declare(strict_types = 1);


namespace Legal\Factory;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Legal\Controller\LegalController;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class LegalControllerFactory implements FactoryInterface
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
        return new LegalController();
    }
}
