<?php
namespace Todolist\Controller;

use Todolist\Service\TaskServiceInterface;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

/**
 * Class IndexController
 * @package Todolist\Controller
 */
class IndexController extends AbstractActionController
{
    /**
     * @var \Todolist\Service\TaskServiceInterface;
     */
    protected $taskService;

    /**
     * @param TaskServiceInterface $taskService
     */
    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Show all tasks
     * @return ViewModel
     */
    public function indexAction()
    {
        return new ViewModel();
    }

    /**
     * Get all tasks
     * @return JsonModel
     */
    public function getTasksAction()
    {
        $tasks = $this->taskService->getTasks();

        return new JsonModel($tasks);
    }

    /**
     * Add task
     * @return JsonModel
     */
    public function addAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new JsonModel([
                'success' => false,
                'message' => 'No params',
                'result' => null
            ]);
        }

        $response = $this->taskService->addTask($request->getPost()->getArrayCopy());

        return new JsonModel($response);
    }

    /**
     * Edit task
     * @return JsonModel
     */
    public function editAction()
    {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new JsonModel([
                'success' => false,
                'message' => 'No params',
                'result' => null
            ]);
        }

        $response = $this->taskService->editTask($request->getPost()->getArrayCopy());

        return new JsonModel($response);
    }

    /**
     * Delete all done tasks
     * @return JsonModel
     */
    public function deleteAction()
    {
        $tasks = $this->taskService->deleteTasks();

        return new JsonModel($tasks);
    }
}