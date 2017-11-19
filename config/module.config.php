<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/11/2017
 * Time: 16:59
 */

namespace MediaBox;

use Cars\Model\Model;
use function Couchbase\defaultDecoder;
use MediaBox\Factory\MediaBoxControllerFactory;
use MediaBox\Factory\VideoRepositoryFactory;
use MediaBox\Model\VideoRepository;
use MediaBox\Model\VideoRepositoryInterface;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'aliases' => [
            VideoRepositoryInterface::class => VideoRepository::class,
        ],
        'factories' => [
            VideoRepository::class => InvokableFactory::class,
            VideoRepository::class => VideoRepositoryFactory::class
        ]
    ],

    'controllers' => [
        'factories' => [

                Controller\MediaBoxController::class => MediaBoxControllerFactory::class,
            ]
    ],

    'router' => [
        'routes' => [
            'mediabox' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/mediabox[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => Controller\MediaBoxController::class,
                        'action'     => 'index',
                    ],
                ],

                'may_terminate' => true,
                'child_routes'  => [
                    'video' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/:id',
                            'defaults' => [
                                'action' => 'video',
                            ],
                            'constraints' => [
                                'id' => '[1-9]\d*',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/:id',
                            'defaults' => [
                                'action' => 'edit',
                            ],
                            'constraints' => [
                                'id' => '[0-9]\d*'
                            ]
                        ]
                    ]
                ],
            ],
        ]
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view'
        ]
    ]
];