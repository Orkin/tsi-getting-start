<?php
declare(strict_types = 1);

namespace Album;

use Album\Controller\AlbumController;
use Album\Factory\AlbumControllerFactory;
use Album\Factory\AlbumFieldsetFactory;
use Album\Factory\AddAlbumFormFactory;
use Album\Factory\AlbumServiceFactory;
use Album\Factory\AlbumTableFactory;
use Album\Factory\AlbumTableGatewayFactory;
use Album\Form\AddAlbumForm;
use Album\Form\Fieldset\AlbumFieldset;
use Album\Model\AlbumTable;
use Album\Service\AlbumService;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'doctrine' => [
        'driver' => [
            'album_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    'module/Album/src/Model',
                ],
            ],
            'orm_default'  => [
                'drivers' => [
                    'Album\Model' => 'album_driver',
                ],
            ],
        ],
    ],

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
        'factories' => [
            AddAlbumForm::class  => AddAlbumFormFactory::class,
            AlbumFieldset::class => AlbumFieldsetFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            AlbumTable::class               => AlbumTableFactory::class,
            'Album\Model\AlbumTableGateway' => AlbumTableGatewayFactory::class,
            AlbumService::class             => AlbumServiceFactory::class,
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
];
