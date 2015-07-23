<?php
namespace Todolist\Domain\Factory;

use Todolist\Domain\Entity\Task as TaskEntity;

/**
 * Class TaskFactory
 * @package Todolist\Domain\Factory
 */
class TaskFactory {

    /**
     * @param $data
     * @return TaskEntity
     */
    public function create($data)
    {
        $task = new TaskEntity($data['text']);

        if(isset($data['done'])) {
            $task->setDone($data['done']);
        }

        return $task;
    }
}