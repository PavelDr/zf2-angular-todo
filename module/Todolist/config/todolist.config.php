<?php
namespace Todolist;

return array(
    'router' => array(
        'routes' => array(
            'home' => [
                'type' => 'segment',
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => 'Todolist\Controller\Index',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'getTasks' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route' => 'getTasks',
                            'defaults' => [
                                'controller' => 'Todolist\Controller\Index',
                                'action' => 'getTasks',
                            ],
                        ],
                    ],
                    'add' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route' => 'add',
                            'defaults' => [
                                'controller' => 'Todolist\Controller\Index',
                                'action' => 'add',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route' => 'edit',
                            'defaults' => [
                                'controller' => 'Todolist\Controller\Index',
                                'action' => 'edit',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route' => 'delete',
                            'defaults' => [
                                'controller' => 'Todolist\Controller\Index',
                                'action' => 'delete',
                            ],
                        ],
                    ],
                ],
            ],
        ),
    ),
    'controllers' => array(
        //Add controller with factory also we can add it with conclusion
        'factories' => [
            'Todolist\Controller\Index' => 'Todolist\Factory\IndexControllerFactory',
        ],
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'todolist' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    // Doctrine config
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Domain/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Domain\Entity' => __NAMESPACE__ . '_driver'
                ),

            ),
        ),
        //Set you configutation and rewrite doctrine config ./vendor/doctrine/doctrine-orm-module/config/module.config.php
        'configuration' => [
            'orm_default' => [
                'proxy_dir' => 'data/doctrine/Proxy',
                'proxy_namespace' => 'Proxy'
            ]
        ]
    ),
    //Add loggers, now not use it
    'log' => [
    ],
);
