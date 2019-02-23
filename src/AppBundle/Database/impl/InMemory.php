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

    public function saveTask(DeadlineTask $deadlineTask)
    {
         $year = $deadlineTask->getYear();
         $month = $deadlineTask->getMonth();
         $week = $deadlineTask->getWeek();
         $day = $deadlineTask->getDay();
         $task = $deadlineTask->getTask();

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
        $deadline = $this->createDeadlineTask($year, $month, $week, $day, $task);
        $this->saveTask($deadline);
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

    public function createTask(string $description,
                               bool $importantTask): Task
    {
        $taskId = $this->getId();
        $director = TaskFactory::director();
        $task = $director->createWithId($taskId, $description, $importantTask);
        return $task;
    }

    public function getTaskForToday(int $year, int $month, int $week, int $day): array
    {
        ///
        // to do add implements
    }

    /**
     * @return int simple function - Nothing can guarantee 100% uniqueness.
     */
    function getId()
    {
        $id = crc32(uniqid());
        return $id;
    }

}