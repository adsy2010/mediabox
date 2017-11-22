<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 19/11/2017
 * Time: 16:59
 */

namespace MediaBox;


use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'aliases' => [
            Model\VideoRepositoryInterface::class => Model\VideoRepository::class,
            Model\VideoCommandInterface::class => Model\VideoCommand::class,
        ],
        'factories' => [
            //VideoRepository::class => InvokableFactory::class,
            Model\VideoRepository::class => Factory\VideoRepositoryFactory::class,
            Model\VideoCommand::class => Factory\VideoCommandFactory::class
        ]
    ],

    'controllers' => [
        'factories' => [
                Controller\MediaBoxController::class => Factory\MediaBoxControllerFactory::class,
                Controller\WriteController::class => Factory\WriteControllerFactory::class,
                Controller\DeleteController::class => Factory\DeleteControllerFactory::class,
            ]
    ],

    'router' => [
        'routes' => [
            'mediabox' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/tools/mediabox',
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
                            'route'    => '/video/:id',
                            'defaults' => [
                                'controller' => Controller\MediaBoxController::class,
                                'action' => 'video'
                            ],
                            'constraints' => [
                                'id' => '[0-9]\d*'
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/edit/:id',
                            'defaults' => [
                                'controller' => Controller\WriteController::class,
                                'action' => 'edit'
                            ],
                            'constraints' => [
                                'id' => '[0-9]\d*'
                            ]
                        ]
                    ],
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/delete/:id',
                            'defaults' => [
                                'controller' => Controller\DeleteController::class,
                                'action' => 'delete'
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