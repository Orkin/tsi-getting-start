<?php
declare(strict_types = 1);

namespace Album;

use Album\Controller\AlbumController;
use Album\Factory\AlbumControllerFactory;
use Album\Factory\AlbumFormFactory;
use Album\Factory\AlbumTableFactory;
use Album\Factory\AlbumTableGatewayFactory;
use Album\Form\AlbumForm;
use Album\Model\AlbumTable;
use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            AlbumController::class => AlbumControllerFactory::class,
        ],
    ],

    'router' => [
        'routes' => [
            'album' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/album[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults'    => [
                        'controller' => Controller\AlbumController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'form_elements' => [
        AlbumForm::class => AlbumFormFactory::class,
    ],

    'service_manager' => [
        'factories' => [
            AlbumTable::class               => AlbumTableFactory::class,
            'Album\Model\AlbumTableGateway' => AlbumTableGatewayFactory::class,
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
];
