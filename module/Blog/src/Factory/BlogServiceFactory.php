<?php
/**
 * User: orkin
 * Date: 17/02/2017
 * Time: 14:10
 */
declare(strict_types = 1);


namespace Blog\Factory;


use Blog\Model\Blog;
use Blog\Repository\BlogRepository;
use Blog\Service\BlogService;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class BlogServiceFactory implements FactoryInterface
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
        /** @var BlogRepository $blogRepository */
        $blogRepository = $entityManager->getRepository(Blog::class);

        return new BlogService($entityManager, $blogRepository);
    }
}
