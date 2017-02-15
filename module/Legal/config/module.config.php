<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Legal;

use Legal\Controller\LegalController;
use Legal\Factory\LegalControllerFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router'       => [
        'routes' => [
            'parent' => [
                'type'          => Literal::class,
                'options'       => [
                    'route' => '/legal',
                ],
                'may_terminate' => false,
                'child_routes'  => [
                    'legal' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/legal',
                            'defaults' => [
                                'controller' => LegalController::class,
                                'action'     => 'legal',
                            ],
                        ],
                    ],
                    'cgu'   => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'       => '/cgu[/:lang]',
                            'defaults'    => [
                                'controller' => LegalController::class,
                                'action'     => 'cgu',
                                'lang'       => 'fr',
                            ],
                            'constraints' => [
                                'lang' => '[a-zA-Z]*',
                            ],
                        ],
                    ],
                    'toto'  => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/toto',
                            'defaults' => [
                                'controller' => LegalController::class,
                                'action'     => 'cgu',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers'  => [
        'factories' => [
            Controller\LegalController::class => LegalControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'legal/legal/cgu'   => __DIR__ . '/../view/legal/legal/cgu.phtml',
            'legal/legal/legal' => __DIR__ . '/../view/legal/legal/legal.phtml',
        ],
    ],
];
