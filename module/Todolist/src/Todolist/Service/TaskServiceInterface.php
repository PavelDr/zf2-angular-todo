<?php
namespace Todolist\Service;

/**
 * Interface TaskServiceInterface
 * @package Todolist\Service
 */
interface TaskServiceInterface {

    /**
     * Get tasks
     * @return array
     */
    public function getTasks();

    /**
     * Create and save task in database
     * @param $data
     * @return mixed
     */
    public function addTask($data);

    /**
     * Edit and save task in database
     * @param $data
     * @return mixed
     */
    public function editTask($data);

    /**
     * Delete tasks and return all others
     * @return mixed
     */
    public function deleteTasks();

} 