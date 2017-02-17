<?php
/**
 * User: orkin
 * Date: 15/02/2017
 * Time: 10:36
 */
declare(strict_types = 1);


namespace Blog\Factory;


use Blog\Controller\BlogController;
use Blog\Form\AddBlogForm;
use Blog\Form\EditBlogForm;
use Blog\Service\BlogService;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class BlogControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param null|array         $options
     *
     * @return BlogController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var BlogService $blogService */
        $blogService = $container->get(BlogService::class);
        /** @var AddBlogForm $addBlogForm */
        $addBlogForm = $container->get('FormElementManager')->get(AddBlogForm::class);
        /** @var EditBlogForm $editBlogForm */
        $editBlogForm = $container->get('FormElementManager')->get(EditBlogForm::class);

        return new BlogController($blogService, $addBlogForm, $editBlogForm);
    }
}
