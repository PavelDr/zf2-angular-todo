<?php

namespace Todolist\Service;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

use Todolist\Domain\Factory\TaskFactory;
use Todolist\Domain\Entity\Task as TaskEntity;

/**
 * Class TaskService
 * @package Todolist\Service
 */
class TaskService implements TaskServiceInterface
{

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $taskRepository;

    /**
     * @var TaskFactory
     */
    protected $taskFactory;

    /**
     * @var DoctrineObject
     */
    protected $hydrator;

    /**
     * @param EntityManager $em
     * @param EntityRepository $taskRepository
     * @param TaskFactory $taskFactory
     * @param DoctrineObject $hydrator
     */
    public function __construct(
        EntityManager $em,
        EntityRepository $taskRepository,
        TaskFactory $taskFactory,
        DoctrineObject $hydrator
    ) {
        $this->em = $em;
        $this->taskRepository = $taskRepository;
        $this->taskFactory = $taskFactory;
        $this->hydrator = $hydrator;
    }

    /**
     * Get tasks
     * @return array
     */
    public function getTasks()
    {
        $result = $this->taskRepository->getTasksArray();

        return $result;
    }

    /**
     * Add task
     * @param $data
     * @return array|mixed
     */
    public function addTask($data)
    {
        $result = null;
        $message = null;

        try {
            $task = $this->taskFactory->create($data);

            $this->em->persist($task);
            $this->em->flush();

            $success = true;
            $result = [
                'id' => $task->getId(),
                'text' => $task->getText(),
                'done' => $task->getDone()
             ];

        } catch(\Exception $e) {
            $message = $e->getMessage();
            $success = false;
        }

        return [
            'success' => $success,
            'message' => $message,
            'result' => $result
        ];
    }

    /**
     * Edit task
     * @param $data
     * @return array
     */
    public function editTask($data)
    {
        $result = null;
        $message = null;

        try {
            $task = $this->taskRepository->find($data['id']);
            if(!$task instanceof TaskEntity) {
                throw new \Exception('Wrong id');
            }

            $task->setText($data['text']);
            $task->setDone($data['done']);

            $this->em->persist($task);
            $this->em->flush();

            $success = true;
            $result = [
                'id' => $task->getId(),
                'text' => $task->getText(),
                'done' => $task->getDone()

            ];

        } catch(\Exception $e) {
            $message = $e->getMessage();
            $success = false;
        }

        return [
            'success' => $success,
            'message' => $message,
            'result' => $result
        ];
    }

    /**
     * Delete done tasks and return others
     * @return mixed
     */
    public function deleteTasks()
    {
        $tasks = $this->taskRepository->getTasks();
        $undoneTasks = [];

        foreach($tasks as $task) {

            if($task->getDone()) {
                $this->em->remove($task);
            } else {
                $undoneTasks[] = $this->hydrator->extract($task);
            }
        }

        $this->em->flush();

        return $undoneTasks;
    }
} 