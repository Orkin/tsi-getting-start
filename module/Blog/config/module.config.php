<?php
namespace Blog;

use Blog\Controller;
use Blog\Factory\ListControllerFactory;
use Blog\Factory\PostRepositoryFactory;
use Blog\Model\PostRepositoryInterface;
use Zend\Router\Http\Literal;

return [
    'controllers' => [
        'factories' => [
            Controller\ListController::class => ListControllerFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            PostRepositoryInterface::class => PostRepositoryFactory::class,
        ],
    ],

    // This lines opens the configuration for the RouteManager
    'router'          => [
        // Open configuration for all possible routes
        'routes' => [
            // Define a new route called "blog"
            'blog' => [
                // Define a "literal" route type:
                'type'    => Literal::class,
                // Configure the route itself
                'options' => [
                    // Listen to "/blog" as uri:
                    'route'    => '/blog',
                    // Define default controller and action to be called when
                    // this route is matched
                    'defaults' => [
                        'controller' => Controller\ListController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
