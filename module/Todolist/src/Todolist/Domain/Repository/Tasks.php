<?php
namespace Todolist\Domain\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class Tasks
 * @package Todolist\Domain\Repository
 */
class Tasks extends EntityRepository {

    /**
     * Get all tasks from database
     * @return array
     */
    public function getTasksArray()
    {
        $queryBuilder = $this->createQueryBuilder('tasks');

        return $queryBuilder->getQuery()->getArrayResult();
    }

    /**
     * Get all tasks from database
     * @return array
     */
    public function getTasks()
    {
        $queryBuilder = $this->createQueryBuilder('tasks');

        return $queryBuilder->getQuery()->getResult();
    }

}