<?php
/**
 * Created by PhpStorm.
 * User: boguslaw
 * Date: 19.12.18
 * Time: 08:34
 */


require_once("../Database.php");
require_once("../../Entity/DeadlineFactory.php");
require_once("../../Entity/DeadlineTask.php");
require_once("../../Entity/Task.php");
require_once("../../Entity/TaskFactory.php");

class InMemory implements Database
{
    private $deadlineTaskTab;

    /**
     * InMemory constructor.
     */
    public function __construct()
    {
        $this->deadlineTaskTab = [];
    }

    public function saveTask(int $year, int $month, int $week, int $day, Task $task)
    {

        $isImportantTask = $task->isImportantTask();
        if (!isset($this->deadlineTaskTab[$year] [$month] [$week] [$day] [0])) {
            $this->deadlineTaskTab = [$year => [$month => [$week =>
                    [$day => [$task]]]]] + $this->deadlineTaskTab;
        } else {
            if ($isImportantTask) {
                array_unshift($this->deadlineTaskTab[$year] [$month] [$week]
                [$day], $task);
            } else {
                array_push($this->deadlineTaskTab[$year] [$month] [$week]
                [$day], $task);
            }
        }
    }

    public function updateTask(int $year, int $month, int $week, int $day, Task $oldTask, \Task $task)
    {
        $this->deleteTask($year, $month, $week, $day, $oldTask);
        $this->saveTask($year, $month, $week, $day, $task);
    }

    public function deleteTask(int $year, int $month, int $week, int $day, Task $task)
    {
        $indexForDelete = array_search($task, $this->deadlineTaskTab [$year] [$month] [$week] [$day]);
        unset($this->deadlineTaskTab [$year] [$month] [$week] [$day][$indexForDelete]);
    }

    public function createDeadlineTask(int $year, int $month, int $week, int $day, Task $task): DeadlineTask
    {
        $director = DeadlineFactory::director();
        $deadlineTask = $director->createWithParameters($year, $month,
            $week, $day, $task);
        return $deadlineTask;
    }

    public function createTask(int $taskId, string $description,
                               bool $importantTask): Task
    {
        $director = TaskFactory::director();
        $task = $director->createWithId($taskId, $description, $importantTask);
        return $task;
    }

    public function getAllTask(): array
    {
        return $this->deadlineTaskTab;
    }
}