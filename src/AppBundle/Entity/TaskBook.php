<?php

require_once ("../Database/Database.php");

class TaskBook
{
    private $database;

    public function __construct(Database $databaseObject)
    {
        $this->database = $databaseObject;
    }

    public function saveTask(DeadlineTask $deadlineTask)
    {
        $this->database->saveTask($deadlineTask);
    }

    public function getTaskForToday(int $year, int $month, int $week, int $day)
    {
        $this->database->getTaskForToday($year, $month, $week, $day);
    }

    public function updateTask(int $year, int $month, int $week, int $day, Task $oldTask, Task $task)
    {
        // TODO: Implement updateTask() method.
    }

    public function deleteTask(int $year, int $month, int $week, int $day, Task $task)
    {
        // TODO: Implement deleteTask() method.
    }

    public function createDeadlineTask(int $year, int $month, int $week, int $day, Task $task): DeadlineTask
    {
        $deadlineTask = $this->database->createDeadlineTask($year, $month, $week, $day, $task);
        return $deadlineTask;
    }

    public function createTask(string $description, bool $importantTask): Task
    {
        $task = $this->database->createTask($description, $importantTask);
        return $task;
    }
}