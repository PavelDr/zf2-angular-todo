<?php

namespace Todolist\Factory;

use Todolist\Controller\IndexController;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class IndexControllerFactory
 * @package Todolist\Factory
 */
class IndexControllerFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $taskService = $realServiceLocator->get('TodolistTaskService');

        return new IndexController(
            $taskService
        );
    }
}