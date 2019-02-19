<?php


class TaskBook
{
    private $database;

    public function __construct(Database $databaseObject)
    {
        $this->database = $databaseObject;
    }

    public function saveTask(int $year, int $month, int $week, int $day, Task $task)
    {
        $this->database->saveTask($year, $month, $week, $day, $task);
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


    public function createTask(int $taskId, string $description, bool $importantTask): Task
    {
        $task = $this->database->createTask($taskId, $description, $importantTask);
        return $task;
    }

    public function getAllTask(): array
    {
        $tasks = $this->database->getAllTask();
        return $tasks;
    }
}