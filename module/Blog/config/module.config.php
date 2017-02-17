<?php
namespace Blog;

use Blog\Controller;
use Blog\Factory\AddBlogFormFactory;
use Blog\Factory\BlogControllerFactory;
use Blog\Factory\BlogFieldsetFactory;
use Blog\Factory\BlogServiceFactory;
use Blog\Factory\EditBlogFormFactory;
use Blog\Form\AddBlogForm;
use Blog\Form\EditBlogForm;
use Blog\Form\Fieldset\BlogFieldset;
use Blog\Service\BlogService;
use Zend\Router\Http\Segment;

return [
    'doctrine' => [
        'driver' => [
            'blog_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    'module/Blog/src/Model',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Blog\Model' => 'blog_driver',
                ],
            ],
        ],
    ],

    'router' => [
        'routes' => [
            'blog' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/blog[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults'    => [
                        'controller' => Controller\BlogController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'form_elements' => [
        'factories' => [
            AddBlogForm::class  => AddBlogFormFactory::class,
            EditBlogForm::class => EditBlogFormFactory::class,
            BlogFieldset::class => BlogFieldsetFactory::class,
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\BlogController::class => BlogControllerFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            BlogService::class => BlogServiceFactory::class,
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
