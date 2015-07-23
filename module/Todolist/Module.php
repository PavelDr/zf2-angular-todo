<?php
namespace Todolist;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\EventManager\EventInterface;

use Todolist\Service\TaskService;
use Todolist\Domain\Factory\TaskFactory;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

/**
 * Class Module
 * @package Todolist
 */
class Module implements BootstrapListenerInterface
{
    /**
     * @param EventInterface $e
     * @return array|void
     */
    public function onBootstrap(EventInterface $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/todolist.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'TodolistTaskFactory' => function($sm) {
                    return new TaskFactory();
                },
                'TodolistTaskService' => function($sm) {
                    $entityManager = $sm->get('doctrine.entitymanager.orm_default');
                    $taskRepository = $entityManager->getRepository('Todolist\\Domain\\Entity\\Task');
                    $taskFactory = $sm->get('TodolistTaskFactory');
                    $hydrator = new DoctrineObject($entityManager);

                    return new TaskService(
                        $entityManager,
                        $taskRepository,
                        $taskFactory,
                        $hydrator
                    );
                },
            ],
        ];
    }
}
